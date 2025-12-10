@extends('layouts.main')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">LIST DATA MONITORING</h5>
    </div>
    <div class="card-body">
        <form action="" method="GET" class="mb-4">
            <div class="input-group" style="max-width: 300px;">
                <input type="text" name="search" class="form-control" placeholder="Cari Ruangan...">
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>KODE</th>
                        <th>NAMA RUANGAN</th>
                        <th>NAMA ALAT</th>
                        <th>STATUS ALAT</th>
                        <th>BERAT INFUS</th>
                        <th>STATUS BERAT</th>
                        <th>TETESAN (TPM)</th>
                        <th>STATUS TETESAN</th>
                        <th>TANGGAL INPUT</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($devices as $d)
                    @php $log = $d->latestLog; @endphp
                    <tr id="row-{{ $d->device_code }}">
                        <td>{{ $d->device_code }}</td>
                        <td>{{ $d->room_name }}</td>
                        <td>{{ $d->device_name }}</td>
                        <td>
                            <span class="badge {{ $d->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $d->is_active ? 'AKTIF' : 'TIDAK AKTIF' }}
                            </span>
                        </td>
                        
                        @if($log)
                            <td class="berat-val">{{ $log->current_weight }} ML</td>
                            <td><span class="badge badge-berat bg-{{ $log->color_berat }}">{{ $log->status_berat }}</span></td>
                            <td class="tetesan-val">{{ $log->drop_rate }}</td>
                            <td class="status-tetesan-val">{{ $log->status_tetesan }}</td>
                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        @else
                            <td colspan="5" class="text-center text-muted">Belum ada data</td>
                        @endif

                        <td>
                            <a href="{{ route('monitoring.detail', $d->device_code) }}" class="btn btn-sm btn-info text-white">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10" class="text-center">Data tidak ditemukan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    async function updateTable() {
        try {
            let response = await fetch('/api/infus/all-status');
            let devices = await response.json();

            devices.forEach(device => {
                let log = device.latest_log; // Data log terakhir
                
                if (log) {
                    let row = document.getElementById(`row-${device.device_code}`);
                    
                    if (row) {
                        row.querySelector('.berat-val').innerText = log.current_weight + ' ML';
                        
                        let badgeBerat = row.querySelector('.badge-berat');
                        badgeBerat.className = `badge badge-berat bg-${log.color_berat}`; // Pakai Accessor Model
                        badgeBerat.innerText = log.status_berat;

                        row.querySelector('.tetesan-val').innerText = log.drop_rate;
                        row.querySelector('.status-tetesan-val').innerText = log.status_tetesan;
                    }
                }
            });
        } catch (error) {
            console.log("Gagal update data: " + error);
        }
    }

    setInterval(updateTable, 3000);
</script>
@endsection