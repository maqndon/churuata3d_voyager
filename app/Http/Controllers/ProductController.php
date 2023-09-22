<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends VoyagerBaseController
{
    public function show(Request $request, $slug)
    {
        //product
        $product = Product::where('slug', $slug)->first();

        //products downloads
        $downloads = $product->product_downloads->count();

        //Product print settings
        $print_settings = $product->print_settings()->get();

        //Bill of Materials
        $bom = $product->bill_of_materials()->get();
        $bill_of_materials = $bom->pluck('item');

        //product licence
        $licence = $product->licence()->first();

        return view('products.show', compact(
            'product',
            'downloads',
            'print_settings',
            'bill_of_materials',
            'licence'
        ));
    }
}
