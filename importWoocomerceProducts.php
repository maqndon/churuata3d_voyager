<?php

use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Seo;

// Path to your XML file
$xmlFilePath = 'C:/Users/caraballo/Documents/programacion/laravel/wordpress/products.xml';

// Load the XML file
$xml = simplexml_load_file($xmlFilePath);

// Iterate over each product in the XML
foreach ($xml->product as $productData) {
    // Extract product attributes from XML
    $title = (string) $productData->title;
    $slug = (string) $productData->slug;
    $sku = (string) $productData->sku;
    $stock = (int) $productData->stock;
    $price = (float) $productData->price;
    $categories = explode(',', (string) $productData->categories);
    $tags = explode(',', (string) $productData->tags);
    $seoTitle = (string) $productData->seo_title;
    $seoDescription = (string) $productData->seo_description;
    $imageUrls = explode(',', (string) $productData->images);

    // Create a new product entry in Voyager
    $newProduct = new Product();
    $newProduct->name = $title;
    $newProduct->slug = $slug;
    $newProduct->sku = $sku;
    $newProduct->stock = $stock;
    $newProduct->price = $price;
    $newProduct->save();

    // Assign categories to the product
    foreach ($categories as $categoryName) {
        $category = Category::where('name', $categoryName)->first();
        if ($category) {
            $newProduct->categories()->attach($category->id);
        }
    }

    // Assign tags to the product
    foreach ($tags as $tagName) {
        $tag = Tag::where('name', $tagName)->first();
        if ($tag) {
            $newProduct->tags()->attach($tag->id);
        }
    }

    // Create SEO entry for the product
    $seo = new Seo();
    $seo->seoable_type = 'App\Models\Product';
    $seo->seoable_id = $newProduct->id;
    $seo->title = $seoTitle;
    $seo->meta_description = $seoDescription;
    $seo->save();

    // Handle product images
    foreach ($imageUrls as $imageUrl) {
        // Download the image
        $imageName = basename($imageUrl);
        $imageContents = file_get_contents($imageUrl);
        $storagePath = 'products/' . $imageName;
        Storage::disk('public')->put($storagePath, $imageContents);

        // Save the image path in Voyager
        $newProduct->addMedia(storage_path('app/public/' . $storagePath))
            ->usingName($imageName)
            ->toMediaCollection('images');
    }
}

