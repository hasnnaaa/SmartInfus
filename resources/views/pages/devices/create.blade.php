@extends('layouts.main')

@section('content')
<div class="card shadow border-0" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header bg-white">
        <h5 class="fw-bold mb-0">TAMBAH ALAT BARU</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('devices.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="fw-bold">Kode Unik Alat (ID)</label>
                <input type="text" name="device_code" class="form-control" placeholder="Contoh: KAMAR-03" required>
                <small class="text-muted">Kode ini harus sama dengan yang di-setting di Simulator/ESP32.</small>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Nama Ruangan</label>
                <input type="text" name="room_name" class="form-control" placeholder="Contoh: Ruang Mawar 03" required>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Nama Alat</label>
                <input type="text" name="device_name" class="form-control" placeholder="Contoh: Infusan Pasien C" required>
            </div>
            
            <button class="btn btn-success w-100 mt-3">SIMPAN DATA</button>
            <a href="{{ route('devices.index') }}" class="btn btn-light w-100 mt-2">Batal</a>
        </form>
    </div>
</div>
@endsection