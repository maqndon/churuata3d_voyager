<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{!! __('voyager::' . $dataType->display_name_singular . '.excerpt') !!}</h3>
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
        <textarea class="form-control" name="excerpt">{{ $dataTypeContent->excerpt ?? '' }}</textarea>
    </div>
</div>