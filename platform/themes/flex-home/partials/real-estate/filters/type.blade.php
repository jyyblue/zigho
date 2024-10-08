@if($enabledTypes = Botble\RealEstate\Facades\RealEstateHelper::enabledPropertyTypes())
    <div class="form-group">
        <label for="select-type" class="control-label">{{ __('Status') }}</label>
        <div class="select--arrow">
            <select name="type" id="select-type" class="form-control">
                <option value="">{{ __('-- Select --') }}</option>
                @foreach(Botble\RealEstate\Enums\PropertyTypeEnum::labels() as $key => $label)
                    @continue(!in_array($key, $enabledTypes))
                
                    <option value="{{ $key }}" @if (request()->input('type') == $key) selected
                        @endif>{{ $label }}
                    </option>
                @endforeach
            </select>
            <i class="fas fa-angle-down"></i>
        </div>
    </div>
@endif
