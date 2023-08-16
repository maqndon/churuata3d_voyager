@php
    $edit = !is_null($dataTypeContent->getKey());
    $add = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

{{-- CSS --}}
<x-edit-add-styles />

{{-- Page Title and Headers --}}
<x-page-title-and-header :edit="$edit" :dataType="$dataType" />

@section('content')
    <div class="page-content container-fluid">
        
        {{-- form --}}
        <x-edit-add-form :edit="$edit" :dataType="$dataType" :dataTypeContent="$dataTypeContent" :isModelTranslatable="$isModelTranslatable" :displayNameSingular="strtolower($dataType->display_name_singular)" />

        {{-- upload_url and  upload_type_slug --}}
        <x-edit-add-upload_url-and-upload_type_slug :dataType="$dataType" />

    </div>

    {{-- Delete Modal --}}
    <x-edit-add-delete_modal />

@stop

<x-edit-add-javascript :isModelTranslatable="$isModelTranslatable" :dataType="$dataType" />
