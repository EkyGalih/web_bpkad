@extends('admin.index')
@section('title', 'Sosial Media')
@section('content')
    <div class="container-xxl flex-grow-1 contaner-p-y">
        <div class="card">
            <div class="card-header d-flex-justify-content-between align-items-center">
                <h4 class="card-title">Sosial Media</h4>
            </div>
            <form action="{{ route('social.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" class="form-control" id="twitter" name="twitter"
                            placeholder="Twitter" value="{{ $social->twitter }}">
                        <label for="twitter">Twitter</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" class="form-control" id="facebook" name="facebook"
                            placeholder="Facebook" value="{{ $social->facebook }}">
                        <label for="facebook">Facebook</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" class="form-control" id="instagram" name="instagram"
                            placeholder="Instagram" value="{{ $social->instagram }}">
                        <label for="instagram">Instagram</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" class="form-control" id="youtube" name="youtube"
                            placeholder="Youtube" value="{{ $social->youtube }}">
                        <label for="youtube">Youtube</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-6">
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                            placeholder="Whatsapp" value="{{ $social->whatsapp }}">
                        <label for="whatsapp">Whatsapp</label>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('social.index') }}" class="btn btn-outline-secondary">
                            <i class="icon-base ri ri-arrow-left-line"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-outline-success">
                            <i class="icon-base ri ri-save-line"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
