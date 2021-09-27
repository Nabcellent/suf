
{{--    BOOTSTRAP JS    --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

{{--    JQuery Validation CDN    --}}
<script src="{{ asset('vendor/jquery/validation.js') }}"></script>

<!--    Swiper JS CDN    -->
<script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

{{--    SweetAlert2 CDN    --}}
<script src="{{ asset('vendor/sweetalert/sweetalert.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>

{{--    DYNAMIC SCRIPTS    --}}
@stack('scripts')
@livewireScripts

{{--    MY JS    --}}
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/Global.js') }}"></script>
<script src="{{ asset('js/JqueryValidation.js') }}"></script>
<script src="{{ asset('js/swiper.js') }}"></script>
<script src="{{ asset('js/search.js') }}"></script>
<script src="{{ asset('js/fetch.js') }}"></script>
<script src="{{ asset('js/sweetAlert.js') }}"></script>
<script src="{{ asset('js/jquery.nice-number.js') }}"></script>

<script>
    setTimeout(() => {
        $('.loader-bg').fadeToggle();
    }, 1500);
</script>
