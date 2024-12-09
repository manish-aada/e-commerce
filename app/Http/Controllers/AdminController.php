<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User; 
use App\Models\Order; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('role:admin'); 
	}

	
	public function index()
	{   
		$customersCount = User::role('customer')->count();
		$vendorsCount = User::role('vendor')->count();     
		$productsCount = Product::count();
		$ordersCount = Order::count();
		return view('admin.dashboard', compact('customersCount', 'vendorsCount', 'productsCount', 'ordersCount'));
	}

	
	public function listCustomers()
	{
		$customers = User::where('role', 'customer')->get();
		return view('admin.customers.index', compact('customers'));
	}

	
	public function listVendors()
	{
		$vendors = User::where('role', 'vendor')->get();
		return view('admin.vendors.index', compact('vendors'));
	}

	
	public function listProducts()
	{
		$products = Product::all();
		return view('admin.products.index', compact('products'));
	}

	
	public function listOrders()
	{
		$orders = Order::with(['orderItems','orderItems.product'])->get();
		return view('admin.orders.index', compact('orders'));
	}

	
	public function listTransactions()
	{
		$transactions = Transaction::all();
		return view('admin.transactions.index', compact('transactions'));
	}

	
	public function addEditProduct($id = null)
	{
		$product = $id ? Product::findOrFail($id) : null;
		return view('admin.products.add_edit', compact('product'));
	}

	
	public function saveProduct(Request $request, $id = null)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'price' => 'required|numeric',
			'quantity' => 'required|integer',
			'description' => 'nullable|string',
		]);

		$product = $id ? Product::findOrFail($id) : new Product();
		$product->name = $request->name;
		$product->price = $request->price;
		$product->quantity = $request->quantity;
		$product->description = $request->description;
		$product->save();

		return redirect()->route('admin.products')->with('success', 'Product saved successfully');
	}

	
	public function deleteProduct($id)
	{
		$product = Product::findOrFail($id);
		$product->delete();

		return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
	}
}
