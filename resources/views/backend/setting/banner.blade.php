<form action="{{ route('setting.update', !empty($setting->id) ? $setting->id : '') }}?tab=banner" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="banner_title">Judul Banner <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('banner_title') is-invalid @enderror" name="banner_title"
                    id="banner_title"
                    value="{{ old('banner_title') ?? (!empty($banner->banner_title) ? $banner->banner_title : '') }}"
                    placeholder="Enter banner title" required>
                @error('banner_title')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="banner_description">Deskripsi Banner <span class="text-danger">*</span></label>
                <textarea class="form-control @error('banner_description') is-invalid @enderror" name="banner_description"
                    id="banner_description" rows="3" placeholder="Enter banner description" required>{{ old('banner_description') ?? (!empty($banner->banner_description) ? $banner->banner_description : '') }}</textarea>
                @error('banner_description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="text-center col-lg-12">
            <label>Gambar Banner</label>
            <p>(Best Size 667 x 630 px)</p>
            <div class="form-group">
                <div class="mb-3 text-center">
                    @if (!empty($banner->banner_image))
                        <img class="img-fluid preview-banner_image" src="{{ url('storage/' . $banner->banner_image) }}"
                            width="200">
                    @else
                        <img class="img-fluid preview-banner_image" src="{{ url(env('NO_IMAGE_SQUARE')) }}"
                            width="200">
                    @endif
                </div>
                <div class="mb-3 custom-file">
                    <input type="file" class="custom-file-input" id="banner_image" name="banner_image"
                        onchange="preview('.preview-banner_image', this.files[0])">
                    <label class="custom-file-label" for="banner_image">Choose file</label>
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
