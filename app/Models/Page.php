<?php

namespace App\Models;

class Page extends \TCG\Voyager\Models\Page
{

    protected $translatable = ['title', 'slug', 'body', 'excerpt', 'page_image', 'seo_title', 'meta_description', 'meta_keywords', 'status', 'author'];

}
