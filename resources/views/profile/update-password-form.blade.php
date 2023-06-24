<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="current_password">Password Aktif <span class="text-danger">*</span></label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                name="current_password" id="current_password" placeholder="Enter current password">
            @error('current_password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="password">Password Baru <span class="text-danger">*</span></label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                id="password" placeholder="Enter new password">
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password Baru <span class="text-danger">*</span></label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                name="password_confirmation" id="password_confirmation" placeholder="Enter password confirmation">
            @error('password_confirmation')
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
