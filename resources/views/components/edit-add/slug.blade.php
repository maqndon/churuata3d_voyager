<div class="form-group">
    <label for="slug">{{ __('voyager::' . $dataType->display_name_singular . '.slug') }}</label>
    @include('voyager::multilingual.input-hidden', [
        '_field_name' => 'slug',
        '_field_trans' => get_field_translations($dataTypeContent, 'slug'),
    ])
    <input type="text" class="form-control" id="slug" name="slug" placeholder="slug"
        {!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, 'slug') !!} value="{{ $dataTypeContent->slug ?? '' }}">
</div>