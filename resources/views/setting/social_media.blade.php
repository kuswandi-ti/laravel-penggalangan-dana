<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="youtube_link">Youtube Link</label>
            <input type="text" class="form-control @error('youtube_link') is-invalid @enderror" name="youtube_link"
                id="youtube_link"
                value="{{ old('youtube_link') ?? (!empty($setting->youtube_link) ? $setting->youtube_link : '') }}"
                placeholder="Enter youtube link">
            @error('youtube_link')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="instagram_link">Instagram Link</label>
            <input type="text" class="form-control @error('instagram_link') is-invalid @enderror"
                name="instagram_link" id="instagram_link"
                value="{{ old('instagram_link') ?? (!empty($setting->instagram_link) ? $setting->instagram_link : '') }}"
                placeholder="Enter instagram link">
            @error('instagram_link')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="twitter_link">Twitter Link</label>
            <input type="text" class="form-control @error('twitter_link') is-invalid @enderror" name="twitter_link"
                id="twitter_link"
                value="{{ old('twitter_link') ?? (!empty($setting->twitter_link) ? $setting->twitter_link : '') }}"
                placeholder="Enter twitter link">
            @error('twitter_link')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="google_plus_link">Google Plus Link</label>
            <input type="text" class="form-control @error('google_plus_link') is-invalid @enderror"
                name="google_plus_link" id="google_plus_link"
                value="{{ old('google_plus_link') ?? (!empty($setting->google_plus_link) ? $setting->google_plus_link : '') }}"
                placeholder="Enter google plus link">
            @error('google_plus_link')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="fanpage_link">Fanpage Link</label>
            <input type="text" class="form-control @error('fanpage_link') is-invalid @enderror" name="fanpage_link"
                id="fanpage_link"
                value="{{ old('fanpage_link') ?? (!empty($setting->fanpage_link) ? $setting->fanpage_link : '') }}"
                placeholder="Enter fanpage link">
            @error('fanpage_link')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
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
