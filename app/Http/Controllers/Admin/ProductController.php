<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function products(){
        // $products = Product::all();
        $columns = Schema::getColumnListing('products');
        return view('admin.view_product',compact('columns'));
    }
    
    // csv upload
    public function uploadCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);
    
        $file = $request->file('csv_file');
    
        // Parse CSV file
        $csvData = array_map('str_getcsv', file($file));
    
        // Remove header row if necessary
        $headers = array_shift($csvData);
    
        // Iterate over each row and save to the database
        foreach ($csvData as $row) {
            $product = new Product();
    
            // Check if all elements in the row are strings
            if (count(array_filter($row, 'is_string')) !== count($row)) {
                // Skip this row if not all elements are strings
                continue;
            }
    
            $product->name = ;
            $product->color = $row[1] ?? null;
            $product->size = $row[2] ?? null;
            $product->price = $row[3] ?? null;
            $product->mrp = $row[4] ?? null;
            $product->category = $row[5] ?? null;
            $product->description = $row[6] ?? null;
            $product->main_image = $row[7] ?? null;
            $product->sub_image = $row[8] ?? null;
            // Add more fields as needed
            $product->save();
        }
    
        return view('admin.view_product');
    }
    

 
   
}

  
