@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Form Event</h5>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="{{ route('events.update', $event->id) }}" novalidate>
                        @csrf
                        <div class="row mb-4">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label for="title" class="form-label">Judul Event</label>
                                <input value="{{ $event->title }}" type="text" class="form-control" id="title"
                                    name="title" placeholder="Masukkan judul event" required>
                                <div class="invalid-feedback">
                                    Judul event tidak boleh kosong
                                </div>
                            </div>
                            
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" 
                                    placeholder="Masukkan deskripsi event" rows="4">{{ $event->description }}</textarea>
                            </div>
                            
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label for="venue" class="form-label">Lokasi</label>
                                <input value="{{ $event->venue }}" class="form-control" id="venue" name="venue"
                                    placeholder="Masukkan lokasi event" required>
                                <div class="invalid-feedback">
                                    Lokasi event tidak boleh kosong
                                </div>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                <label for="event_date" class="form-label">Tanggal Event</label>
                                <input value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') }}"
                                    type="date" class="form-control" id="event_date" name="event_date" required>
                                <div class="invalid-feedback">
                                    Tanggal event tidak boleh kosong
                                </div>
                            </div>
                            
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                <label for="event_time" class="form-label">Waktu Event</label>
                                <input value="{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }}" type="time" class="form-control"
                                    id="event_time" name="event_time" required>
                                <div class="invalid-feedback">
                                    Waktu event tidak boleh kosong
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                <label for="total_seats" class="form-label">Total Kursi</label>
                                <input value="{{ $event->total_seats }}" type="number" class="form-control"
                                    id="total_seats" name="total_seats" placeholder="Contoh: 100" required min="1">
                                <div class="invalid-feedback">
                                    Total kursi harus diisi dengan angka valid
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                <label for="available_seats" class="form-label">Kursi Tersedia</label>
                                <input value="{{ $event->available_seats }}" type="number" class="form-control" id="available_seats"
                                    name="available_seats" placeholder="Contoh: 100" required min="0">
                                <div class="invalid-feedback">
                                    Kursi tersedia harus diisi dengan angka valid
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                                <label for="price" class="form-label">Harga (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input value="{{ $event->price }}" class="form-control" id="price" name="price"
                                        placeholder="Contoh: 150000" required type="number" min="0">
                                </div>
                                <div class="form-text">Masukkan harga tanpa tanda titik atau koma</div>
                            </div>
                            
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="draft" {{ $event->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $event->status == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="cancelled" {{ $event->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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

    <script>
        // Script untuk validasi form bootstrap
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Format harga dengan pemisah ribuan
        document.getElementById('price').addEventListener('input', function(e) {
            // Hapus semua karakter non-digit
            let value = this.value.replace(/\D/g, '');
            this.value = value;
        });
    </script>
@endsection