<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
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

}
