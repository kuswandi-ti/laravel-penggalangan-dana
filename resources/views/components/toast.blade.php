@if (session()->has('success'))
    <script>
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Success',
            autohide: true,
            delay: 3000,
            body: '{{ session('message') }}'
        })
    </script>
@endif

@if (session()->has('error'))
    <script>
        $(document).Toasts('create', {
            class: 'bg-error',
            title: 'Error',
            autohide: true,
            delay: 3000,
            body: '{{ session('message') }}'
        })
    </script>
@endif
