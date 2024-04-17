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
    
    // csv upload

    public function import(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
    
        foreach ($fileContents as $line) {
            $data = str_getcsv($line);
    
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
        }
    
        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }
    


}

  
