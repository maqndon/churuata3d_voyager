@section('submit-buttons')
<button type="submit" class="btn btn-primary pull-right">
    @if ($edit)
        {{ __('voyager::'.$displayNameSingular.'.update') }}
    @else
        <i class="icon wb-plus-circle"></i> {{ __('voyager::' . $dataType->display_name_singular . '.new') }}
    @endif
</button>
@stop
@yield('submit-buttons')