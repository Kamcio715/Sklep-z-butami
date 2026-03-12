<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Koszyk jest pusty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Koszyk jest pusty.');
        }

        $data = $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'nullable|string|max:50',
            'address'        => 'required|string|max:500',
        ]);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        Order::create([
            'user_id'        => Auth::id(),
            'customer_name'  => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'] ?? null,
            'address'        => $data['address'],
            'total'          => $total,
            'items'          => $cart,
        ]);

        session()->forget('cart');

        return redirect()->route('orders.my')->with('success', 'Zamówienie zostało złożone.');
    }

    public function myOrders()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $orders = $user->orders()->latest()->paginate(10);

        return view('orders.my', compact('orders'));
    }
}
