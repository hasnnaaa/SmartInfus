<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\Monitorable;

class Device extends Model implements Monitorable 
{
    protected $guarded = [];
    protected $appends = ['status_label', 'status_color'];

    public function getStatusLabelAttribute() {
        return $this->is_active ? 'PERANGKAT AKTIF' : 'PERANGKAT MATI';
    }

    public function getStatusColorAttribute() {
        return $this->is_active ? 'success' : 'secondary';
    }
    
    public function logs() {
        return $this->hasMany(InfusionLog::class, 'device_id', 'device_code');
    }

    public function latestLog() {
        return $this->hasOne(InfusionLog::class, 'device_id', 'device_code')->latestOfMany();
    }
    
    public function getStatusLabel() {
        return $this->status_label;
    }

    public function getStatusColor() {
        return $this->status_color;
    }
}