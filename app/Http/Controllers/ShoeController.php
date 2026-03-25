<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShoeController extends Controller
{
    public function index()
{
    $shoes = Shoe::latest()->get();

    $brands = Shoe::select('brand')
        ->whereNotNull('brand')
        ->distinct()
        ->orderBy('brand')
        ->pluck('brand');

    $categories = Shoe::select('category')
        ->whereNotNull('category')
        ->distinct()
        ->orderBy('category')
        ->pluck('category');

    $types = Shoe::select('type')
        ->whereNotNull('type')
        ->distinct()
        ->orderBy('type')
        ->pluck('type');

    $sizes = Shoe::select('size')
        ->whereNotNull('size')
        ->distinct()
        ->orderBy('size')
        ->pluck('size');

    return view('shoes.index', compact('shoes', 'brands', 'categories', 'types', 'sizes'));
}



    public function show(Shoe $shoe)
    {
        $shoe->load(['reviews.user']);

        $recommendedShoes = Shoe::where('category', $shoe->category)
            ->where('id', '!=', $shoe->id)
            ->latest()
            ->take(4)
            ->get();

        return view('shoes.show', compact('shoe', 'recommendedShoes'));

    }

    public function adminIndex()
    {
        $shoes = Shoe::latest()->paginate(15);

        return view('admin.shoes.index', compact('shoes'));
    }

    public function create()
    {
        return view('admin.shoes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'size' => 'required|numeric|min:20|max:50',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'color' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('shoes', 'public');
        }

        Shoe::create($data);

        return redirect()->route('admin.shoes.index')->with('success', 'But został dodany.');
    }

    public function edit(Shoe $shoe)
    {
        return view('admin.shoes.edit', compact('shoe'));
    }

    public function update(Request $request, Shoe $shoe)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'size' => 'required|numeric|min:20|max:50',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'color' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($shoe->image) {
                Storage::disk('public')->delete($shoe->image);
            }

            $data['image'] = $request->file('image')->store('shoes', 'public');
        }

        $shoe->update($data);

        return redirect()->route('admin.shoes.index')->with('success', 'But został zaktualizowany.');
    }

    public function destroy(Shoe $shoe)
    {
        if ($shoe->image) {
            Storage::disk('public')->delete($shoe->image);
        }

        $shoe->delete();

        return redirect()->route('admin.shoes.index')->with('success', 'But został usunięty.');
    }
}
