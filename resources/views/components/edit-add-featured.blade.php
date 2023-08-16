<div class="form-group">
    <label for="featured">{{ __('voyager::generic.featured') }}</label>
    <input type="checkbox" class="toggleswitch" name="featured"
        @if (isset($dataTypeContent->featured) && $dataTypeContent->featured) checked="checked" @endif>
</div>