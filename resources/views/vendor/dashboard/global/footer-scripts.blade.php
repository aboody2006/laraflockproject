{{-- jQuery --}}
<script src="{{ asset('vendor/laraflock/jquery/jquery.min.js') }}" type="text/javascript"></script>

{{-- Bootstrap JS --}}
<script src="{{ asset('vendor/laraflock/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

{{-- Slim Scroll --}}
<script src="{{ asset('vendor/laraflock/slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>

{{-- Fastclick --}}
<script src="{{ asset('vendor/laraflock/fastclick/fastclick.min.js') }}" type="text/javascript"></script>

{{-- AdminLTE JS --}}
<script src="{{ asset('vendor/laraflock/adminlte/js/app.min.js') }}" type="text/javascript"></script>

{{-- Ajax  --}}
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>