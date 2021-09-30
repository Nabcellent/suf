
<!--    Bootstrap CDN    -->
<script src="{{ asset('vendor/bootstrap5/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>

<!--    Jquery Validation CDN    -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

<!--    Select 2 JS    -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>

<!--    SweetAlert JS    -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js" integrity="sha256-tFXKkrzNScHtIKgp71cCOiVCPAokgE5k7m/i2VfU+4w=" crossorigin="anonymous"></script>

@stack('scripts')
@include('partials.javascript')

<!-- Scripts -->
<script src="{{ asset('js/global.js') }}"></script>
<script src="{{ asset('js/Admin/Main.js') }}"></script>
<script src="{{ asset('js/Admin/chart.js') }}" defer></script>
<script src="{{ asset('js/Admin/Fetch.js') }}"></script>
<script src="{{ asset('js/Admin/JqueryValidation.js') }}"></script>
<script src="{{ asset('js/Admin/Dynamic.js') }}" defer></script>
<script src="{{ asset('js/Admin/SweetAlert.js') }}" defer></script>
