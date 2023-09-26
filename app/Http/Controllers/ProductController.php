<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends VoyagerBaseController
{
    public function show(Request $request, $slug)
    {
        //product
        $product = Product::where('slug', $slug)->first();

        //products downloads
        $downloads = $product->product_downloads->count();

        //product print settings
        $print_settings = $product->print_settings()->get();

        //bill of materials
        $bom = $product->bill_of_materials()->get();
        $bill_of_materials = count($bom) != 0  ? $bom->pluck('item') : false;

        //product licence
        $licence = $product->licence()->first();

        //product tags
        $tagsArray = $product->tags()->get();
        $tags = $tagsArray->pluck('slug');

        //product categories
        $categoriesArray = $product->categories()->get();
        $categories = $categoriesArray->pluck('name');

        //related products

        return view('products.show', compact(
            'product',
            'downloads',
            'print_settings',
            'bill_of_materials',
            'licence',
            'tags',
            'categories'
        ));
    }
}
