<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index() {
        $devices = Device::all();
        return view('pages.devices.index', compact('devices'));
    }

    public function create() {
        return view('pages.devices.create');
    }

    public function store(Request $request) {
        $request->validate([
            'device_code' => 'required|unique:devices',
            'room_name' => 'required',
            'device_name' => 'required',
        ]);

        Device::create([
            'device_code' => $request->device_code,
            'room_name' => $request->room_name,
            'device_name' => $request->device_name,
            'is_active' => false
        ]);

        return redirect()->route('devices.index')->with('success', 'Alat Berhasil Ditambahkan!');
    }
}