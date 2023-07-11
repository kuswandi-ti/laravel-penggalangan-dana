<form action="{{ route('setting.update', !empty($setting->id) ? $setting->id : '') }}?tab=image" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-12">
            <label>Logo (.png, .jpg, .jpeg. Max 2MB)</label>
            <div class="form-group">
                <div class="mb-3 text-center">
                    @if (!empty($setting->path_image_logo))
                        <img class="img-fluid preview-path_image_logo"
                            src="{{ url('storage/' . $setting->path_image_logo) }}" width="200">
                    @else
                        <img class="img-fluid preview-path_image_logo" src="{{ url(env('NO_IMAGE_SQUARE')) }}"
                            width="200">
                    @endif
                </div>
                <div class="mb-3 custom-file">
                    <input type="file" class="custom-file-input" id="path_image_logo" name="path_image_logo"
                        onchange="preview('.preview-path_image_logo', this.files[0])">
                    <label class="custom-file-label" for="path_image_logo">Choose file</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <label>Foto Bisnis (.png, .jpg, .jpeg. Max 2MB)</label>
            <div class="form-group">
                <div class="mb-3 text-center">
                    @if (!empty($setting->path_image_business))
                        <img class="img-fluid preview-path_image_business"
                            src="{{ url('storage/' . $setting->path_image_business) }}" width="200">
                    @else
                        <img class="img-fluid preview-path_image_business" src="{{ url(env('NO_IMAGE_SQUARE')) }}"
                            width="200">
                    @endif
                </div>
                <div class="mb-3 custom-file">
                    <input type="file" class="custom-file-input" id="path_image_business" name="path_image_business"
                        onchange="preview('.preview-path_image_business', this.files[0])">
                    <label class="custom-file-label" for="path_image_business">Choose file</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button type="reset" class="btn btn-warning">
                <i class="fas fa-ban"></i> Reset
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </div>
</form>

<x-swal />

@includeIf('includes.datepicker')
