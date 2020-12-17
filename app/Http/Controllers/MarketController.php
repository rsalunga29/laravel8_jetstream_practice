<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class MarketController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return Inertia::render('Market', ['products' => $products]);
    }

    public function createProduct(Request $request)
    {
        $randomizer = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $data = $request->validate([
            'name' => ['required'],
            'price' => ['required', 'min:0'],
            'quantity' => ['required', 'min:0'],
        ]);

        $data['reference_number'] = 'TST-' . substr(str_shuffle($randomizer), 0, 5);

        $product = new Product($data);
        $product->save();

        return redirect()->route('market.index');
    }

    public function updateProduct(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => ['required'],
            'price' => ['required', 'min:0'],
            'quantity' => ['required', 'min:0'],
        ]);

        $product = Product::findOrFail($id);
        // $product->name = $data['name'];
        // $product->price = $data['price'];
        // $product->quantity = $data['quantity'];
        $product->update($data);

        return redirect()->route('market.index');
    }

    public function deleteProduct(int $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('market.index');
    }
}
