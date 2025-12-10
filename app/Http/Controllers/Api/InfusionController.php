<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InfusionLog;
use Illuminate\Http\Request;

class InfusionController extends Controller
{
    public function update(Request $request) {
        $log = InfusionLog::create([
            'device_id' => $request->device_id,
            'current_weight' => $request->weight,
            'drop_rate' => $request->drop_rate
        ]);

        $device = \App\Models\Device::where('device_code', $request->device_id)->first();
        
        if ($device) {
            $device->update(['is_active' => true]);
        }
        
        return response()->json(['status' => 'Data Masuk & Alat Aktif', 'data' => $log]);
    }

    public function latest() {
        $data = InfusionLog::orderBy('created_at', 'desc')->first();
        return response()->json($data);
    }

    public function allStatus() {
        $devices = \App\Models\Device::with('latestLog')->get();
        return response()->json($devices);
    }
}