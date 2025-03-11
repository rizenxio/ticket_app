@extends('layouts.Admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Event</h5>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm rounded-pill px-4">+ Add Data</a>
                </div>
            </div>
            
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <!-- Summary Cards -->
            <div class="row mx-1 mt-3">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body py-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt fa-2x me-3"></i>
                                <div>
                                    <h6 class="mb-0">Total Events</h6>
                                    <h3 class="mb-0">{{ $events->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card bg-success text-white">
                        <div class="card-body py-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle fa-2x me-3"></i>
                                <div>
                                    <h6 class="mb-0">Published</h6>
                                    <h3 class="mb-0">{{ $events->where('status', 'published')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card bg-warning text-dark">
                        <div class="card-body py-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-edit fa-2x me-3"></i>
                                <div>
                                    <h6 class="mb-0">Draft</h6>
                                    <h3 class="mb-0">{{ $events->where('status', 'draft')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body py-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-times-circle fa-2x me-3"></i>
                                <div>
                                    <h6 class="mb-0">Cancelled</h6>
                                    <h3 class="mb-0">{{ $events->where('status', 'cancelled')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="50">#</th>
                                <th scope="col" width="80">Gambar</th>
                                <th scope="col">Informasi Event</th>
                                <th scope="col">Kapasitas</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Status</th>
                                <th scope="col" width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $index => $event)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>
                                    @if($event->images)
                                        <img src="{{ asset('assets/images/'. $event->images) }}" 
                                             alt="{{ $event->title }}" 
                                             class="img-thumbnail" 
                                             style="width: 70px; height: 70px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" 
                                             style="width: 70px; height: 70px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <h6 class="mb-1">{{ $event->title }}</h6>
                                    <div class="small text-muted mb-1">
                                        <i class="fas fa-map-marker-alt me-1"></i> {{ $event->venue }}
                                    </div>
                                    <div class="small text-muted">
                                        <i class="fas fa-calendar me-1"></i> 
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                        <i class="fas fa-clock ms-2 me-1"></i>
                                        {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <span class="fw-bold">{{ $event->available_seats }}</span>
                                            <span class="text-muted">/</span>
                                            <span>{{ $event->total_seats }}</span>
                                        </div>
                                        @php
                                            $percentage = ($event->available_seats / $event->total_seats) * 100;
                                            $barColor = $percentage > 70 ? 'bg-success' : 
                                                       ($percentage > 30 ? 'bg-warning' : 'bg-danger');
                                        @endphp
                                        <div class="progress flex-grow-1" style="height: 6px;">
                                            <div class="progress-bar {{ $barColor }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $percentage }}%" 
                                                 aria-valuenow="{{ $percentage }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold">
                                        Rp {{ number_format($event->price, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    @if($event->status == 'published')
                                        <span class="badge bg-success text-white">Published</span>
                                    @elseif($event->status == 'draft')
                                        <span class="badge bg-warning text-white">Draft</span>
                                    @else
                                        <span class="badge bg-danger text-white">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('events.edit', $event->id) }}" 
                                           class="btn btn-outline-warning btn-sm" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('events.destroy', ['id' => $event->id]) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-outline-danger btn-sm" 
                                                    title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus event ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form> 
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection