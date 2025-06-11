 <div class="row">
                                <div class="col-lg-10">
                                    <h5 class="card-title">Data Menu</h5>
                                </div>
                                <div class="col-lg-2">
                                    <button class="btn btn-outline-primary btn-md" data-bs-toggle="modal"
                                        data-bs-target="#AddMenu" style="margin-top: 10px;">
                                        <i class="bi bi-journal-plus"></i> Tambah Menu
                                    </button>

                                    <div class="modal fade" id="AddMenu" tabindex="-1">
                                        <div class="modal-dialog modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><i class="bi bi-file-post-fill"></i>
                                                        Tambah Menu</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('menu-admin.store') }}" method="POST">
                                                        @csrf
                                                        <div class="row mb-4">
                                                            <label for="inputText" class="col-sm-2 col-form-label">Nama
                                                                Menu</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="name" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label for="inputText"
                                                                class="col-sm-2 col-form-label">Page</label>
                                                            <div class="col-sm-10">
                                                                <select name="order_pos" class="form-control">
                                                                    <option value="">--Page--</option>
                                                                    @foreach ($pages as $page)
                                                                        <option value="{{ $page->id }}">
                                                                            {{ $page->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label for="inputText"
                                                                class="col-sm-2 col-form-label">Link</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="url" class="form-control">
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                                            class="bi bi-x-circle"></i>
                                                        Batal</button>
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="bi bi-file-plus"></i> Tambah
                                                    </button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
