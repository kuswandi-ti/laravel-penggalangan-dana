<div class="mt-3 row">
    <div class="form-group">
        <label for="short_description">Ceritakan tentang diri anda, alasan membuat program, rencana penggunaan dana <span
                class="text-danger">*</span></label>
        <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
            id="short_description" rows="4" placeholder="Isikan Deskripsi Singkat Program">{{ old('short_description') }}</textarea>
        @error('short_description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="mt-3 row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="note">Tuliskan ajakan singkat untuk mengajak orang ikut program</label>
            <textarea class="form-control" name="note" id="note" rows="3" placeholder="Isikan Catatan Program">{{ old('note') }}</textarea>
        </div>
    </div>
</div>

<div class="mt-3 form-group">
    <button class="custom-btn custom-border-btn btn" onclick="stepper.previous()">Sebelumnya</button>
    <button type="button" class="custom-btn btn" onclick="stepper.next()">Selanjutnya</button>
</div>
