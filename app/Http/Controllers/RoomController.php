<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
         $rooms = collect([
        (object)['id' => 1, 'name' => 'Gudang Utama', 'code' => 'WRH-01', 'category' => 'Penyimpanan', 'total_assets' => 450, 'status' => 'Penuh'],
        (object)['id' => 2, 'name' => 'Laboratorium Komputer', 'code' => 'LAB-02', 'category' => 'Fasilitas', 'total_assets' => 120, 'status' => 'Tersedia'],
        (object)['id' => 3, 'name' => 'Studio Kreatif', 'code' => 'STD-05', 'category' => 'Produksi', 'total_assets' => 45, 'status' => 'Tersedia'],
        (object)['id' => 4, 'name' => 'Ruang Meeting Lt. 2', 'code' => 'MTG-02', 'category' => 'Fasilitas', 'total_assets' => 15, 'status' => 'Terbatas'],
    ]);
        
        return view('room.index', compact('rooms')); 
    }
}
