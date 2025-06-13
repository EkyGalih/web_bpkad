<!-- Modal -->
<div class="modal fade" id="olympicModal" tabindex="-1" aria-labelledby="olympicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="olympicModalLabel">Tambah Periode Olympic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="{{ route('olympic-admin.create-periode') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" class="form-control" id="tahun" name="name"
                            placeholder="Nama Olympic" required>
                        <label for="tahun">Nama Olympic</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="icon-base ri ri-add-large-line me-2"></i> Tambah
                    </button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="icon-base ri ri-close-line me-2"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <form
                                action="{{ $olympic == null ? route('olympic-admin.store') : route('olympic-admin.update', $olympic->id) }}"
                                method="POST">
                                @csrf
                                @if (!empty($olympic))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <label for="inputtext"><i class="bi bi-instagram"></i> Bidang</label>
                                    <div class="col-lg-12">
                                        <select name="bidang_id" class="form-control">
                                            <option value="">--- Pilih Bidang ---</option>
                                            @foreach ($bidangs as $bidang)
                                                @if (empty($olympic))
                                                    <option value="{{ $bidang->uuid }}">{{ $bidang->nama_bidang }}</option>
                                                @else
                                                    <option value="{{ $bidang->uuid }}"
                                                        {{ $olympic->bidang_id == $bidang->uuid ? 'selected' : '' }}>
                                                        {{ $bidang->nama_bidang }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inputText"><i class="bi bi-award-fill"></i> Emas</label>
                                        <input type="link" class="form-control" name="emas"
                                            value="{{ $olympic->emas ?? '' }}">
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inputText"><i class="bi bi-award-fill"></i> Perak</label>
                                        <input type="link" class="form-control" name="perak"
                                            value="{{ $olympic->perak ?? '' }}">
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inputText"><i class="bi bi-award-fill"></i> Perunggu</label>
                                        <input type="link" class="form-control" name="perunggu"
                                            value="{{ $olympic->perunggu ?? '' }}">
                                    </div>
                                </div><br />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-success btn-md">
                                            <i class="bi bi-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </form> --}}
