<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){
        $products= Product::with('category','brand','product_images')->get();
        $brands= Brand::get();
        $categories= Category::get();
        
        return Inertia::render('Admin/Product/Index',['products'=>$products, 'brands'=>$brands, 'categories'=>$categories]);
    }

    public function store(Request $request){
        $product = new product;
        $product->title= $request->title;
        $product->price= $request->price;
        $product->quantity= $request->quantity;
        $product->description= $request->description;
        $product->category_id= $request->category_id;
        $product->brand_id= $request->brand_id;
        $product->save();


        //check whether the product has images uploaded

        if($request->hasFile('product_images'))
        {
            $productImages = $request->file('product_images');
            foreach($productImages as $image)
            {
                //Generate a unique name for the image using timestamp and random string
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                //Store the image in the public folder with the unique name
                $image->move('product_images',$uniqueName);
                
                //Create a new product image record with the product_id and unique name
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'product_images/' . $uniqueName,
                ]);
        
            }
        }
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
            


    }

    //update 
    public function update(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        // dd($product);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        // Check if product images were uploaded
        if ($request->hasFile('product_images')) {
            $productImages = $request->file('product_images');
            
            // Loop through each uploaded image
            foreach ($productImages as $image) {
                // Generate a unique name for the image using timestamp and random string
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();

                // Store the image in the public folder with the unique name
                $image->move('product_images', $uniqueName);

                // Create a new product image record with the product_id and unique name
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'product_images/' . $uniqueName,
                ]);
            }
        }
        $product->update();
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function deleteImage($id){
        $image = ProductImage::where('id',$id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Image is deleted successfully');

    }
    
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

}

