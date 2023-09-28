@include('helpers.material_helpers')

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">

<head>
    <!-- I need to change that -->
    <title>@yield('page_title', setting('admin.title') . ' - ' . setting('admin.description'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- maybe i need to remove that -->
    <meta name="assets-path" content="{{ route('voyager.voyager_assets') }}" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <!-- Favicon -->
    <?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
    @if ($admin_favicon == '')
        <link rel="shortcut icon" href="{{ voyager_asset('images/logo-icon.png') }}" type="image/png">
    @else
        <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/png">
    @endif

    <!-- and this? -->
    @yield('head')

    <!-- Tailwind CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

</head>

<body>
    {{ $product->sku }}
    {{ $product->slug }}
    {{ $product->stock }}
    {{ $product->price }}
    {{ $product->sale_price }}
    {{ $product->status }}
    {{ $product->featured }}
    {{ $product->virtual }}
    {{ $product->downloadable }}
    {{ $product->printable }}
    {{ $product->related_parametric }}

    <div class="product">
        <img src="{{ asset('images/products/' . $product->image_path) }}" alt="{{ $product->name }}" />
        <a href="{{ route('products.index') }}">Back to Products</a>
    </div>
    

    <div class="bg-white">
        <div class="pt-6">
            <nav aria-label="Breadcrumb">
                <ol role="list"
                    class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                    <li>
                        <div class="flex items-center">
                            <a href="#" class="mr-2 text-sm font-medium text-gray-900">Men</a>
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor"
                                aria-hidden="true" class="h-5 w-4 text-gray-300">
                                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                            </svg>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <a href="#" class="mr-2 text-sm font-medium text-gray-900">Clothing</a>
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor"
                                aria-hidden="true" class="h-5 w-4 text-gray-300">
                                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                            </svg>
                        </div>
                    </li>

                    <li class="text-sm">
                        <a href="#" aria-current="page"
                            class="font-medium text-gray-500 hover:text-gray-600">Basic Tee 6-Pack</a>
                    </li>
                </ol>
            </nav>

            <!-- Image gallery -->
            {{-- <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8">
                <div class="aspect-h-4 aspect-w-3 hidden overflow-hidden rounded-lg lg:block">
                    <img src="https://tailwindui.com/img/ecommerce-images/product-page-02-secondary-product-shot.jpg"
                        alt="Two each of gray, white, and black shirts laying flat."
                        class="h-full w-full object-cover object-center">
                </div>
                <div class="hidden lg:grid lg:grid-cols-1 lg:gap-y-8">
                    <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg">
                        <img src="https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-01.jpg"
                            alt="Model wearing plain black basic tee." class="h-full w-full object-cover object-center">
                    </div>
                    <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg">
                        <img src="https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-02.jpg"
                            alt="Model wearing plain gray basic tee." class="h-full w-full object-cover object-center">
                    </div>
                </div>
                <div class="aspect-h-5 aspect-w-4 lg:aspect-h-4 lg:aspect-w-3 sm:overflow-hidden sm:rounded-lg">
                    <img src="https://tailwindui.com/img/ecommerce-images/product-page-02-featured-product-shot.jpg"
                        alt="Model wearing plain white basic tee." class="h-full w-full object-cover object-center">
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div id="product-images-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($product->images as $key => $image)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('images/products/' . $image->image_path) }}" alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#product-images-carousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#product-images-carousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Products</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product info -->
            <div
                class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
                <!-- Title -->
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $product->title }}</h1>
                </div>

                <!-- Options -->
                <div class="mt-4 lg:row-span-3 lg:mt-0">
                    <h2 class="sr-only">Product information</h2>
                    <div>
                        <p class="text-3xl tracking-tight text-gray-900">
                            <!-- I need to do something better here -->
                            @php
                                if ($product->price) {
                                    $product->price . '€';
                                } else {
                                    echo 'Free to download';
                                }
                            @endphp
                        </p>
                    </div>
                    <div>
                        @if ($downloads)
                            <p>{{ $downloads }} times downloaded.</p>
                        @else
                            <p> This Model has not been downloaded.</p>
                        @endif
                        <p></p>
                    </div>
                    <!-- Reviews -->
                    <div class="mt-6">
                        <h3 class="sr-only">Reviews</h3>
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <!-- Active: "text-gray-900", Default: "text-gray-200" -->
                                <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg class="text-gray-200 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="sr-only">4 out of 5 stars</p>
                            <a href="#"
                                class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                117 reviews
                            </a>
                        </div>
                    </div>

                    <!-- categories -->
                    <div class="mt-4">
                        <p class="text-sm">Categories: 
                            @foreach ($categories as $category)
                                <a class="text-indigo-600 hover:text-indigo-500" href="">{{ $category }}</a>
                            @endforeach
                        </p>
                    </div>

                    <!-- tags -->
                    <div class="mt-1">
                        <p class="text-sm">Tags: 
                            @foreach ($tags as $tag)
                                <a class="text-indigo-600 hover:text-indigo-500" href="">{{ $tag }}</a>
                            @endforeach
                        </p>
                    </div>

                    <form class="mt-10">
                        <!-- Colors -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Color</h3>

                            <fieldset class="mt-4">
                                <legend class="sr-only">Choose a color</legend>
                                <div class="flex items-center space-x-3">
                                    <!-- Active and Checked: "ring ring-offset-1" Not Active and Checked: "ring-2" -->
                                    <label
                                        class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none ring-gray-400">
                                        <input type="radio" name="color-choice" value="White" class="sr-only"
                                            aria-labelledby="color-choice-0-label">
                                        <span id="color-choice-0-label" class="sr-only">White</span>
                                        <span aria-hidden="true"
                                            class="h-8 w-8 bg-white rounded-full border border-black border-opacity-10"></span>
                                    </label>
                                    <!-- Active and Checked: "ring ring-offset-1" Not Active and Checked: "ring-2" -->
                                    <label
                                        class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none ring-gray-400">
                                        <input type="radio" name="color-choice" value="Gray" class="sr-only"
                                            aria-labelledby="color-choice-1-label">
                                        <span id="color-choice-1-label" class="sr-only">Gray</span>
                                        <span aria-hidden="true"
                                            class="h-8 w-8 bg-gray-200 rounded-full border border-black border-opacity-10"></span>
                                    </label>
                                    <!-- Active and Checked: "ring ring-offset-1" Not Active and Checked: "ring-2" -->
                                    <label
                                        class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none ring-gray-900">
                                        <input type="radio" name="color-choice" value="Black" class="sr-only"
                                            aria-labelledby="color-choice-2-label">
                                        <span id="color-choice-2-label" class="sr-only">Black</span>
                                        <span aria-hidden="true"
                                            class="h-8 w-8 bg-gray-900 rounded-full border border-black border-opacity-10"></span>
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <!-- Sizes -->
                        <div class="mt-10">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900">Size</h3>
                                <a href="#"
                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Size guide</a>
                            </div>

                            <fieldset class="mt-4">
                                <legend class="sr-only">Choose a size</legend>
                                <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                                    <!-- Active: "ring-2 ring-indigo-500" -->
                                    <label
                                        class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-not-allowed bg-gray-50 text-gray-200">
                                        <input type="radio" name="size-choice" value="XXS" disabled
                                            class="sr-only" aria-labelledby="size-choice-0-label">
                                        <span id="size-choice-0-label">XXS</span>
                                        <span aria-hidden="true"
                                            class="pointer-events-none absolute -inset-px rounded-md border-2 border-gray-200">
                                            <svg class="absolute inset-0 h-full w-full stroke-2 text-gray-200"
                                                viewBox="0 0 100 100" preserveAspectRatio="none"
                                                stroke="currentColor">
                                                <line x1="0" y1="100" x2="100" y2="0"
                                                    vector-effect="non-scaling-stroke" />
                                            </svg>
                                        </span>
                                    </label>
                                    <!-- Active: "ring-2 ring-indigo-500" -->
                                    <label
                                        class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm">
                                        <input type="radio" name="size-choice" value="XS" class="sr-only"
                                            aria-labelledby="size-choice-1-label">
                                        <span id="size-choice-1-label">XS</span>
                                        <!-- Active: "border", Not Active: "border-2" Checked: "border-indigo-500", Not Checked: "border-transparent" -->
                                        <span class="pointer-events-none absolute -inset-px rounded-md"
                                            aria-hidden="true"></span>
                                    </label>
                                    <!-- Active: "ring-2 ring-indigo-500" -->
                                    <label
                                        class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm">
                                        <input type="radio" name="size-choice" value="S" class="sr-only"
                                            aria-labelledby="size-choice-2-label">
                                        <span id="size-choice-2-label">S</span>
                                        <!-- Active: "border", Not Active: "border-2" Checked: "border-indigo-500", Not Checked: "border-transparent" -->
                                        <span class="pointer-events-none absolute -inset-px rounded-md"
                                            aria-hidden="true"></span>
                                    </label>
                                    <!-- Active: "ring-2 ring-indigo-500" -->
                                    <label
                                        class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm">
                                        <input type="radio" name="size-choice" value="M" class="sr-only"
                                            aria-labelledby="size-choice-3-label">
                                        <span id="size-choice-3-label">M</span>
                                        <!-- Active: "border", Not Active: "border-2" Checked: "border-indigo-500", Not Checked: "border-transparent" -->
                                        <span class="pointer-events-none absolute -inset-px rounded-md"
                                            aria-hidden="true"></span>
                                    </label>
                                    <!-- Active: "ring-2 ring-indigo-500" -->
                                    <label
                                        class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm">
                                        <input type="radio" name="size-choice" value="L" class="sr-only"
                                            aria-labelledby="size-choice-4-label">
                                        <span id="size-choice-4-label">L</span>
                                        <!-- Active: "border", Not Active: "border-2" Checked: "border-indigo-500", Not Checked: "border-transparent" -->
                                        <span class="pointer-events-none absolute -inset-px rounded-md"
                                            aria-hidden="true"></span>
                                    </label>
                                    <!-- Active: "ring-2 ring-indigo-500" -->
                                    <label
                                        class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm">
                                        <input type="radio" name="size-choice" value="XL" class="sr-only"
                                            aria-labelledby="size-choice-5-label">
                                        <span id="size-choice-5-label">XL</span>
                                        <!-- Active: "border", Not Active: "border-2" Checked: "border-indigo-500", Not Checked: "border-transparent" -->
                                        <span class="pointer-events-none absolute -inset-px rounded-md"
                                            aria-hidden="true"></span>
                                    </label>
                                    <!-- Active: "ring-2 ring-indigo-500" -->
                                    <label
                                        class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm">
                                        <input type="radio" name="size-choice" value="2XL" class="sr-only"
                                            aria-labelledby="size-choice-6-label">
                                        <span id="size-choice-6-label">2XL</span>
                                        <!-- Active: "border", Not Active: "border-2" Checked: "border-indigo-500", Not Checked: "border-transparent" -->
                                        <span class="pointer-events-none absolute -inset-px rounded-md"
                                            aria-hidden="true"></span>
                                    </label>
                                    <!-- Active: "ring-2 ring-indigo-500" -->
                                    <label
                                        class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm">
                                        <input type="radio" name="size-choice" value="3XL" class="sr-only"
                                            aria-labelledby="size-choice-7-label">
                                        <span id="size-choice-7-label">3XL</span>
                                        <!-- Active: "border", Not Active: "border-2" Checked: "border-indigo-500", Not Checked: "border-transparent" -->
                                        <span class="pointer-events-none absolute -inset-px rounded-md"
                                            aria-hidden="true"></span>
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <button type="submit"
                            class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Add to bag
                        </button>
                    </form>
                </div>

                <div
                    class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                    <!-- Description and details -->
                    <div>
                        <h3 class="sr-only">Description</h3>

                        <!-- Description -->
                        <div class="space-y-6">
                            <p class="text-base text-gray-900">{!! $product->excerpt !!}</p>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="mt-10">
                        <h2 class="sr-only text-sm font-medium text-gray-900">Details</h2>

                        <div class="mt-4 space-y-6">
                            <p class="text-sm text-gray-600">{!! $product->body !!}</p>
                        </div>
                        <div class="mt-4 space-y-6">
                            <p class="text-sm text-gray-600">{{ $common_contents['thanks'] }}</p>
                        </div>
                        <!-- Parametric Content -->
                        @if ($product->is_parametric)
                            <div class="mt-4 space-y-6">
                                <p class="text-sm text-gray-600">{!! $common_contents['parametric'] !!}</p>
                            </div>
                        @endif
                        <!-- Donation Content -->
                        @if ($product->price === null)
                            <div class="mt-4 space-y-6">
                                <p class="text-sm text-gray-600">{!! $common_contents['donation'] !!}</p>
                            </div>
                        @endif
                        <!-- Comercial Use Licence Content -->
                            <div class="mt-4 space-y-6">
                                <p class="text-sm text-gray-600">{!! $common_contents['comercial_use'] !!}</p>
                            </div>
                    </div>

                    <!-- Print settings -->
                    @if ($product->printable)
                        <div class="mt-5">
                            <h3 class="text-base text-gray-900">Print Settings</h3>

                            <div class="mt-4">
                                <p class="text-sm text-gray-600 mt-2">Printing Material: </span><span class="text-gray-600">{{ formatMaterials($printing_materials) }}</span></p>
                                @foreach ($print_settings as $setting)
                                    <p class="text-sm text-gray-600 mt-2">Print Strength: </span><span class="text-gray-600">{{ Str::ucfirst($setting->print_strength) }}</span></p>
                                    <ul role="list" class="mt-2 list-disc space-y-2 pl-4 text-sm">
                                        <li class="text-gray-400"><span class="text-gray-900">Resolution: </span><span class="text-gray-600">{{ $setting->resolution }} mm</span></li>
                                        <li class="text-gray-400"><span class="text-gray-900">Infill: </span><span class="text-gray-600">{{ $setting->infill }}%</span></li>
                                        <li class="text-gray-400"><span class="text-gray-900">Top Layers: </span><span class="text-gray-600">{{ $setting->top_layers }}</span></li>
                                        <li class="text-gray-400"><span class="text-gray-900">Bottom Layers: </span><span class="text-gray-600">{{ $setting->bottom_layers }}</span></li>
                                        <li class="text-gray-400"><span class="text-gray-900">Walls: </span><span class="text-gray-600">{{ $setting->walls }}</span></li>
                                        <li class="text-gray-400"><span class="text-gray-900">Speed: </span><span class="text-gray-600">{{ $setting->speed }} mm/s</span></li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Bill Of Materials -->
                    @if ($bill_of_materials)
                        <div class="mt-5">
                            <h3 class="text-base text-gray-900">Bill of Materials</h3>
                        
                            <div class="mt-4">
                                <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                                    @foreach($bill_of_materials as $bom)
                                        <li class="text-gray-400"><span class="text-gray-600">{{ $bom }}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Licence -->
                    <div class="mt-5">
                        <h3 class="sr-only">Licence</h3>
                    
                        <div class="mt-4 text-center">
                            <a href="{{ $licence->link }}">{{ $licence->description }}</a>
                            <div class="mt-4 flex justify-center">
                                <a href="{{ $licence->link }}"><img src="{{ $licence->logo }}" alt="{{ $licence->name }}"></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
