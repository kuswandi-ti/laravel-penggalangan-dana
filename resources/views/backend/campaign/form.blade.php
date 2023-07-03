<x-form-modal modal_size='modal-lg'>
    <x-slot name='title'>
        Tambah Data Projek
    </x-slot>

    @method('POST')

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title">Judul <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Masukkan judul projek"
                    required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="categories[]">Kategori <span class="text-danger">*</span></label>
                <select class="select2" name="categories[]" id="categories" multiple required>
                    @foreach ($categories as $key => $category)
                        <option value="{{ $key }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="short_description">Short Description <span class="text-danger">*</span></label>
                <textarea class="form-control" name="short_description" id="short_description" rows="3" required></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="body">Content / Body <span class="text-danger">*</span></label>
                <textarea class="form-control summernote" name="body" id="body" rows="3" required></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="publish_date">Tanggal Publish <span class="text-danger">*</span></label>
                <div class="input-group datetimepicker" id="publish_date" data-target-input="nearest">
                    <input type="text" name="publish_date" class="form-control datetimepicker-input"
                        data-target="#publish_date" required>
                    <div class="input-group-append" data-target="#publish_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="status">Status <span class="text-danger">*</span></label>
                <select class="custom-select" name="status" id="status" style="width: 100%;" required>
                    <option disabled selected>Pilih status...</option>
                    <option value="publish">Publish</option>
                    <option value="pending">Pending</option>
                    <option value="archieve">Diarsipkan</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="goal">Goal <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="goal" id="goal" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="end_date">Tanggal Selesai <span class="text-danger">*</span></label>
                <div class="input-group datetimepicker" id="end_date" data-target-input="nearest">
                    <input type="text" name="end_date" class="form-control datetimepicker-input"
                        data-target="#end_date" required>
                    <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="note">Note</label>
                <textarea class="form-control" name="note" id="note" rows="3"></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="receiver">Penerima <span class="text-danger">*</span></label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="receiver" id="saya"
                        value="Saya Sendiri">
                    <label for="saya" class="custom-control-label font-weight-normal">Saya Sendiri</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="receiver" id="keluarga"
                        value="Keluarga / Kerabat">
                    <label for="keluarga" class="custom-control-label font-weight-normal">Keluarga / Kerabat</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="receiver" id="organisasi"
                        value="Organisasi / Lembaga">
                    <label for="organisasi" class="custom-control-label font-weight-normal">Organisasi /
                        Lembaga</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="receiver" id="lainnya"
                        value="Lainnya">
                    <label for="lainnya" class="custom-control-label font-weight-normal">Lainnya</label>
                </div>
            </div>
            <div class="form-group">
                <label for="type">Tipe Projek <span class="text-danger">*</span></label>
                <select class="custom-select" name="type" id="type" style="width: 100%;" required>
                    <option disabled selected>Pilih tipe projek...</option>
                    <option value="general">General</option>
                    <option value="urgent">Urgent</option>
                    <option value="feature">Feature</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="path_image">Gambar <span class="text-danger">*</span></label>
                <div class="custom-file">
                    <input type="file" name="path_image" class="custom-file-input" id="path_image"
                        onchange="preview('.preview-path_image', this.files[0])" required>
                    <label class="custom-file-label" for="path_image">Choose file</label>
                </div>
            </div>
            <img src="" alt="" class="img-thumbnail preview-path_image" style="display: none;">
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="fas fa-chevron-circle-left"></i> Kembali
        </button>
        <button type="reset" class="btn btn-warning">
            <i class="fas fa-ban"></i> Reset
        </button>
        <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">
            <i class="fas fa-save"></i> Simpan
        </button>
    </x-slot>
</x-form-modal>
