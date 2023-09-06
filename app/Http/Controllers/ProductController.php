<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends VoyagerBaseController
{
    public function show(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        // Custom logic here, if needed

        return view('products.show', compact('product'));
    }
}
