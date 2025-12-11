@extends('layouts.main')

@section('content')

<style>
    .digital-display {
        background-color: #ffffff;
        color: #212529;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        font-weight: 800;
        letter-spacing: 1px;
        padding: 15px 0;
        width: 100%;
        min-width: 120px;
        display: inline-block;
        text-align: center;
        border-radius: 12px;
        border: 1px solid #dee2e6;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
</style>

<div class="container-fluid py-4">

    <div class="mb-4">
        <a href="{{ route('monitoring.index') }}" class="btn btn-warning text-white shadow-sm px-4">
            <i class="fas fa-arrow-left me-2"></i> Kembali Ke List
        </a>
    </div>

    <div class="card shadow-lg border-0 rounded-3">

        <div class="card-header bg-white border-bottom py-3">
            <h5 class="fw-bold text-primary mb-0">
                <i class="fas fa-desktop me-2"></i> DETAIL MONITORING INFUS
            </h5>
        </div>

        <div class="card-body p-4">

            {{-- Informasi Device --}}
            <div class="row g-3 mb-5">
                <div class="col-md-4">
                    <div class="d-flex align-items-center p-3 border rounded bg-light h-100">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                            <i class="fas fa-hashtag fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small fw-bold">KODE RUANGAN</p>
                            <h5 class="fw-bold mb-0 text-dark" id="device-code">
                                {{ $device->device_code }}
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex align-items-center p-3 border rounded bg-light h-100">
                        <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                            <i class="fas fa-hospital fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small fw-bold">NAMA RUANGAN</p>
                            <h5 class="fw-bold mb-0 text-dark">{{ $device->room_name }}</h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex align-items-center p-3 border rounded bg-light h-100">
                        <div class="icon-box bg-info bg-opacity-10 text-info me-3">
                            <i class="fas fa-microchip fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small fw-bold">NAMA ALAT</p>
                            <h5 class="fw-bold mb-0 text-dark">{{ $device->device_name }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            @php $log = $device->latestLog; @endphp

            {{-- Data Utama --}}
            <div class="row g-4 mb-4">

                <div class="col-md-6">
                    <div class="card border-primary border-2 h-100 shadow-sm">
                        <div class="card-body text-center py-4">
                            <h4 class="text-primary fw-bold text-uppercase mb-3">
                                <i class="fas fa-weight-hanging me-2"></i> Berat Cairan
                            </h4>

                            <div class="d-flex justify-content-center align-items-end">
                                <h1 id="detail-berat" class="display-4 fw-bold mb-0 digital-display">
                                    {{ $log? $log->current_weight : '0' }}
                                </h1>
                                <span class="fs-4 ms-2 text-muted fw-bold pb-2">ML</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-danger border-2 h-100 shadow-sm">
                        <div class="card-body text-center py-4">
                            <h4 class="text-danger fw-bold text-uppercase mb-3">
                                <i class="fas fa-tint me-2"></i> Kecepatan Tetesan
                            </h4>

                            <div class="d-flex justify-content-center align-items-end">
                                <h1 id="detail-tetesan"
                                    class="display-4 fw-bold mb-0 digital-display"
                                    style="color: #ff4444;">
                                    {{ $log? $log->drop_rate : '0' }}
                                </h1>
                                <span class="fs-4 ms-2 text-muted fw-bold pb-2">TPM</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Status --}}
            <div class="row justify-content-center mt-4">
                <div class="col-12">
                    <div id="box-status"
                        class="alert text-center fs-5 fw-bold py-4 shadow-sm border-0
                                alert-{{ $log ? $log->getStatusColor() : 'secondary' }}">
                        STATUS INFUS:
                        <span id="text-status" class="text-uppercase border-bottom border-dark border-2 px-2">
                            {{ $log ? $log->getStatusLabel() : 'OFFLINE' }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    async function updateDetail() {
        try {
            const currentCode = document.getElementById('device-code').innerText;

            const response = await fetch('/api/infus/all-status');
            const devices = await response.json();

            const myDevice = devices.find(d => d.device_code === currentCode);

            if (myDevice?.latest_log) {
                const log = myDevice.latest_log;

                document.getElementById('detail-berat').innerText = log.current_weight;
                document.getElementById('detail-tetesan').innerText = log.drop_rate;

                const box = document.getElementById('box-status');
                const text = document.getElementById('text-status');

                box.className = `alert alert-${log.color_berat} text-center py-4 shadow-sm border-0`;
                text.innerText = log.status_berat;
            }
        } catch (error) {
            console.log("Gagal update detail:", error);
        }
    }

    setInterval(updateDetail, 3000);
</script>

@endsection
