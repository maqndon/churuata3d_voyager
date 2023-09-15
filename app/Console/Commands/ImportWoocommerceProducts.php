<?php

namespace App\Console\Commands;

use App\Models\Seo;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSale;
use Illuminate\Console\Command;
use App\Models\PrintingMaterial;
use App\Models\PrintSetting;
use App\Models\PrintSupportsRaft;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Storage;

class ImportWoocommerceProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:woocommerce';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from Woocommerce XML';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // Path to your XML file
        $xmlFilePath = 'public\products.xml';

        // Load the XML file
        $xml = simplexml_load_file($xmlFilePath);

        // Iterate over each product in the XML
        foreach ($xml->children() as $productData) {
            // Extract product attributes from XML
            $title = (string) $productData->title;
            $slug = (string) $productData->post_name;
            $sku = (string) $productData->post_name;
            $stock = (int) $productData->stock;

            // if the product is featured 
            if ($productData->xpath('category[@domain="product_visibility"]')) {
                $featured = (string)$productData->xpath('category[@domain="product_visibility"]')[0];
            }

            $featured = $featured === 'featured' ? 'FEATURED' : null;

            $status = (string) $productData->status;

            // Store the HTML content as CDATA in the database
            $body = $productData->content->asXML();

            // Remove <content> tags using regex
            $body = preg_replace('/<content>(.*?)<\/content>/s', '$1', $body);

            $excerpt = $productData->excerpt->asXML();

            // Remove <excerpt> tags using regex
            $excerpt = preg_replace('/<excerpt>(.*?)<\/excerpt>/s', '$1', $excerpt);

            $gallery = explode(',', (string) $productData->images);

            $materials = $productData->Print_Settings->materials;
            $settings = $productData->Print_Settings->settings;
            $supports = $productData->Print_Settings->supports;
            $raft = $productData->Print_Settings->raft;
            $is_parametric = $productData->is_parametric ? (boolean)$productData->is_parametric : false;
            $related_parametric = $productData->related_parametric;

            // Product licence
            $licence = $productData->licence;

            // Extract Data inside the postmeta tags

            $metaDescription = null;
            $seoTitle = null;
            $price = null;
            $salePrice = null;
            $totalSales = null;
            $virtual = null;
            $downloadable = null;

            foreach ($productData->postmeta as $meta) {
                $metaKey = (string) $meta->meta_key;
                $metaValue = (string) $meta->meta_value;

                if ($metaKey === 'regular_price') {
                    $metaValue ? $price : null;
                }

                if ($metaKey === 'sale_price') {
                    $metaValue ? $salePrice : null;
                }

                if ($metaKey === 'total_sales') {
                    $totalSales = $metaValue;
                }

                if ($metaKey === 'virtual') {
                    switch ($metaValue) {
                        case 'yes':
                            $virtual = true;
                            break;
                        case 'no':
                            $virtual = false;
                            break;
                        default:
                            $virtual = true;
                            break;
                    }
                }

                if ($metaKey === 'downloadable') {
                    switch ($metaValue) {
                        case 'yes':
                            $downloadable = true;
                            break;
                        case 'no':
                            $downloadable = false;
                            break;
                        default:
                            $downloadable = true;
                            break;
                    }
                }

                if ($metaKey === 'meta_description') {
                    $metaDescription = $metaValue;
                }

                if ($metaKey === 'seo_title') {
                    $seoTitle = $metaValue;
                }
            }

            // Create a new product entry in Voyager
            $newProduct = new Product();
            $newProduct->title = $title;
            $newProduct->slug = $slug;
            $newProduct->sku = $sku;
            $newProduct->price = $price;
            $newProduct->sale_price = $salePrice;
            $newProduct->stock = $stock;
            $newProduct->excerpt = $excerpt;
            $newProduct->body = $body;
            $newProduct->status = $status;
            $newProduct->featured = $featured;
            $newProduct->virtual = $virtual;
            $newProduct->downloadable = $downloadable;
            $newProduct->is_parametric = $is_parametric;
            $newProduct->related_parametric = $related_parametric;
            $newProduct->save();

            // Product's Bill of Materials (BOM)
            $bill_of_materials = $productData->bill_of_materials;

            if ($bill_of_materials) {

                // Create an array to store unique BOM entries
                $dataBom = [];

                foreach ($bill_of_materials->li as $bom) {
                    $item = (string)$bom;
            
                    // Check if the item is not already in $dataBom
                    if (!in_array($item, $dataBom)) {
                        $dataBom[] = $item;
            
                        // Insert data into the table
                        DB::table('product_bill_of_materials')->insert([
                            'product_id' => $newProduct->id,
                            'item' => $item,
                        ]);
                    }
                }
            }

            // Product printing materials
            $this->storePivot($newProduct->id, 'printing_materials_id', 'name', $materials, 'product_printing_materials', 'printing_materials');

            // Product printing settings
            $this->storePivot($newProduct->id, 'print_settings_id', 'print_strength', $settings, 'product_print_settings', 'print_settings');

            // Product Licence
            $this->storePivot($newProduct->id, 'licences_id', 'name', $licence, 'product_licence', 'licences');

            // Product supports raft
            $supportRaft = new PrintSupportsRaft();
            $supportRaft->product_id = $newProduct->id;
            $supportRaft->supports = (boolean)$supports;
            $supportRaft->raft = (boolean)$raft;
            $supportRaft->save();

            $this->info("Product imported: $title");

            // Assign tags to the product
            foreach ($productData->category as $category) {
                $domain = (string) $category['domain'];
                $categoryName = (string) $category;

                if ($domain === 'product_tag') {
                    $tag = Tag::firstOrCreate(['name' => $categoryName]);

                    if ($tag) {
                        // Attach the existing tag to the product
                        $newProduct->tags()->attach($tag->id);
                    }
                }
            }

            // Attach existing categories with domain "product_cat"
            foreach ($productData->category as $category) {
                $domain = (string) $category['domain'];
                $categoryName = (string) $category;

                if ($domain === 'product_cat') {
                    // Find or create the category by name
                    $categoryId = DB::table('categories')
                        ->where('name', $categoryName)
                        ->value('id');

                    if (!$categoryId) {
                        // Category doesn't exist, create it
                        $categoryId = DB::table('categories')
                            ->insertGetId(['name' => $categoryName]);
                    }

                    // Attach the product category to the product
                    DB::table('product_categories')->insert([
                        'product_id' => $newProduct->id,
                        'category_id' => $categoryId,
                    ]);
                }
            }

            //Product Total Sales
            $sale = new ProductSale();
            $sale->product_id = $newProduct->id;
            $sale->total = $totalSales;
            $sale->save();

            // Create SEO entry for the product
            $seo = new Seo();
            $seo->seoable_type = 'App\Models\Product';
            $seo->seoable_id = $newProduct->id;
            $seo->title = $seoTitle != null ? $seoTitle : '';
            $seo->meta_description = $metaDescription != null ? $metaDescription : '';
            $seo->save();


            // Handle product images
            //     foreach ($gallery as $imageUrl) {
            //         // Download the image
            //         $imageName = basename($imageUrl);
            //         $imageContents = file_get_contents($imageUrl);
            //         $storagePath = 'products/' . $imageName;
            //         Storage::disk('public')->put($storagePath, $imageContents);

            //         // Save the image path in Voyager
            //         $newProduct->addMedia(storage_path('app/public/' . $storagePath))
            //             ->usingName($imageName)
            //             ->toMediaCollection('images');
            //     }
        }

        $this->info('Import completed.');
    }

    private function storePivot($product_id, $foreign_id, $foreign_column, $data, $pivot_table, $table_foreign_id)
    {
        // Product printing materials

        // Split the material string into an array
        $items = explode(',', $data);

        // Create an array of materials
        $dataArray = [];

        foreach ($items as $item) {

            // Perform a lookup to get the material_id based on the material_name
            $colum_name_id = DB::table($table_foreign_id)->where($foreign_column, $item)->value('id');

            $dataArray[] = [
                'product_id' => $product_id,
                $foreign_id => $colum_name_id,
            ];

            // Insert data into the product_printing_materials table
            DB::table($pivot_table)->insert($dataArray);
        }
    }
}
