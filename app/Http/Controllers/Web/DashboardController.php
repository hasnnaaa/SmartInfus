<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $query = Device::with('latestLog');
        
        if($request->has('search')) {
            $query->where('room_name', 'like', '%'.$request->search.'%');
        }

        $devices = $query->get();
        return view('pages.monitoring', compact('devices'));
    }

    public function detail($device_code) {
        $device = Device::with('latestLog')->where('device_code', $device_code)->firstOrFail();
        return view('pages.detail', compact('device'));
    }
}