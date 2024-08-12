<x-core::form.field
    :showLabel="$showLabel"
    :showField="$showField"
    :options="$options"
    :name="$name"
    :prepend="$prepend ?? null"
    :append="$append ?? null"
    :showError="$showError"
    :nameKey="$nameKey"
>
    <x-slot:label>
        @if ($showLabel && $options['label'] !== false && $options['label_show'])
            {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
        @endif
    </x-slot:label>

    <input type="tel" name="{{ $name }}" value="{{ $options['value'] }}" {!! Html::attributes(array_merge_recursive($options['attr'], ['class' => 'js-phone-number-mask form-control'])) !!}>

</x-core::form.field>
