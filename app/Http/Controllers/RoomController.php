<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index()
    {
        $pic = User::where('is_admin', false)->get();
        $rooms = Room::all();

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

    public function show($param)
    {
        $room = Room::where('slug', $param)->firstOrFail();
        $items = Item::where('room_id', $room->id)->get();
        $pic = User::where('is_admin', false)->get();

        return view('room.detail', compact('room', 'items', 'pic'));
    }

}
