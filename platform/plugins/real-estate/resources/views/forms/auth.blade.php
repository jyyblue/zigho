@php
    $icon = Arr::get($formOptions, 'icon');
    $heading = Arr::get($formOptions, 'heading');
    $description = Arr::get($formOptions, 'description');
@endphp

@if (Arr::get($formOptions, 'has_wrapper', 'yes') === 'yes')
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-xl-6 col-lg-8">
        @endif
            <div class="card bg-body-tertiary border-0 auth-card">
                @if ($banner = Arr::get($formOptions, 'banner'))
                    {{ RvMedia::image($banner, $heading ?: '', attributes: ['class' => 'card-img-top mb-3']) }}
                @endif

                @if ($icon || $heading || $description)
                    <div class="card-header bg-body-tertiary border-0 p-5 pb-0">
                        <div @class(['d-flex flex-column flex-md-row align-items-center gap-3' => $icon, 'text-center' => ! $icon])>
                            @if ($icon)
                                <div class="bg-white p-3 rounded">
                                    <x-core::icon :name="$icon" class="text-primary" />
                                </div>
                            @endif
                            <div>
                                @if ($heading)
                                    <h3 class="fs-4 mb-1">{{ $heading }}</h3>
                                @endif
                                @if ($description)
                                    <p class="text-muted">{{ $description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card-body p-5 pt-3">
                    @if ($showStart)
                        {!! Form::open(Arr::except($formOptions, ['template'])) !!}
                    @endif

                    @if (session('status'))
                        <div role="alert" class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($showFields)
                        {{ $form->getOpenWrapperFormColumns() }}

                        @foreach ($fields as $field)
                            @continue(in_array($field->getName(), $exclude))

                            {!! $field->render() !!}
                        @endforeach

                        {{ $form->getCloseWrapperFormColumns() }}
                    @endif

                    @if ($showEnd)
                        {!! Form::close() !!}
                    @endif

                    @if ($form->getValidatorClass())
                        @push('footer')
                            {!! $form->renderValidatorJs() !!}
                        @endpush
                    @endif
                </div>
            </div>
            @if (Arr::get($formOptions, 'has_wrapper', 'yes') === 'yes')
        </div>
    </div>
</div>
@endif

    <!-- Laravel Javascript Validation -->
    <!-- <script
        type="text/javascript"
        src="{{ asset('vendor/core/core/base/libraries/intl-tel-input/js/intlTelInput.min.js') }}"
    ></script>

    <script
        type="text/javascript"
        src="{{ asset('vendor/core/core/base/js/phone-number-field.js') }}"
    ></script> -->
