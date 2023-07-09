<div class="mt-3 row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="categories[]">Kategori apa yang tepat untuk program ini ? <span
                    class="text-danger">*</span></label>
            <select class="form-control select2 @error('categories') is-invalid @enderror" name="categories[]"
                id="categories" multiple>
            </select>
            @error('categories')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="mt-3 row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Apa judul untuk program ini ? <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                id="title" value="{{ old('title') }}" placeholder="Masukkan Judul Program">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="mt-3 form-group">
    <button type="button" class="custom-btn btn" onclick="stepper.next()">Selanjutnya</button>
</div>
