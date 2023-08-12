@php
    $edit = !is_null($dataTypeContent->getKey());
    $add = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height: 100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
@stop

@section('page_title', __('voyager::generic.' . ($edit ? 'edit' : 'add')) . ' ' .
    $dataType->getTranslatedAttribute('display_name_singular'))
@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.' . ($edit ? 'edit' : 'add')) . ' ' . $dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
            action="@if ($edit) {{ route('voyager.pages.update', $dataTypeContent->id) }}@else{{ route('voyager.pages.store') }} @endif"
            method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if ($edit)
                {{ method_field('PUT') }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <!-- ### TITLE ### -->
                    <div class="panel">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="voyager-character"></i> {{ __('voyager::page.title') }}
                                <span class="panel-desc"> {{ __('voyager::page.title_sub') }}</span>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                    aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name' => 'title',
                                '_field_trans' => get_field_translations($dataTypeContent, 'title'),
                            ])
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="{{ __('voyager::generic.title') }}"
                                value="{{ $dataTypeContent->title ?? '' }}"
                            >
                        </div>
                    </div>

                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ __('voyager::page.content') }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name' => 'body',
                                '_field_trans' => get_field_translations($dataTypeContent, 'body'),
                            ])
                            @php
                                $dataTypeRows = $dataType->{$edit ? 'editRows' : 'addRows'};
                                $row = $dataTypeRows->where('field', 'body')->first();
                            @endphp
                            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                        </div>
                    </div>
                    <!-- .panel -->

                    <!-- ### EXCERPT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{!! __('voyager::page.excerpt') !!}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                    aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name' => 'excerpt',
                                '_field_trans' => get_field_translations($dataTypeContent, 'excerpt'),
                            ])
                            {{-- {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!} --}}
                            <textarea class="form-control" name="excerpt">{{ $dataTypeContent->excerpt ?? '' }}</textarea>
                        </div>
                    </div>

                </div>
                <!-- ### DETAILS ### -->
                <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i> {{ __('voyager::page.details') }}
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                    aria-hidden="true"></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="slug">{{ __('voyager::page.slug') }}</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name' => 'slug',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'slug'),
                                ])
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="slug"
                                    {!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, 'slug') !!} value="{{ $dataTypeContent->slug ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="status">{{ __('voyager::page.status') }}</label>
                                <select class="form-control" name="status">
                                    <option value="ACTIVE"@if (isset($dataTypeContent->status) && $dataTypeContent->status == 'ACTIVE') selected="selected" @endif>
                                        {{ __('voyager::page.status_active') }}</option>
                                    <option value="INACTIVE"@if (isset($dataTypeContent->status) && $dataTypeContent->status == 'INACTIVE') selected="selected" @endif>
                                        {{ __('voyager::page.status_inactive') }}</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <!-- ### IMAGE ### -->
                    <x-image-field :dataTypeContent="$dataTypeContent" :dataType="$dataType" />

                    <!-- ### SEO CONTENT ### -->
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-search"></i>
                                {{ __('voyager::page.seo_content') }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse"
                                    aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="seo_title">{{ __('voyager::page.seo_title') }}</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name' => 'seo_title',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'seo_title'),
                                ])
                                <input type="text" class="form-control" name="seo_title" placeholder="SEO Title"
                                    value="{{ $dataTypeContent->seo_title ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="meta_description">{{ __('voyager::page.meta_description') }}</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name' => 'meta_description',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'meta_description'),
                                ])
                                <textarea class="form-control" name="meta_description">{{ $dataTypeContent->meta_description ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">{{ __('voyager::page.meta_keywords') }}</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name' => 'meta_keywords',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'meta_keywords'),
                                ])
                                <textarea class="form-control" name="meta_keywords">{{ $dataTypeContent->meta_keywords ?? '' }}</textarea>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        @section('submit-buttons')
            <button type="submit" class="btn btn-primary pull-right">
                @if ($edit)
                    {{ __('voyager::page.update') }}
                @else
                    <i class="icon wb-plus-circle"></i> {{ __('voyager::page.new') }}
                @endif
            </button>
        @stop
        @yield('submit-buttons')
    </form>

    <div style="display:none">
        <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
        <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
    </div>
</div>

<div class="modal fade modal-danger" id="confirm_delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}
                </h4>
            </div>

            <div class="modal-body">
                <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                <button type="button" class="btn btn-danger"
                    id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- End Delete File Modal -->
@stop

@section('javascript')
<script>
    var params = {};
    var $file;

    function deleteHandler(tag, isMulti) {
        return function() {
            $file = $(this).siblings(tag);

            params = {
                slug: '{{ $dataType->slug }}',
                filename: $file.data('file-name'),
                id: $file.data('id'),
                field: $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
        };
    }

    $('document').ready(function() {
        $('#slug').slugify();

        $('.toggleswitch').bootstrapToggle();

        //Init datepicker for date fields if data-datepicker attribute defined
        //or if browser does not handle date inputs
        $('.form-group input[type=date]').each(function(idx, elt) {
            if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                elt.type = 'text';
                $(elt).datetimepicker($(elt).data('datepicker'));
            }
        });

        @if ($isModelTranslatable)
            $('.side-body').multilingual({
                "editing": true
            });
        @endif

        $('.side-body input[data-slug-origin]').each(function(i, el) {
            $(el).slugify();
        });

        $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
        $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
        $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
        $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

        $('#confirm_delete').on('click', function() {
            $.post('{{ route('voyager.' . $dataType->slug . '.media.remove') }}', params, function(
                response) {
                if (response &&
                    response.data &&
                    response.data.status &&
                    response.data.status == 200) {

                    toastr.success(response.data.message);
                    $file.parent().fadeOut(300, function() {
                        $(this).remove();
                    })
                } else {
                    toastr.error("Error removing file.");
                }
            });

            $('#confirm_delete_modal').modal('hide');
        });
        $('[data-toggle="tooltip"]').tooltip();

        //select2 for pages categories
        $('.select_categories').select2({
            placeholder: "Select a Category"
        });

        //select2 for pages tags
        $('.select_tags').select2({
            placeholder: "Select a Tag",
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });
</script>
@stop
