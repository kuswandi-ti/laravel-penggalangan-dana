<div class="mx-3 mt-3 row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Judul <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                value="{{ old('title') }}" placeholder="Masukkan Judul Program">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="mx-3 mt-3 row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="categories[]">Kategori <span class="text-danger">*</span></label>
            <select class="form-control select2 @error('categories') is-invalid @enderror" name="categories[]"
                id="categories" multiple>
                {{-- @foreach ($categories as $key => $category)
                    <option value="{{ $key }}"
                        {{ collect(old('categories'))->contains($key) ? 'selected' : '' }}>
                        {{ $category }}</option>
                @endforeach --}}
            </select>
            @error('categories')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="mx-3 mt-3 row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="short_description">Short Description <span class="text-danger">*</span></label>
            <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                id="short_description" rows="3" placeholder="Isikan Deskripsi Singkat Program">{{ old('short_description') }}</textarea>
            @error('short_description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="mx-3 mt-3 row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="body">Content / Body <span class="text-danger">*</span></label>
            <textarea class="form-control summernote @error('body') is-invalid @enderror" name="body" id="body"
                rows="3">{{ old('body') }}</textarea>
            @error('body')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<button class="btn btn-secondary" onclick="stepper1.next()">Next</button>
