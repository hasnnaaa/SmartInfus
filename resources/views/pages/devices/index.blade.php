@extends('layouts.main')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">MANAJEMEN ALAT & RUANGAN</h5>
        <a href="{{ route('devices.create') }}" class="btn btn-primary">+ Tambah Alat</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Kode Alat (ID)</th>
                    <th>Nama Ruangan</th>
                    <th>Nama Alat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($devices as $d)
                <tr>
                    <td>{{ $d->device_code }}</td>
                    <td>{{ $d->room_name }}</td>
                    <td>{{ $d->device_name }}</td>
                    <td>
                        <span class="badge {{ $d->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $d->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection