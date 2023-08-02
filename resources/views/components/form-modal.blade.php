<div
    {{ $attributes->merge([
        'class' => 'modal fade',
        'id' => 'modal-form',
        'tabindex' => '-1',
        'role' => 'dialog',
        'aria-labelledby' => 'exampleModalLable',
        'aria-hidden' => 'true',
        'data-backdrop' => 'static',
        'data-keyboard' => 'false',
    ]) }}>
    <div class='modal-dialog {{ isset($modal_size) ? $modal_size : 'modal-md' }}' role='document'>
        <div class="modal-content">
            <form method="{{ isset($method_form) ? $method_form : 'post' }}">
                @isset($title)
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $title }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endisset

                <div class="modal-body">
                    {{ $slot }}
                </div>

                @isset($footer)
                    <div class="modal-footer justify-content-between">
                        {{ $footer }}
                    </div>
                @endisset
            </form>

        </div>
    </div>
</div>
