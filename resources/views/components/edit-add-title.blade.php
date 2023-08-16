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
            <i class="voyager-character"></i> {{ __('voyager::'.$displayNameSingular.'.title') }}
            <span class="panel-desc"> {{ __('voyager::'.$displayNameSingular.'.title_sub') }}</span>
        </h3>
        <div class="panel-actions">
            <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
        </div>
    </div>
    <div class="panel-body">
        @include('voyager::multilingual.input-hidden', [
            '_field_name' => 'title',
            '_field_trans' => get_field_translations($dataTypeContent, 'title'),
        ])
        <input type="text" class="form-control" id="title" name="title"
            placeholder="{{ __('voyager::generic.title') }}" value="{{ $dataTypeContent->title ?? '' }}">
    </div>
</div>
