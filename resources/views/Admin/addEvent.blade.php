@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Form Tambah Event</h5>
            <div class="card-body">
                <form class="needs-validation" method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row mb-4">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                            <label for="title" class="form-label">Judul Event</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                placeholder="Masukkan judul event" required>
                            <div class="invalid-feedback">
                                Judul event tidak boleh kosong
                            </div>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                            <label for="image" class="form-label">Gambar Event</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="images" name="images" accept="images/*" required>
                                <label class="input-group-text" for="image">Upload</label>
                            </div>
                            <div class="form-text">Format gambar: JPG, JPEG, PNG. Ukuran maksimal 2MB</div>
                            <div class="invalid-feedback">
                                Gambar event tidak boleh kosong
                            </div>
                            <div class="mt-2">
                                <div id="imagePreview" class="mt-2 d-none">
                                    <img id="previewImg" src="#" alt="Preview" class="img-thumbnail" style="max-height: 200px"/>
                                    <button type="button" class="btn btn-sm btn-danger mt-1" id="removeImage">Hapus Gambar</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" 
                                placeholder="Masukkan deskripsi event" rows="4"></textarea>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                            <label for="venue" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="venue" name="venue" 
                                placeholder="Masukkan lokasi event" required>
                            <div class="invalid-feedback">
                                Lokasi event tidak boleh kosong
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="event_date" class="form-label">Tanggal Event</label>
                            <input type="date" class="form-control" id="event_date" name="event_date" required>
                            <div class="invalid-feedback">
                                Tanggal event tidak boleh kosong
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                            <label for="event_time" class="form-label">Waktu Event</label>
                            <input type="time" class="form-control" id="event_time" name="event_time" required>
                            <div class="invalid-feedback">
                                Waktu event tidak boleh kosong
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                            <label for="total_seats" class="form-label">Total Kursi</label>
                            <input type="number" class="form-control" id="total_seats" name="total_seats" 
                                placeholder="Contoh: 100" required min="1">
                            <div class="invalid-feedback">
                                Total kursi harus diisi dengan angka valid
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                            <label for="available_seats" class="form-label">Kursi Tersedia</label>
                            <input type="number" class="form-control" id="available_seats" name="available_seats" 
                                placeholder="Contoh: 100" required min="0">
                            <div class="invalid-feedback">
                                Kursi tersedia harus diisi dengan angka valid
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                            <label for="price" class="form-label">Harga (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="price" name="price" 
                                    placeholder="Contoh: 150000" required min="0">
                            </div>
                            <div class="form-text">Masukkan harga tanpa tanda titik atau koma</div>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                            <label for="status">Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 text-end">
                            <a href="{{ route('events.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button class="btn btn-primary" type="submit">Simpan Event</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection