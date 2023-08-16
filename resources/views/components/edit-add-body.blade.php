<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{ __('voyager::'.$displayNameSingular.'.content') }}</h3>
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