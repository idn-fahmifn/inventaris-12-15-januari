<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index()
    {
        $pic = User::where('is_admin', false)->get();
        $rooms = collect([
            (object) ['id' => 1, 'name' => 'Gudang Utama', 'code' => 'WRH-01', 'category' => 'Penyimpanan', 'total_assets' => 450, 'status' => 'Penuh'],
            (object) ['id' => 2, 'name' => 'Laboratorium Komputer', 'code' => 'LAB-02', 'category' => 'Fasilitas', 'total_assets' => 120, 'status' => 'Tersedia'],
            (object) ['id' => 3, 'name' => 'Studio Kreatif', 'code' => 'STD-05', 'category' => 'Produksi', 'total_assets' => 45, 'status' => 'Tersedia'],
            (object) ['id' => 4, 'name' => 'Ruang Meeting Lt. 2', 'code' => 'MTG-02', 'category' => 'Fasilitas', 'total_assets' => 15, 'status' => 'Terbatas'],
        ]);

        return view('room.index', compact('rooms', 'pic'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_name' => ['required', 'string', 'min:3', 'max:30'],
            'room_code' => ['required', 'string', 'min:3', 'max:10', 'unique:rooms,room_code'],
            'desc' => ['required', 'max:50'],
        ]);

        $simpan = $request->all();
        $simpan['slug'] = Str::slug($request->input('room_name')) . '-' . random_int(0, 1000000);

        Room::create($simpan);
        return redirect()->route('room.index')->with('success', 'Room Created');
    }

}
