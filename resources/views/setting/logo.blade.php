<div class="row">
    <div class="text-center col-lg-12">
        <label>Favicon</label>
        <div class="form-group">
            <div class="mb-3 text-center">
                @if (!empty($setting->path_image))
                    <img class="img-fluid img-circle preview-path_image"
                        src="{{ url('storage/' . $setting->path_image) }}" width="200">
                @else
                    <img class="img-fluid img-circle preview-path_image" src="{{ url(env('NO_IMAGE_CIRCLE')) }}"
                        width="200">
                @endif
            </div>
            <div class="mb-3 custom-file">
                <input type="file" class="custom-file-input" id="path_image" name="path_image"
                    onchange="preview('.preview-path_image', this.files[0])">
                <label class="custom-file-label" for="path_image">Choose file</label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="text-center col-lg-6">
        <label>Header Image</label>
        <div class="form-group">
            <div class="mb-3 text-center">
                @if (!empty($setting->path_image_header))
                    <img class="img-fluid preview-path_image_header"
                        src="{{ url('storage/' . $setting->path_image_header) }}" height="200" width="500">
                @else
                    <img class="img-fluid preview-path_image_header" src="{{ url(env('NO_IMAGE_SQUARE')) }}"
                        height="200" width="500">
                @endif
            </div>
            <div class="mb-3 custom-file">
                <input type="file" class="custom-file-input" id="path_image_header" name="path_image_header"
                    onchange="preview('.preview-path_image_header', this.files[0])">
                <label class="custom-file-label" for="path_image_header">Choose file</label>
            </div>
        </div>
    </div>
    <div class="text-center col-lg-6">
        <label>Footer Image</label>
        <div class="form-group">
            <div class="mb-3 text-center">
                @if (!empty($setting->path_image_footer))
                    <img class="img-fluid preview-path_image_footer"
                        src="{{ url('storage/' . $setting->path_image_footer) }}" width="200">
                @else
                    <img class="img-fluid preview-path_image_footer" src="{{ url(env('NO_IMAGE_SQUARE')) }}"
                        height="200" width="500">
                @endif
            </div>
            <div class="mb-3 custom-file">
                <input type="file" class="custom-file-input" id="path_image_footer" name="path_image_footer"
                    onchange="preview('.preview-path_image_footer', this.files[0])">
                <label class="custom-file-label" for="path_image_footer">Choose file</label>
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
<x-swal />

@includeIf('includes.datepicker')
