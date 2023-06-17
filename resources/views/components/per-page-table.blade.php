<div class="form-inline">
    <label for="per-page">Tampilkan</label>
    <select name="per_page" id="per_page" class="mx-2 custom-select" onchange="$(this.form).submit()">
        <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
        <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
        <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
        <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
    </select>
    <label for="per-page">Baris</label>
</div>
