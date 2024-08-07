<div class="form-group">
    <label for="keyword" class="control-label">{{ __('Property Type') }}</label>
    <div class="input-has-icon">
        <input type="text" id="keyword" class="form-control" name="k" value="{{ BaseHelper::stringify(request()->input('k')) }}"
            placeholder="{{ __('Type/search a property') }}">
        <i class="far fa-search"></i>
    </div>
</div>
