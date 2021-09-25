<script src="{{ asset('vendor/Toastify/toastify.min.js') }}"></script>
<script>
    {{--    TOAST ALERT    --}}
    @if (session('toast_info'))
    toast({msg: '{{ session('toast_info') }}', type: 'info'});
    @endif

    @if (session('toast_success'))
    toast({msg: '{{ session('toast_success') }}', type: 'success'});
    @endif

    @if (session('toast_warning'))
    toast({msg: '{{ session('toast_warning') }}', type: 'warning'});
    @endif

    @if (session('toast_error') || session('toast_danger'))
    toast({msg: '{{ session('toast_error') ?: session('toast_danger') }}', type: 'danger'});
    @endif


        {{--    SWEET ALERT    --}}
    @if (session('sweet_error'))
    sweet({msg: '{{ session('sweet_error') }}', type: 'error'});
    @endif

    @if (session('sweet_warning'))
    sweet({msg: '{{ session('sweet_warning') }}', type: 'warning'});
    @endif

    @if (session('sweet_success'))
    sweet({msg: '{{ session('sweet_success') }}', type: 'success', title: 'GREAT!!'});
    @endif


    function sweet(data) {
        Swal.fire({
            title: data.title ? data.title : 'Oops...',
            text: data.msg,
            icon: data.type
        });
    }

    function toast(data) {
        Toastify({
            text: data.msg,
            duration: 7000,
            close: true,
            className: data.type,
        }).showToast();
    }
</script>
