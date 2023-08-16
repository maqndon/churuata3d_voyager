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
            <x-edit-add-title :dataTypeContent="$dataTypeContent" :isModelTranslatable="$isModelTranslatable" :displayNameSingular="strtolower($dataType->display_name_singular)" />

            <!-- ### CONTENT ### -->
            <x-edit-add-body :edit="$edit" :dataType="$dataType" :dataTypeContent="$dataTypeContent" :isModelTranslatable="$isModelTranslatable"
                :displayNameSingular="strtolower($dataType->display_name_singular)" />

            <!-- ### EXCERPT ### -->
            <x-edit-add-excerpt :isModelTranslatable="$isModelTranslatable" :dataTypeContent="$dataTypeContent" :displayNameSingular="strtolower($dataType->display_name_singular)" />

        </div>
        <!-- ### DETAILS ### -->
        <div class="col-md-4">

            <div class="panel panel panel-bordered panel-warning">

                {{-- Panel heading --}}
                <x-edit-add-panel-heading :displayNameSingular="strtolower($dataType->display_name_singular)" />

                <div class="panel-body">

                    {{-- Slug --}}
                    <x-edit-add-slug :isModelTranslatable="$isModelTranslatable" :dataType="$dataType" :dataTypeContent="$dataTypeContent" :displayNameSingular="strtolower($dataType->display_name_singular)" />

                    {{-- Status --}}
                    <x-edit-add-status :isModelTranslatable="$isModelTranslatable" :dataType="$dataType" :dataTypeContent="$dataTypeContent" :displayNameSingular="strtolower($dataType->display_name_singular)" />

                    {{-- Categories and Tags --}}
                    @if (in_array($dataType->display_name_singular, $categories))
                        <x-edit-add-categories-and-tags :edit="$edit" :dataType="$dataType" :dataTypeContent="$dataTypeContent"
                            :displayNameSingular="strtolower($dataType->display_name_singular)" />
                    @endif

                    {{-- Featured --}}
                    @if (in_array($dataType->display_name_singular, $featured))
                        <x-edit-add-featured :dataTypeContent="$dataTypeContent" />
                    @endif

                </div>

            </div>

            <!-- ### IMAGE ### -->
            <x-image-field :dataTypeContent="$dataTypeContent" :displayNameSingular="strtolower($dataType->display_name_singular)" />

            <!-- ### FILES ### -->
            @if (in_array($dataType->display_name_singular, $files))
                <x-edit-add-files :dataTypeContent="$dataTypeContent" :displayNameSingular="strtolower($dataType->display_name_singular)" />
            @endif

            <!-- ### SEO CONTENT ### -->
            <x-edit-add-seo :isModelTranslatable="$isModelTranslatable" :dataTypeContent="$dataTypeContent" :displayNameSingular="strtolower($dataType->display_name_singular)" />

        </div>

    </div>

    {{-- Submit buttons --}}
    <x-edit-add-submit-buttons :edit="$edit" :dataType="$dataType" :displayNameSingular="strtolower($dataType->display_name_singular)" />

</form>
