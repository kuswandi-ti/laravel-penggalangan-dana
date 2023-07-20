@push('styles_vendor')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('public/template/backend/plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@push('scripts_vendor')
    <!-- Summernote -->
    <script src="{{ asset('public/template/backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
@endpush

@push('scripts')
    <script>
        $('.summernote').summernote({
            height: 200,
        })
    </script>
@endpush
