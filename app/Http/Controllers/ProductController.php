<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $categories = Category::all();
        view()->share('categories', $categories);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        
        ]);

        
        $destinationPath = 'images'; 
        $myimage = $request->image->getClientOriginalName(); 
        $request->image->move(public_path($destinationPath), $myimage); 

        
        $product = new Product();
        $product->name = $request->name;
        $product->slug= Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id; 
        $product->image = $myimage;

        
        $product->save();

        
        return redirect()->route('admin.product.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    
        $product = Product::findOrFail($id);
        
        
        return view('product.detail', compact('product'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            if (file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image));
            }
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        if (file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }
        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully!');
    }
}
