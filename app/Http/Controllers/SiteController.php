<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __construct()
    {
        $categories = Category::all();
        view()->share('categories', $categories);
        $products = Product::all();
        view()->share('products', $products);
    }
    public function index()
    {
        return view('site.index');
    }
    public function shop(Request $request)
    {
        $categorySlug = $request->query('category');
        $searchTerm = $request->query('search');
    
        $query = Product::query();
    
        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }
    
        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }
    
        $products = $query->get();
        $categories = Category::all();
    
        return view('site.shop', compact('products', 'categories'));
    }
    
    public function productDetail($category, $slug)
{
    $product = Product::with('category')->where('slug', $slug)->firstOrFail();
    

    if (!$product->category) {
    
        return redirect()->route('site.shop')->with('error', 'This product does not belong to a valid category.');
    }
    
    $relatedProducts = Product::where('category_id', $product->category_id)
                               ->where('id', '!=', $product->id)
                               ->limit(4)
                               ->get();

    return view('site.productdetail', compact('product', 'relatedProducts'));
}
public function categoryslug($slug)
{
    $category = Category::where('slug', $slug)->first();
    
    if (!$category) {
        abort(404);
    }
    
    $products = $category->products;

    return view('site.shop', compact('category', 'products'));
}

public function showProductsByCategory($id)
{
    $category = Category::with(['subCategories.products'])->findOrFail($id);

    $products = $category->subCategories->flatMap(function ($subCategory) {
        return $subCategory->products;
    });

    return view('site.shop', compact('category', 'products'));
}

public function add_cart($id)
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'You must be logged in to add products to the cart.');
    }

    // Check if the product exists
    $product = Product::find($id);
    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }

    // Check if the product is already in the user's cart
    $cartItem = Cart::where('user_id', $user->id)
                    ->where('product_id', $id)
                    ->first();

    if ($cartItem) {
        // If the product is already in the cart, increase the quantity
        $cartItem->quantity += 1;
        $cartItem->save();

        return redirect()->back()->with('success', 'Product quantity updated in the cart.');
    } else {
        // If the product is not in the cart, create a new cart entry
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->product_id = $id;
        $cart->save();

        return redirect()->back()->with('success', 'Product added to cart.');
    }
}




}
