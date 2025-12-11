<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\Monitorable;

class InfusionLog extends Model implements Monitorable
{
    use HasFactory;
    
    protected $guarded = [];

    protected $appends = ['status_berat', 'color_berat', 'status_tetesan']; 

    public function device() {
        return $this->belongsTo(Device::class, 'device_id', 'device_code');
    }

    public function getStatusBeratAttribute() {
        if ($this->current_weight < 100) return 'HABIS';
        if ($this->current_weight < 250) return 'HAMPIR HABIS';
        return 'PENUH';
    }

    public function getColorBeratAttribute() {
        if ($this->current_weight < 100) return 'danger'; 
        if ($this->current_weight < 250) return 'warning'; 
        return 'success'; 
    }

    public function getStatusTetesanAttribute() {
        return ($this->drop_rate > 0) ? 'MENETES' : 'TIDAK MENETES';
    }

    public function getStatusLabel() {
        return $this->status_berat; 
    }

    public function getStatusColor() {
        return $this->color_berat; 
    }
}