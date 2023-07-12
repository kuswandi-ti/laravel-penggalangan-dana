<div class="mt-3 row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Apa judul untuk program ini ? <span class="text-danger">*</span></label>
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
    <div class="form-group">
        <label for="short_description">Ceritakan tentang diri anda, alasan membuat program, rencana penggunaan dana
            <span class="text-danger">*</span></label>
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

<div class="mt-3 row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="goal">Target donasi <span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                </div>
                <input type="number" class="form-control @error('goal') is-invalid @enderror" name="goal"
                    id="goal" value="{{ old('goal') }}" placeholder="Masukkan Target Donasi">
            </div>
            @error('goal')
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
            <label for="end_date">Batas waktu penggalangan dana <span class="text-danger">*</span></label>
            <div class="input-group datetimepicker" id="end_date" data-target-input="nearest">
                <div class="input-group-prepend" data-target="#end_date" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="bi bi-calendar-event-fill"></i></div>
                </div>
                <input type="text" name="end_date" id="end_date" value="{{ old('end_date') }}"
                    class="form-control datetimepicker-input @error('end_date') is-invalid @enderror"
                    data-target="#end_date" placeholder="Pilih Tanggal Selesai">
                @error('end_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="mt-3 form-group">
    <button type="button" class="custom-btn btn" onclick="stepper.next()">Selanjutnya</button>
</div>
