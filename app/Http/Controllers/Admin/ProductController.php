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
    
            // Generate unique filenames for main and sub images
            $mainImageName = time() . '.' . $file->getClientOriginalExtension();
            $subImageName = time(). '.' . $file->getClientOriginalExtension();
    
            // Store main image
            $mainImagePath = $file->storeAs('csvfile', $mainImageName, 'public');
    
            // Store sub image
            $subImagePath = $file->storeAs('csvfile', $subImageName, 'public');
    
            // Remove 'images/' prefix from file paths
            $mainImagePath = str_replace('csvfile/', '', $mainImagePath);
            $subImagePath = str_replace('csvfile/', '', $subImagePath);
    
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
        }
    
        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }
}

  
