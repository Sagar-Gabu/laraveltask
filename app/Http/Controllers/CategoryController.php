<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { {
            $categories = Category::all();
            return view('admin.category.index', compact('categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { {
            return view('admin.category.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'name' => 'required|max:255|min:3',
                'image' => 'required',
            ]);

            $destinationPath = 'images'; //folder store
            $myimage = $request->image->getClientOriginalName(); //get file name
            $request->image->move(public_path($destinationPath), $myimage); //move to folder image



            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->image = $myimage;
            $category->save();
            return redirect()->route('admin.category.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    { {
            // $category = Category::where('id',$id)->first();
            return view('admin.category.edit', compact('category'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);


        $request->validate([
            'name' => 'required|max:255|min:3',
            'image' => 'nullable|jpeg,png,jpg',
        ]);

        $destinationPath = 'images'; //folder store
        $myimage = $request->image->getClientOriginalName(); // get file name
        $request->image->move(public_path($destinationPath), $myimage); // move to folder image

        $category->image = $myimage;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'category updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->products()->delete();
        $category->delete();

        return redirect()->back()->with('success', 'Category and related products deleted successfully.');
    }
}
