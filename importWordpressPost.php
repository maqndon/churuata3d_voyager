<?php

// Include the necessary Laravel Voyager models and File facade
use App\Models\Tag;
use TCG\Voyager\Models\Post;
use App\Models\Media;
use TCG\Voyager\Models\Category;
use Illuminate\Support\Facades\File;

// Load the XML file containing the exported WordPress posts
$xml = simplexml_load_file('C:\Users\caraballo\Documents\programacion\laravel\wordpress\posts.xml');

// Loop through each post in the XML file
foreach ($xml->channel->item as $item) {
    // Extract the necessary data from the XML
    $title = $item->title;
    $content = $item->description;
    
    // Create a new Voyager Post
    $post = new Post();
    $post->title = $title;
    $post->body = $content;
    
    // Set SEO-related fields
    $post->meta_description = $item->meta_description;
    $post->meta_keywords = $item->meta_keywords;
    // Add any other SEO-related fields you need
    
    // Set any other necessary post properties
    
    // Save the post to the database
    $post->save();
    
    // If the post has categories
    if (!empty($item->category)) {
        // Loop through each category and associate it with the post
        foreach ($item->category as $categoryName) {
            // Find or create the category
            $category = Category::firstOrCreate(['name' => $categoryName]);
            // Associate the category with the post
            $post->categories()->attach($category);
        }
    }
    
    // If the post has tags
    if (!empty($item->tag)) {
        // Loop through each tag and associate it with the post
        foreach ($item->tag as $tagName) {
            // Find or create the tag
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            // Associate the tag with the post
            $post->tags()->attach($tag);
        }
    }
    
    // If the post has images
    if (!empty($item->image)) {
        // Loop through each image and import/associate it with the post
        foreach ($item->image as $imageURL) {
            // Download the image from the URL
            $imagePath = storage_path('app/public/posts') . '/' . basename($imageURL);
            file_put_contents($imagePath, file_get_contents($imageURL));
            
            // Associate the image with the post
            $post->image = 'posts/' . basename($imageURL);
            $post->save();
        }
    }
    
    // If the post has zip files or STL files
    if (!empty($item->attachment)) {
        // Loop through each attachment and import/associate it with the post
        foreach ($item->attachment as $attachmentURL) {
            // Download the attachment from the URL
            $attachmentPath = storage_path('app/public/posts') . '/' . basename($attachmentURL);
            file_put_contents($attachmentPath, file_get_contents($attachmentURL));
            
            // Create a new Voyager Media object
            $media = new Media([
                'file_name' => basename($attachmentURL),
                'original_name' => basename($attachmentURL),
                'mime_type' => 'application/octet-stream',
                'disk' => 'public',
                'path' => 'posts/' . basename($attachmentURL),
                'url' => asset('storage/posts/' . basename($attachmentURL)),
            ]);
            
            // Save the media to the database and associate it with the post
            $post->media()->save($media);
        }
    }
}

echo 'Posts imported successfully!';
