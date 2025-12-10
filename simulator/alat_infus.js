const axios = require('axios');

const API_URL = "http://127.0.0.1:8000/api/infus/update";
const ID_ALAT = "KAMAR-MELATI-01";

let beratSekarang = 500.00; 

async function jalaninAlat() {
    let tetesan = (Math.random() * 2) + 1; 
    
    beratSekarang = beratSekarang - tetesan;

    if (beratSekarang <= 0) {
        console.log("⚠️ INFUS HABIS! Mengganti kantong baru...");
        beratSekarang = 500.00; // Reset penuh lagi
    }

    try {
        const payload = {
            device_id: ID_ALAT,
            weight: beratSekarang.toFixed(2), 
            drop_rate: tetesan.toFixed(2)
        };

        await axios.post(API_URL, payload);
        console.log(`[STATUS] Berat: ${payload.weight} ml | Tetesan: ${payload.drop_rate} TPM`);
        
    } catch (error) {
        console.error("Gagal konek ke Laravel. Pastikan 'php artisan serve' jalan!");
    }
}

console.log("=== SIMULATOR INFUS NYALA ===");
setInterval(jalaninAlat, 3000);