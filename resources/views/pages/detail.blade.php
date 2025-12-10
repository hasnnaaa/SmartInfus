@extends('layouts.main')

@section('content')

<div class="mb-3">
    <a href="{{ route('monitoring.index') }}" class="btn btn-warning text-white">
        <i class="fas fa-arrow-left"></i> Kembali Ke Menu List
    </a>
</div>

<div class="card shadow border-0">
    <div class="card-body px-4 py-4">

        <!-- Heading -->
        <h4 class="fw-bold text-secondary mb-4">DETAIL MONITORING</h4>

        <!-- Informasi Ruangan -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="p-3 bg-light rounded border">
                    <p class="text-muted mb-1 small">KODE RUANGAN</p>
                    <h5 class="fw-bold mb-0" id="device-code">{{ $device->device_code }}</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-light rounded border">
                    <p class="text-muted mb-1 small">NAMA RUANGAN</p>
                    <h5 class="fw-bold mb-0">{{ $device->room_name }}</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-light rounded border">
                    <p class="text-muted mb-1 small">NAMA ALAT</p>
                    <h5 class="fw-bold mb-0">{{ $device->device_name }}</h5>
                </div>
            </div>
        </div>

        @php $log = $device->latestLog; @endphp

        <!-- Berat -->
        <div class="row align-items-center my-5">
            <div class="col-md-4 text-md-end text-center mb-3 mb-md-0">
                <h2 class="text-primary fw-bold mb-0">Berat</h2>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-md-start justify-content-center">
                <div id="detail-berat" class="digital-font">
                    {{ $log ? $log->current_weight : '0' }}
                </div>
                <span class="fs-3 ms-3 fw-bold text-muted">ML</span>
            </div>
        </div>

        <!-- Tetesan -->
        <div class="row align-items-center my-5">
            <div class="col-md-4 text-md-end text-center mb-3 mb-md-0">
                <h2 class="text-danger fw-bold mb-0">Tetesan</h2>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-md-start justify-content-center">
                <div id="detail-tetesan" class="digital-font">
                    {{ $log ? $log->drop_rate : '0' }}
                </div>
                <span class="fs-3 ms-3 fw-bold text-muted">TPM</span>
            </div>
        </div>

        <!-- Status -->
        <div class="row mt-5 justify-content-center">
            <div class="col-md-8">
                <div id="box-status"
                     class="alert text-center fs-5 fw-bold 
                     alert-{{ $log ? $log->color_berat : 'secondary' }}">
                    STATUS INFUS:
                    <span id="text-status">
                        {{ $log ? $log->status_berat : 'OFFLINE' }}
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    async function updateDetail() {
        try {
            let currentCode = document.getElementById('device-code').innerText;

            let response = await fetch('/api/infus/all-status');
            let devices = await response.json();

            let myDevice = devices.find(d => d.device_code === currentCode);

            if (myDevice && myDevice.latest_log) {
                let log = myDevice.latest_log;

                document.getElementById('detail-berat').innerText = log.current_weight;
                document.getElementById('detail-tetesan').innerText = log.drop_rate;

                let box = document.getElementById('box-status');
                let text = document.getElementById('text-status');

                box.className = `alert alert-${log.color_berat} text-center fs-5 fw-bold`;
                text.innerText = log.status_berat;
            }
        } catch (error) {
            console.log("Gagal update detail: " + error);
        }
    }

    setInterval(updateDetail, 3000);
</script>

@endsection
