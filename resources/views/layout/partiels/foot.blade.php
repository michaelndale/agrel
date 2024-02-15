<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="{{ asset('elements/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('elements/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('elements/dist/js/adminlte.min.js') }}"></script>
{{-- toastr js --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if(Session::has('success'))
<script>
    toastr.success("{{ Session::get('success') }}")
</script>
@elseif(Session::has('failed'))
<script>
    toastr.error("{{ Session::get('failed') }}")
</script>
@elseif(Session::has('info'))
<script>
    toastr.info("{{ Session::get('info') }}")
</script>
@endif

</body>
</html>
