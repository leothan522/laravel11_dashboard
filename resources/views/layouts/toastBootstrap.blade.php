@if (session()->has('toastBootstrap-flash'))
    <script type="module">
        flashToastBootstrap(@json(session('toastBootstrap-flash')))
    </script>
@endif
