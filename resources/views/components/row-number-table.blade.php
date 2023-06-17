@if (isset($key) && isset($model))
    {{ $key + $model->firstItem() }}
@endif
