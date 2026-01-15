<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index()
    {
        $pic = User::where('is_admin', false)->get();
        $rooms = Room::all();
        $my_room = Room::where('user_id', Auth::user()->id)->get();

        return view('room.index', compact('rooms', 'pic', 'my_room'));
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

    public function update(Request $request, $param)
    {
        $data = Room::where('slug', $param)->firstOrFail();
        $request->validate([
            'room_name' => ['required', 'string', 'min:3', 'max:30'],
            'room_code' => ['required', 'string', 'min:3', 'max:10', Rule::unique('rooms')->ignore($data->id)],
            'desc' => ['required', 'max:50'],
        ]);

        $simpan = $request->all();
        $simpan['slug'] = Str::slug($request->input('room_name')) . '-' . random_int(0, 1000000);

        $data->update($simpan);
        return redirect()->route('room.show', $data->slug)->with('success', 'Room Updated');
    }

    public function destroy($param)
    {
        $data = Room::where('slug', $param)->firstOrFail();
        $data->delete();
        return redirect()->route('room.index')->with('success', 'Room Deleted');
    }

}
