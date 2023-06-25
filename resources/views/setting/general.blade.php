<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="owner_name">Nama Pemilik <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('owner_name') is-invalid @enderror" name="owner_name"
                id="owner_name"
                value="{{ old('owner_name') ?? (!empty($setting->owner_name) ? $setting->owner_name : '') }}"
                placeholder="Enter owner name" required>
            @error('owner_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="company_name">Nama Perusahaan <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name"
                id="company_name"
                value="{{ old('company_name') ?? (!empty($setting->company_name) ? $setting->company_name : '') }}"
                placeholder="Enter company name" required>
            @error('company_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                id="email" value="{{ old('email') ?? (!empty($setting->email) ? $setting->email : '') }}"
                placeholder="Enter email" required>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="phone">No. Telp <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                id="phone" value="{{ old('phone') ?? (!empty($setting->phone) ? $setting->phone : '') }}"
                placeholder="Enter phone" required>
            @error('phone')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="short_description">Deskripsi Singkat <span class="text-danger">*</span></label>
            <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                id="short_description" rows="3" placeholder="Enter short description" required>{{ old('short_description') ?? (!empty($setting->short_description) ? $setting->short_description : '') }}</textarea>
            @error('short_description')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="keyword">Kata Kunci Pencarian <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('keyword') is-invalid @enderror" name="keyword"
                id="keyword" value="{{ old('keyword') ?? (!empty($setting->keyword) ? $setting->keyword : '') }}"
                placeholder="Enter keyword" required>
            @error('keyword')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="about">Tentang</label>
            <textarea class="form-control" name="about" id="about" rows="3" placeholder="Enter about">{{ old('about') ?? (!empty($setting->about) ? $setting->about : '') }}</textarea>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="address">Alamat</label>
            <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter address">{{ old('address') ?? (!empty($setting->address) ? $setting->address : '') }}</textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="postal_code">Kode Pos <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code"
                id="postal_code"
                value="{{ old('postal_code') ?? (!empty($setting->postal_code) ? $setting->postal_code : '') }}"
                placeholder="Enter postal code" required>
            @error('postal_code')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="city">Kota <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                id="city" value="{{ old('city') ?? (!empty($setting->city) ? $setting->city : '') }}"
                placeholder="Enter city" required>
            @error('city')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="province">Propinsi <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('province') is-invalid @enderror" name="province"
                id="province"
                value="{{ old('province') ?? (!empty($setting->province) ? $setting->province : '') }}"
                placeholder="Enter province" required>
            @error('province')
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
