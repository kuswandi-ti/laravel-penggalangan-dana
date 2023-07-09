<div class="mt-3 row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="path_image">Pilih salah satu foto untuk program ini <span class="text-danger">*</span></label>
            <div class="custom-file">
                <input type="file" name="path_image" id="path_image"
                    class="custom-file-input @error('path_image') is-invalid @enderror"
                    onchange="preview('.preview-path_image', this.files[0])">
                <label class="custom-file-label" for="path_image">Choose file</label>
                @error('path_image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <img src="" alt="" class="img-thumbnail preview-path_image" style="display: none;">
        <p class="font-italic text-danger">Format foto harus dalam extensi .png, .jpg, atau .jpeg</p>
    </div>
</div>

<div class="mt-3 form-group">
    <button class="custom-btn custom-border-btn btn" onclick="stepper.previous()">Sebelumnya</button>
    <button type="button" class="custom-btn btn" onclick="stepper.next()">Selanjutnya</button>
</div>
