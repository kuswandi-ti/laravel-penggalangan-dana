<div class="mt-3 row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="receiver">Penerima <span class="text-danger">*</span></label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input @error('receiver') is-invalid @enderror" type="radio" name="receiver"
                    id="saya" value="Saya Sendiri">
                <label for="saya" class="custom-control-label font-weight-normal">Saya
                    Sendiri</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input @error('receiver') is-invalid @enderror" type="radio"
                    name="receiver" id="keluarga" value="Keluarga / Kerabat">
                <label for="keluarga" class="custom-control-label font-weight-normal">Keluarga /
                    Kerabat</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input @error('receiver') is-invalid @enderror" type="radio"
                    name="receiver" id="organisasi" value="Organisasi / Lembaga">
                <label for="organisasi" class="custom-control-label font-weight-normal">Organisasi /
                    Lembaga</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input @error('receiver') is-invalid @enderror" type="radio"
                    name="receiver" id="lainnya" value="Lainnya">
                <label for="lainnya" class="custom-control-label font-weight-normal">Lainnya</label>
            </div>
            @error('receiver')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="alert alert-primary">
    Saya setuju dengan <strong>syarat & ketentuan</strong> donasi dari KitaBersatu
</div>

<div class="mt-3 form-group">
    <button class="custom-btn custom-border-btn btn" onclick="stepper.previous()">Sebelumnya</button>
    <button type="button" class="custom-btn btn" onclick="submitForm()">Submit Program</button>
</div>
