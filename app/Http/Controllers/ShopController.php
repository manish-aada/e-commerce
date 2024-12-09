<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;

class ShopController extends Controller
{
	public function index()
	{
		$products = Product::all();
		return view('shop.index', compact('products'));
	}

	public function list()
	{
		return Product::all();
	}

	public function details($id)
	{
		$product = Product::findOrFail($id);
		return view('shop.details', compact('product'));
	}

	public function addToCart(Request $request)
	{
		$validated = $request->validate([
			'product_id' => 'required|exists:products,id',
			'quantity' => 'required|integer|min:1',
		]);

		$user = auth()->user();

		$cartItem = CartItem::where('user_id', $user->id)
							->where('product_id', $validated['product_id'])
							->first();

		if ($cartItem) {
			$cartItem->quantity += $validated['quantity'];
			$cartItem->save();
		} else {
			CartItem::create([
				'user_id' => $user->id,
				'product_id' => $validated['product_id'],
				'quantity' => $validated['quantity'],
			]);
		}

		return response()->json(['message' => 'Product added to cart successfully!'], 200);
	}

	public function cart()
	{
		
		$cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();
		$total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

		return view('shop.cart', compact('cartItems', 'total'));
	}

	

	protected function invalidJson($request, ValidationException $exception)
	{
		return response()->json([
			'message' => $exception->getMessage(),
			'errors' => $exception->errors(),
		], $exception->status);
	}

	public function update(Request $request, $id)
	{
		$request->validate(['quantity' => 'required|integer|min:1']);
		$cartItem = CartItem::findOrFail($id);
		$cartItem->quantity = $request->quantity;
		$cartItem->save();

		return redirect()->route('cart')->with('success', 'Cart updated successfully.');
	}

	public function remove($id)
	{
		$cartItem = CartItem::findOrFail($id);
		$cartItem->delete();

		return redirect()->route('cart')->with('success', 'Item removed from cart.');
	}

	public function showCheckoutForm()
	{
		$cartItems = auth()->user()->cartItems; 
		$total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

		return view('shop.checkout', compact('cartItems', 'total'));
	}

	public function checkout(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'address' => 'required|string',
			'contact' => 'required|string|max:10',
			'payment_method' => 'required|in:cod',
		]);

		$cartItems = auth()->user()->cartItems;

		if ($cartItems->isEmpty()) {
			return redirect()->route('cart')->with('error', 'Your cart is empty.');
		}

		
		$order = Order::create([
			'user_id' => auth()->id(),
			'name' => $request->name,
			'address' => $request->address,
			'contact' => $request->contact,
			'payment_method' => $request->payment_method,
			'total' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
			'status' => 'pending', 
		]);

		
		foreach ($cartItems as $item) {
			$order->orderItems()->create([
				'product_id' => $item->product_id,
				'quantity' => $item->quantity,
				'price' => $item->product->price,
			]);
		}

		auth()->user()->cartItems()->delete();

		return redirect()->route('profile')->with('success', 'Your order has been placed successfully!');
	}

}
