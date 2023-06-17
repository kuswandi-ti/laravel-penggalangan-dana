<div {{ $attributes->merge(['class' => 'd-flex justify-content-between mt-3']) }}>
    <p>
        Menampilkan <strong>{{ $model->firstItem() }}</strong> s/d <strong>{{ $model->lastItem() }}</strong> dari
        <strong>{{ $model->total() }}</strong> baris
    </p>
    {{ $model->links() }}
</div>
