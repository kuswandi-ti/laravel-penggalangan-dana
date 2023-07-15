<form action="{{ route('user-profile-information.update') }}?tab=profil" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="mb-3 text-center">
                    @if (!empty(auth()->user()->path_image))
                        <img class="img-fluid img-circle preview-path_image"
                            src="{{ url(env('PATH_IMAGE_STORAGE') . auth()->user()->path_image) }}"
                            alt="User profile picture" width="200">
                    @else
                        <img class="img-fluid img-circle preview-path_image" src="{{ url(env('NO_IMAGE_CIRCLE')) }}"
                            alt="User profile picture" width="200">
                    @endif
                </div>
                <div class="mb-3 custom-file">
                    <input type="file" class="custom-file-input" id="path_image" name="path_image"
                        onchange="preview('.preview-path_image', this.files[0])">
                    <label class="custom-file-label" for="path_image">Choose file</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="name">Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    id="name" value="{{ old('name') ?? auth()->user()->name }}" placeholder="Enter full name"
                    required>
                @error('name')
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
                    id="email" value="{{ old('email') ?? auth()->user()->email }}" placeholder="Enter email"
                    required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" class="form-control @error('role') is-invalid @enderror" name="role"
                    id="role" value="{{ old('role') ?? auth()->user()->role->name }}" placeholder="Enter role"
                    disabled>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="phone">No. Telp.</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                    id="phone" value="{{ old('phone') ?? auth()->user()->phone }}" placeholder="Enter phone">
                @error('phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="job">Pekerjaan</label>
                <input type="text" class="form-control @error('job') is-invalid @enderror" name="job"
                    id="job" value="{{ old('job') ?? auth()->user()->job }}" placeholder="Enter job">
                @error('job')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="gender">Jenis Kelamin</label>
                <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender"
                    placeholder="Enter gender">
                    <option selected disabled>Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki" {{ auth()->user()->gender == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                    </option>
                    <option value="Perempuan" {{ auth()->user()->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
                @error('gender')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="birth_date">Tanggal Lahir</label>
                <div class="input-group datepicker" id="birth_date" data-target-input="nearest">
                    <input type="text" name="birth_date" class="form-control datetimepicker-input"
                        data-target="#birth_date" value="{{ old('birth_date') ?? auth()->user()->birth_date }}"
                        placeholder="Enter birth date">
                    <div class="input-group-append" data-target="#birth_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                @error('birth_date')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter address">{{ old('address') ?? auth()->user()->address }}</textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="about">Tentang</label>
                <textarea class="form-control" name="about" id="about" rows="3" placeholder="Enter about">{{ old('about') ?? auth()->user()->about }}</textarea>
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

@includeIf('includes.datepicker')
