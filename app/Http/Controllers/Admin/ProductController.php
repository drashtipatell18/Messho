<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);
    
        $path = $request->file('csv_file')->getRealPath();
    
        try {
            $fileHandle = fopen($path, 'r');
            if (!$fileHandle) {
                throw new Exception("File could not be opened.");
            }
    
            $headers = fgetcsv($fileHandle);  // Reading the header row
         
            while (($row = fgetcsv($fileHandle)) !== FALSE) {
                $data = array_combine($headers, $row);
             
                // Add validation log to see what data is being processed
                Log::debug('Processing row:', $data);
    
                $validator = Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'color' => 'required|string|max:255',
                    'size' => 'required|string|max:255',
                    'price' => 'required|numeric',
                    'mrp' => 'required|numeric',
                    'category' => 'required|string|max:255',
                    'description' => 'string|nullable',
                    'main_image' => 'string|nullable',
                    'sub_image' => 'string|nullable',
                ]);
    //    echo '<pre>';
    //             print_r($validator);
    //             echo '</pre>';exit;
                if ($validator->fails()) {
                    // Log validation errors to understand what went wrong
                    Log::warning('Validation failed for row:', $validator->errors()->toArray());
                    continue;
                }
    
                // Product::create($validator->validated());
                Product::create([
                    'name' => $validator->validated()['name'],
                    'color' => $validator->validated()['color'],
                    'size' => $validator->validated()['size'],
                    'price' => $validator->validated()['price'],
                    'mrp' => $validator->validated()['mrp'],
                    'category' => $validator->validated()['category'],
                    'description' => $validator->validated()['description'],
                    'main_image' => $validator->validated()['main_image'],
                    'sub_image' => $validator->validated()['sub_image'],
                    // Add other fields similarly
                ]);
                
            }
    
            fclose($fileHandle);
        } catch (\Exception $e) {
            Log::error('Error processing CSV file:', ['exception' => $e->getMessage()]);
            return back()->withErrors('Error processing CSV file: ' . $e->getMessage());
        }
    
        return back()->with('success', 'Products imported successfully!');
    }
    
   
}

  
