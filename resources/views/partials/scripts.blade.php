
{{--    BOOTSTRAP JS    --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

{{--    JQuery Validation CDN    --}}
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

<!--    Swiper JS CDN    -->
<script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

{{--    SweetAlert2 CDN    --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.all.min.js" integrity="sha256-C7IaCo6kN3RN2EjOcM6WEMmykQV8mK72CI1jx0kqeZg=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>

<!--    Select 2 JS    -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>

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
<script src="{{ asset('js/Select2.js') }}"></script>
<script src="{{ asset('js/jquery.nice-number.js') }}"></script>

<script>
    setTimeout(() => {
        $('.loader-bg').fadeToggle();
    }, 1500);
</script>
