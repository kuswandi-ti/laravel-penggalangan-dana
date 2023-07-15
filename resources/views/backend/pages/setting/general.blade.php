<form action="{{ route('backend.setting.update', !empty($setting->id) ? $setting->id : '') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="owner_name">Nama Pemilik <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('owner_name') is-invalid @enderror" name="owner_name"
                    id="owner_name" value="{{ old('owner_name') ?? ($setting->owner_name ?? '') }}"
                    placeholder="Masukkan Nama Pemilik Bisnis">
                @error('owner_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="company_name">Nama Perusahaan <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                    name="company_name" id="company_name"
                    value="{{ old('company_name') ?? ($setting->company_name ?? '') }}"
                    placeholder="Masukkan Nama Perusahaan">
                @error('company_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="business_name">Nama Bisnis <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('business_name') is-invalid @enderror"
                    name="business_name" id="business_name"
                    value="{{ old('business_name') ?? ($setting->business_name ?? '') }}"
                    placeholder="Masukkan Nama Bisnis">
                @error('business_name')
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
                    id="email" value="{{ old('email') ?? ($setting->email ?? '') }}" placeholder="Masukkan Email"
                    required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="phone">No. Telp <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                    id="phone" value="{{ old('phone') ?? ($setting->phone ?? '') }}"
                    placeholder="Masukkan No. Telepon / HP" required>
                @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="short_description">Deskripsi Singkat / Tagline <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('short_description') is-invalid @enderror"
                    name="short_description" id="short_description"
                    value="{{ old('short_description') ?? ($setting->short_description ?? '') }}"
                    placeholder="Masukkan Deskripsi Singkat / Tagline Bisnis" required>
                @error('short_description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="keyword">Kata Kunci Pencarian <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('keyword') is-invalid @enderror" name="keyword"
                    id="keyword" value="{{ old('keyword') ?? ($setting->keyword ?? '') }}"
                    placeholder="Masukkan Kata Kunci Pencarian Situs" required>
                @error('keyword')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="work_hours">Hari & Jam Kerja</label>
                <input type="text" class="form-control @error('work_hours') is-invalid @enderror" name="work_hours"
                    id="work_hours" value="{{ old('work_hours') ?? ($setting->work_hours ?? '') }}"
                    placeholder="Masukkan Hari & Jam Kerja" required>
                @error('work_hours')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="about">Tentang</label>
                <textarea class="form-control summernote" name="about" id="about" rows="3"
                    placeholder="Masukkan Informasi Tentang Bisnis">
                    {{ old('about') ?? ($setting->about ?? '') }}
                </textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="vision">Visi</label>
                <textarea class="form-control summernote" name="vision" id="vision" rows="3"
                    placeholder="Masukkan Visi Bisnis">
                    {{ old('vision') ?? ($setting->vision ?? '') }}
                </textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea class="form-control" name="address" id="address" rows="4" placeholder="Masukkan Alamat Bisnis">{{ old('address') ?? ($setting->address ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="postal_code">Kode Pos <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                    name="postal_code" id="postal_code"
                    value="{{ old('postal_code') ?? ($setting->postal_code ?? '') }}" placeholder="Masukkan Kode Pos"
                    required>
                @error('postal_code')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="city">Kota <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                    id="city" value="{{ old('city') ?? ($setting->city ?? '') }}" placeholder="Masukkan Kota"
                    required>
                @error('city')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="province">Propinsi <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('province') is-invalid @enderror" name="province"
                    id="province" value="{{ old('province') ?? ($setting->province ?? '') }}"
                    placeholder="Masukkan Provinsi" required>
                @error('province')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude"
                    id="longitude" value="{{ old('longitude') ?? ($setting->longitude ?? '') }}"
                    placeholder="Masukkan Longitude">
                @error('longitude')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude"
                    id="city" value="{{ old('latitude') ?? ($setting->latitude ?? '') }}"
                    placeholder="Masukkan Latitude">
                @error('latitude')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="contact_person_name">Nama Kontak Person</label>
                <input type="text" class="form-control @error('contact_person_name') is-invalid @enderror"
                    name="contact_person_name" id="contact_person_name"
                    value="{{ old('contact_person_name') ?? ($setting->contact_person_name ?? '') }}"
                    placeholder="Masukkan Nama Kontak Person">
                @error('contact_person_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="contact_person_title">Jabatan Kontak Person</label>
                <input type="text" class="form-control @error('contact_person_title') is-invalid @enderror"
                    name="contact_person_title" id="city"
                    value="{{ old('contact_person_title') ?? ($setting->contact_person_title ?? '') }}"
                    placeholder="Masukkan Jabatan Kontak Person">
                @error('contact_person_title')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <label>Foto Kontak Person (.png, .jpg, .jpeg. Max 2MB)</label>
            <div class="form-group">
                <div class="mb-3 text-center">
                    @if (!empty($setting->contact_person_path_image))
                        <img class="img-fluid preview-contact_person_path_image"
                            src="{{ url(env('PATH_IMAGE_STORAGE') . $setting->contact_person_path_image) }}"
                            width="200">
                    @else
                        <img class="img-fluid preview-contact_person_path_image"
                            src="{{ url(env('NO_IMAGE_CIRCLE')) }}" width="200">
                    @endif
                </div>
                <div class="mb-3 custom-file">
                    <input type="file" class="custom-file-input" id="contact_person_path_image"
                        name="contact_person_path_image"
                        onchange="preview('.preview-contact_person_path_image', this.files[0])">
                    <label class="custom-file-label" for="contact_person_path_image">Choose file</label>
                </div>
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
</form>

<x-swal />

@includeIf('includes.summernote')
