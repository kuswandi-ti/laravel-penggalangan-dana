<x-form-modal modal_size='modal-lg'>
    <x-slot name='title'>
        Tambah Data Donatur
    </x-slot>

    @method('POST')

    <div class="mb-3 form-group">
        <label for="name">Nama</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3 form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3 form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3 form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-ban"></i> Batal
        </button>
        <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">
            <i class="fas fa-save"></i> Simpan
        </button>
    </x-slot>
</x-form-modal>
