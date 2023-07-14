@push('style_vendor')
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('public/template/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/template/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush

@push('scripts_vendor')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('public/template/backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/template/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/template/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('public/template/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>
@endpush
