<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function products(){
        $products = Product::all();
        $columns = Schema::getColumnListing('products');
        return view('admin.view_product',compact('products','columns'));
    }

    public function productCreate(){
        return view('admin.create_product');
    }
    
    public function productInsert(Request $request){
        $request->validate([
            'name' => 'required',
            'color' => 'required',
            'size' => 'required',
            'price' => 'required', 
            'mrp' => 'required', 
            'category' => 'required', 
        ]);

        $filename = '';
        if ($request->hasFile('main_image')){
            $image = $request->file('main_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
        }

        if ($request->hasFile('sub_images')) {
            $subimages = [];
    
            foreach ($request->file('sub_images') as $file) {
                $subImageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    
                $file->move('images', $subImageName);
    
                // Add the filename to the array
                $subimages[] = $subImageName;
            }
            $jsonFilenames = json_encode($subimages);
            $product = Product::create([
                'name'        => $request->input('name'),
                'color'       => $request->input('color'),
                'size'        => $request->input('size'),
                'price'       => $request->input('price'), 
                'mrp'         => $request->input('mrp'), 
                'category'    => $request->input('category'), 
                'description' => $request->input('description'), 
                'main_image'  => $filename,
                'sub_image'   => $jsonFilenames
            ]);

            session()->flash('success', 'Product added successfully!');
            return redirect()->route('products');
        }
    }
    public function productEdit($id){
        $products = Product::find($id);
        return view('admin.create_product',compact('products'));
    }
    
    public function productUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'required',
            'size' => 'required',
            'price' => 'required', 
            'mrp' => 'required', 
            'category' => 'required', 
        ]);
    
        $product = Product::find($id);
        if (!$product) {
            session()->flash('error', 'Product not found!');
            return redirect()->route('products');
        }
    
        $dataToUpdate = [
            'name'        => $request->input('name'),
            'color'       => $request->input('color'),
            'size'        => $request->input('size'),
            'price'       => $request->input('price'), 
            'mrp'         => $request->input('mrp'), 
            'category'    => $request->input('category'), 
            'description' => $request->input('description'),
        ];
    
        if ($request->hasFile('main_image')){
            $image = $request->file('main_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
            $dataToUpdate['main_image'] = $filename;
        }
    
        if ($request->hasFile('sub_images')) {
            $subimages = [];
            foreach ($request->file('sub_images') as $file) {
                $subImageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move('images', $subImageName);
                $subimages[] = $subImageName;
            }
            $dataToUpdate['sub_images'] = json_encode($subimages);
        }
    
        $product->update($dataToUpdate);
        session()->flash('success', 'Product updated successfully!');
        return redirect()->route('products');
    }
    

    public function productDestroy($id){
        $products = Product::find($id);
        $products->delete();
        return redirect()->back();
        session()->flash('danger', 'Product Delete successfully!');
    }
    // csv upload

    public function import(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
    
        foreach ($fileContents as $line) {
            $data = str_getcsv($line);

            $mainImageUrl = $data[7];
            $subImageUrl = $data[8];
    

            // Get file extensions from image URLs
            $mainImageExtension = pathinfo($data[7], PATHINFO_EXTENSION);
            $subImageExtension = pathinfo($data[8], PATHINFO_EXTENSION);
    
            // Generate unique filenames for main and sub images with original extensions
            $mainImageName = time() . '_main.' . $mainImageExtension;
            $subImageName = time() . '_sub.' . $subImageExtension;
    
            // Initialize image paths to null
            $mainImagePath = null;
            $subImagePath = null;
    
            // Store main image if URL is valid
           // Store main image if URL is valid
        if (filter_var($data[7], FILTER_VALIDATE_URL)) {
            $mainImagePath = Storage::putFileAs('csvfile', $data[7], $mainImageName, 'public');
            // Remove 'csvfile/' prefix from the image path
            $mainImagePath = str_replace('csvfile/', '', $mainImagePath);
        } else {
            // Handle invalid URL error (optional)
            Log::error("Invalid main image URL: $data[7]");
        }

        // Store sub image if URL is valid
        if (filter_var($data[8], FILTER_VALIDATE_URL)) {
            $subImagePath = Storage::putFileAs('csvfile', $data[8], $subImageName, 'public');
            // Remove 'csvfile/' prefix from the image path
            $subImagePath = str_replace('csvfile/', '', $subImagePath);
        } else {
            // Handle invalid URL error (optional)
            Log::error("Invalid sub image URL: $data[8]");
        }

    
            // Create product only if both images are successfully stored
            if ($mainImagePath && $subImagePath) {

            $mainImageExtension = pathinfo($mainImageUrl, PATHINFO_EXTENSION);
            $subImageExtension = pathinfo($subImageUrl, PATHINFO_EXTENSION);
    
            $timestamp = time();
            $mainImageName = $timestamp . '_main.' . $mainImageExtension;
            $subImageName = $timestamp . '_sub.' . $subImageExtension;
    
            $mainImagePath = public_path('images/' . $mainImageName);
            $subImagePath = public_path('images/' . $subImageName);
    
            if ($this->downloadImage($mainImageUrl, $mainImagePath) && $this->downloadImage($subImageUrl, $subImagePath)) {
                // Create product since both images are successfully stored

                Product::create([
                    'name' => $data[0],
                    'color' => $data[1],
                    'size' => $data[2],
                    'price' => $data[3],
                    'mrp' => $data[4],
                    'category' => $data[5],
                    'description' => $data[6],
               'main_image' => $mainImagePath,
                    'sub_image' => $subImagePath,
                ]);
            } else {
                // Handle error (optional)
                Log::error("Failed to store one or both images for product: $data[0]");
            }

                    'main_image' => $mainImageName,
                    'sub_image' => $subImageName,
                ]);
            } 

        }
    
        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }
    


}

    /**
     * Helper function to download and save an image from a URL
     */
    private function downloadImage($url, $path)
    {
        try {
            $contents = file_get_contents($url);
            if (false === $contents) {
                throw new \Exception("Failed to download image from {$url}");
            }
            $saved = file_put_contents($path, $contents);
            if (false === $saved) {
                throw new \Exception("Failed to save image to {$path}");
            }
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    
}