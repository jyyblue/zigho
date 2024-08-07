<footer>
    <div style="background-color: #0cafff">
        <div class="row w90 m-auto">
            <div class="col-sm-9 text-white">
                <h5 class="mt-3">{{ __('Want to become a Real Estate Agent?')}}</h5>
                <p>{{ __('We`ll help you to grow your career and growth.') }}</p>
            </div>
            <div class="col-sm-3 m-auto">
                <a href="{{ route('public.account.register') }}" class="btn btn-light rounded-pill">{{ __('Sign Up') }}</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid w90">
        
        <div class="row">
            <div class="col-sm-3">
                @if ($logo = theme_option('logo'))
                    <p>
                        <a href="{{ route('public.index') }}">
                            <img src="{{ RvMedia::getImageUrl($logo)  }}" style="max-height: 38px" alt="{{ theme_option('site_title') }}">
                        </a>
                    </p>
                @endif
                @if ($address = theme_option('address'))
                    <p><i class="fas fa-map-marker-alt"></i> &nbsp;{{ $address }}</p>
                @endif
                @if ($hotline = theme_option('hotline'))
                    <p><i class="fas fa-phone-square"></i>&nbsp;<span class="d-inline-block">{{ __('Hotline') }}: </span>&nbsp;<a href="tel:{{ $hotline }}" dir="ltr">{{ $hotline }}</a></p>
                @endif
                @if ($email = theme_option('email'))
                    <p><i class="fas fa-envelope"></i>&nbsp;<span class="d-inline-block">{{ __('Email') }}: </span>&nbsp;<a href="mailto:{{ $email }}" dir="ltr">{{ $email }}</a></p>
                @endif
            </div>
            <div class="col-sm-9 padtop10">
                <div class="row">
                    {!! dynamic_sidebar('footer_sidebar') !!}
                </div>
            </div>
        </div>
        @if ($languageSwitcher = Theme::partial('language-switcher'))
            <div class="row">
                <div class="col-12">
                    {!! $languageSwitcher !!}
                </div>
            </div>
        @endif
        @if ($copyright = Theme::getSiteCopyright())
            <div class="copyright">
                <div class="col-sm-12">
                    <p class="text-center mb-0">
                        {!! $copyright !!}
                    </p>
                </div>
            </div>
        @endif
    </div>
</footer>

<script>
    window.trans = {
        "Price": "{{ __('Price') }}",
        "Number of rooms": "{{ __('Number of rooms') }}",
        "Number of rest rooms": "{{ __('Number of rest rooms') }}",
        "Square": "{{ __('Square') }}",
        "million": "{{ __('million') }}",
        "billion": "{{ __('billion') }}",
        "in": "{{ __('in') }}",
        "Added to wishlist successfully!": "{{ __('Added to wishlist successfully!') }}",
        "Removed from wishlist successfully!": "{{ __('Removed from wishlist successfully!') }}",
        "I care about this property!!!": "{{ __('I care about this property!!!') }}",
    };
    window.themeUrl = '{{ Theme::asset()->url('') }}';
    window.siteUrl = '{{ route('public.index') }}';
    window.currentLanguage = '{{ App::getLocale() }}';
</script>

<div class="action_footer">
    <a href="#" @class(['cd-top', 'cd-top-40' => !Theme::get('hotlineNumber') && ! $hotline]) title="back to top"><i class="fas fa-arrow-up"></i></a>
    @if (Theme::get('hotlineNumber') || $hotline)
        <a href="tel:{{ Theme::get('hotlineNumber') ?: $hotline }}" class="text-white" style="font-size: 17px;"><i class="fas fa-phone"></i> <span>  &nbsp;{{ Theme::get('hotlineNumber') ?: $hotline }}</span></a>
    @endif
</div>

    {!! Theme::footer() !!}
</body>
</html>
