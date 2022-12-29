
<script>
    @if(\Illuminate\Support\Facades\Session::has('success'))
    toastr()->success("{{ session('success') }}");
    @endif

        @if(\Illuminate\Support\Facades\Session::has('error'))
    toastr()->error("{{ session('error') }}");
    @endif

        @if(\Illuminate\Support\Facades\Session::has('info'))

    toastr()->info("{{ session('info') }}");
    @endif

     @if(\Illuminate\Support\Facades\Session::has('warning'))
    toastr()->warning("{{ session('warning') }}");
    @endif
</script>
