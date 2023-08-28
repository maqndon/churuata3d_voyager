@php
    
    //Type Name in plural
    $dataTypeName = $dataType->name;
    
    $dataRow = \TCG\Voyager\Models\DataRow::where('data_type_id', function ($query) use ($dataTypeName) {
        $query
            ->select('id')
            ->from('data_types')
            ->where('name', $dataTypeName);
    })
        ->where('field', 'status')
        ->first();

    //options available
    $options = $dataRow->details->allowed;

@endphp

<div class="form-group">

    <label for="status">{{ __('voyager::' . $dataType->display_name_singular . '.status') }}</label>

   <select class="form-control" name="status">

        @foreach ($options as $option)
            <option value="{{ $option }}"@if (isset($dataTypeContent->status) && $dataTypeContent->status == ''.$option.'') selected="selected" @endif>
                {{ __('voyager::' . $dataType->display_name_singular . '.status_'.Str::lower($option).'') }}
            </option>
        @endforeach

    </select>

</div>
