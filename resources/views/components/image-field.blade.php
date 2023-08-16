<div class="panel panel-bordered panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="icon wb-image"></i> {{ __('voyager::' . $displayNameSingular . '.image') }}</h3>
        <div class="panel-actions">
            <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
        </div>
    </div>
    <div class="panel-body">
        @if (isset($dataTypeContent->image))
            <img src="{{ filter_var($dataTypeContent->image, FILTER_VALIDATE_URL) ? $dataTypeContent->image : Voyager::image($dataTypeContent->image) }}"
                style="width:100%" />
        @endif
        <input type="file" name="image">
    </div>
</div>
