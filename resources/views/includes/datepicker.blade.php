@push('style_vendor')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush

@push('scripts_vendor')
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
@endpush

@push('scripts')
    <script>
        $('.datepicker').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD',
            locale: 'id'
        });

        $('.datetimepicker').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD HH:mm',
            locale: 'id',
        });
    </script>
@endpush
