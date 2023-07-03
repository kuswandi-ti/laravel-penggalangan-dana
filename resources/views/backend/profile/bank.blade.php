<form action="{{ route('user-profile-information.update') }}?tab=bank" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="bank_id">Bank <span class="text-danger">*</span></label>
                <select class="form-control @error('bank_id') is-invalid @enderror" name="bank_id" id="bank_id">
                    <option disabled selected>Pilih bank</option>
                    @foreach ($bank as $key => $item)
                        <option value="{{ $key }}" {{ old('bank_id') == $key ? 'selected' : '' }}>
                            {{ $item }}</option>
                    @endforeach
                </select>
                @error('bank_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="account_number">Nomor Rekening <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                    name="account_number" id="account_number" value="{{ old('account_number') }}"
                    placeholder="Enter bank account number" required>
                @error('account_number')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="account_name">Nama Rekening <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('account_name') is-invalid @enderror"
                    name="account_name" id="account_name" value="{{ old('account_name') }}"
                    placeholder="Enter bank account name" required>
                @error('account_name')
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
</form>

<div class="mt-3 row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Daftar Bank</strong></h3>
            </div>

            <div class="p-0 card-body table-responsive">
                <x-table class="text-nowrap">
                    <x-slot name="thead">
                        <th class="text-center">No</th>
                        <th class="text-center">Bank</th>
                        <th>Nama</th>
                        <th class="text-center">Nomor Rekening</th>
                        <th class="text-center"><i class="fas fa-cog"></i></th>
                    </x-slot>
                    @forelse ($user->bank_users as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $item->name }}</td>
                            <td>{{ $item->pivot->account_name }}</td>
                            <td class="text-center">{{ $item->pivot->account_number }}</td>
                            <td class="text-center">
                                <form action="{{ route('profile.bank.destroy', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link text-danger"
                                        onclick="return confirm('Yakin akan menghapus data ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-danger">Tidak ada data</td>
                        </tr>
                    @endforelse
                </x-table>
            </div>
        </div>
    </div>
</div>

<x-swal />
