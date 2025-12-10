<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Device extends Model {
    protected $guarded = [];

    public function logs() {
        return $this->hasMany(InfusionLog::class, 'device_id', 'device_code');
    }

    public function latestLog() {
        return $this->hasOne(InfusionLog::class, 'device_id', 'device_code')->latestOfMany();
    }
}