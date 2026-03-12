<?php

namespace App\Http\Controllers;

use App\Models\Shoe;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected function getCart()
    {
        return session()->get('cart', []);
    }

    protected function saveCart($cart)
    {
        session()->put('cart', $cart);
    }

    public function index()
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Shoe $shoe)
    {
        $quantity = max(1, (int) $request->input('quantity', 1));
        $cart = $this->getCart();

        if (isset($cart[$shoe->id])) {
            $cart[$shoe->id]['quantity'] += $quantity;
        } else {
            $cart[$shoe->id] = [
                'id' => $shoe->id,
                'name' => $shoe->name,
                'brand' => $shoe->brand,
                'price' => $shoe->price,
                'quantity' => $quantity,
                'image' => $shoe->image,
            ];
        }

        $this->saveCart($cart);

        return redirect()->route('cart.index')->with('success', 'Dodano produkt do koszyka.');
    }

    public function update(Request $request, Shoe $shoe)
    {
        $quantity = (int) $request->input('quantity', 1);
        $cart = $this->getCart();

        if (isset($cart[$shoe->id])) {
            if ($quantity <= 0) {
                unset($cart[$shoe->id]);
            } else {
                $cart[$shoe->id]['quantity'] = $quantity;
            }

            $this->saveCart($cart);
        }

        return back()->with('success', 'Koszyk został zaktualizowany.');
    }

    public function remove(Shoe $shoe)
    {
        $cart = $this->getCart();

        if (isset($cart[$shoe->id])) {
            unset($cart[$shoe->id]);
            $this->saveCart($cart);
        }

        return back()->with('success', 'Usunięto produkt z koszyka.');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Koszyk został wyczyszczony.');
    }
}
