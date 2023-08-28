<div class="panel panel-bordered panel-file">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="icon wb-file"></i> {{ __('voyager::' . $dataType->display_name_singular . '.files') }}</h3>
        <div class="panel-actions">
            <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
        </div>
    </div>
    <div class="panel-body">
        @php
            
            // dd($dataTypeContent->files);
        @endphp
        @if (isset($dataTypeContent->files))
            @foreach ($dataTypeContent->files as $file)
                {{ filter_var($dataTypeContent->files, FILTER_VALIDATE_URL) ? $dataTypeContent->files : Voyager::files($dataTypeContent->files) }}
            @endforeach
            {{-- <img src="{{ filter_var($dataTypeContent->files, FILTER_VALIDATE_URL) ? $dataTypeContent->files : Voyager::files($dataTypeContent->files) }}" style="width:100%" /> --}}
        @endif
        <input type="file" name="files">
    </div>
</div>