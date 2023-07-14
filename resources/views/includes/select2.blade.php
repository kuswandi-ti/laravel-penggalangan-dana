@push('style_vendor')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('public/template/backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/template/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts_vendor')
    <!-- Select2 -->
    <script src="{{ asset('public/template/backend/plugins/select2/js/select2.full.min.js') }}"></script>
@endpush

@push('scripts')
    <script>
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: '{{ isset($placeholder) ? $placeholder : 'Pilih salah satu' }}',
            closeOnSelect: true,
            allowClear: true,
        })
    </script>
@endpush
