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
    <button class="custom-btn custom-border-btn btn" onclick="stepper.previous()">Sebelumnya</button>
    <button type="button" class="custom-btn btn" onclick="stepper.next()">Selanjutnya</button>
</div>
