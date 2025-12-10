<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Smart Infusion Monitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .card-infus { border-radius: 15px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .digital-number { 
            font-family: 'Courier New', monospace; 
            font-weight: bold; 
            font-size: 2.5rem; 
            color: #28a745; /* Hijau Default */
        }
        .status-badge { font-size: 1rem; padding: 5px 15px; border-radius: 20px; }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 fw-bold text-primary">🏥 Central Monitoring Dashboard</h2>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card card-infus p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-secondary">KAMAR MELATI 01</h5>
                    <span id="badge-status" class="badge bg-success status-badge">NORMAL</span>
                </div>
                
                <div class="row text-center">
                    <div class="col-6 border-end">
                        <p class="text-muted mb-0">Sisa Cairan</p>
                        <div id="angka-berat" class="digital-number">0 ML</div>
                    </div>

                    <div class="col-6">
                        <p class="text-muted mb-0">Estimasi Habis</p>
                        <h3 id="angka-waktu" class="fw-bold text-dark mt-2">-</h3>
                        <small class="text-muted" style="font-size: 0.8rem">Kalkulasi Cerdas</small>
                    </div>
                </div>
                
                <div class="mt-3">
                    <label class="text-muted small">Progress Bar</label>
                    <div class="progress" style="height: 10px;">
                        <div id="bar-infus" class="progress-bar bg-success" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function updateDashboard() {
        try {
            let res = await fetch('/api/infus/latest'); // Panggil API Laravel
            let data = await res.json();

            if(data) {
                let berat = parseFloat(data.current_weight);
                document.getElementById('angka-berat').innerText = berat + " ML";

                let badge = document.getElementById('badge-status');
                let angka = document.getElementById('angka-berat');
                let bar = document.getElementById('bar-infus');

                let persen = (berat / 500) * 100;
                bar.style.width = persen + "%";

                if (berat < 100) {
                    badge.className = "badge bg-danger status-badge blink";
                    badge.innerText = "BAHAYA / HABIS";
                    angka.style.color = "red";
                    bar.className = "progress-bar bg-danger";
                } else if (berat < 250) {
                    badge.className = "badge bg-warning text-dark status-badge";
                    badge.innerText = "PERINGATAN";
                    angka.style.color = "#ffc107"; // Kuning
                    bar.className = "progress-bar bg-warning";
                } else {
                    badge.className = "badge bg-success status-badge";
                    badge.innerText = "NORMAL";
                    angka.style.color = "#28a745"; // Hijau
                    bar.className = "progress-bar bg-success";
                }

                let tpm = parseFloat(data.drop_rate);
                if (tpm > 0) {
                    let sisaDetik = (berat / tpm) * 2; 
                    let menit = Math.floor(sisaDetik / 60);
                    document.getElementById('angka-waktu').innerText = menit + " Menit";
                }
            }
        } catch (e) {
            console.log("Menunggu data...");
        }
    }

    setInterval(updateDashboard, 3000);
    updateDashboard();
</script>

</body>
</html>