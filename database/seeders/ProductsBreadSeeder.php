<?php

namespace Database\Seeders;

use TCG\Voyager\Models\Menu;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;

class ProductsBreadSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        //Data Type
        $dataType = $this->dataType('name', 'products');
        if (!$dataType->exists) {
            $dataType->fill([
                'slug'                  => 'products',
                'display_name_singular' => __('voyager::seeders.data_types.product.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.product.plural'),
                'icon'                  => 'voyager-archive',
                'model_name'            => 'App\\Models\\Product',
                'controller'            => 'App\\Http\\Controllers\\ProductController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
        //Data Rows
        $productDataType = DataType::where('slug', 'products')->firstOrFail();
        $dataRow = $this->dataRow($productDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.title'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                // 'details'      => [
                //     'default' => '',
                //     'null'    => '',
                //     'options' => [
                //         '' => '-- None --',
                //     ],
                //     'relationship' => [
                //         'key'   => 'id',
                //         'label' => 'name',
                //     ],
                // ],
                'order' => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'slug');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.slug'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order' => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'sku');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.sku'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'stock');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.stock'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'price');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.price'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'categories');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'json',
                'display_name' => __('voyager::seeders.data_rows.category'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'tags');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'json',
                'display_name' => __('voyager::seeders.data_rows.tags'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'seo_title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'string',
                'display_name' => __('voyager::seeders.data_rows.seo_title'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'seo_description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'string',
                'display_name' => __('voyager::seeders.data_rows.seo_description'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 10,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'image_urls');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'json',
                'display_name' => __('voyager::seeders.data_rows.image_urls'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 11,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 12,
            ])->save();
        }

        $dataRow = $this->dataRow($productDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 13,
            ])->save();
        }

        //Menu Item
        $menu = Menu::where('name', 'admin')->firstOrFail();
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.products'),
            'url'     => '',
            'route'   => 'voyager.products.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-archive',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 7,
            ])->save();
        }

        //Permissions
        Permission::generateFor('products');
        //Content
        // $page = Product::firstOrNew([
        //     'slug' => 'product_test',
        // ]);
        // if (!$page->exists) {
        //     $page->fill([
        //         'name'     => 'Product Test',
        //         'slug'   => 'product_test',
        //         'sku'      => '1992283',
        //         'stock'            => 'yes',
        //         'price' => 10,
        //     ])->save();
        // }
    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}