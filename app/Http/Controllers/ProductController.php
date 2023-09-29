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

        //products printing material(s)
        $printing_materials = $product->printing_materials()->pluck('name')->toArray();

        // dd($printing_materials);

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

        //common contents, for "all" products the same content
        $common_content = DB::Table('product_common_content')->get();
        $common_contents = [];

        foreach ($common_content as $content) {
            $common_contents[$content->type]=$content->content;
        }

        //related products

        return view('products.show', compact(
            'product',
            'downloads',
            'print_settings',
            'printing_materials',
            'bill_of_materials',
            'licence',
            'tags',
            'categories',
            'common_contents'
        ));
    }
}
