@php
    
    //forms that will contain Categories and Tags
    $categories = ['Product', 'Post'];
    
    //forms that will be Featured
    $featured = ['Product'];
    
    //forms that will contain Files
    $files = ['Product'];
    
@endphp


<form class="form-edit-add" role="form"
    action="@if ($edit) {{ route('voyager.' . $dataType->slug . '.update', $dataTypeContent->id) }}@else{{ route('voyager.' . $dataType->slug . '.store') }} @endif"
    method="POST" enctype="multipart/form-data">

    <!-- PUT Method if we are editing -->
    @if ($edit)
        {{ method_field('PUT') }}
    @endif
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-8">

            <!-- ### TITLE ### -->
            <x-edit-add.title :dataTypeContent="$dataTypeContent" :dataType="$dataType" :isModelTranslatable="$isModelTranslatable" />

            <!-- ### CONTENT ### -->
            <x-edit-add.body :edit="$edit" :dataType="$dataType" :dataTypeContent="$dataTypeContent" :isModelTranslatable="$isModelTranslatable" />

            <!-- ### EXCERPT ### -->
            <x-edit-add.excerpt :isModelTranslatable="$isModelTranslatable" :dataType="$dataType" :dataTypeContent="$dataTypeContent" />

        </div>
        <!-- ### DETAILS ### -->
        <div class="col-md-4">

            <div class="panel panel panel-bordered panel-warning">

                {{-- Panel heading --}}
                <x-edit-add.panel-heading :dataType="$dataType" />

                <div class="panel-body">

                    {{-- Slug --}}
                    <x-edit-add.slug :isModelTranslatable="$isModelTranslatable" :dataType="$dataType" :dataTypeContent="$dataTypeContent" />

                    {{-- Status --}}
                    <x-edit-add.status :isModelTranslatable="$isModelTranslatable" :dataType="$dataType" :dataTypeContent="$dataTypeContent" />

                    {{-- Categories and Tags --}}
                    @if (in_array($dataType->display_name_singular, $categories))
                        <x-edit-add.categories-and-tags :edit="$edit" :dataType="$dataType" :dataTypeContent="$dataTypeContent" />
                    @endif

                    {{-- Featured --}}
                    @if (in_array($dataType->display_name_singular, $featured))
                        <x-edit-add.featured :dataTypeContent="$dataTypeContent" />
                    @endif

                </div>

            </div>

            <!-- ### IMAGE ### -->
            <x-edit-add.image :dataType="$dataType" :dataTypeContent="$dataTypeContent" />

            <!-- ### FILES ### -->
            @if (in_array($dataType->display_name_singular, $files))
                <x-edit-add.files :dataType="$dataType" :dataTypeContent="$dataTypeContent" />
            @endif

            <!-- ### SEO CONTENT ### -->
            <x-edit-add.seo :isModelTranslatable="$isModelTranslatable" :dataType="$dataType" :dataTypeContent="$dataTypeContent"/>

        </div>

    </div>

    {{-- Submit buttons --}}
    <x-edit-add.submit-buttons :edit="$edit" :dataType="$dataType" />

</form>
