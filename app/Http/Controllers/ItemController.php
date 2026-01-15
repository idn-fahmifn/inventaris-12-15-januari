<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index()
    {
        $data = Item::all();
        $rooms = Room::all();
        return view(
            'item.index',
            compact('data', 'rooms')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'min:3', 'max:20'],
            'item_code' => ['required', 'string', 'min:3', 'max:10'],
            'room_id' => ['required', 'integer'],
            'status' => ['required', 'in:good,maintenance,broke'],
            'date_purchase' => ['required', 'date'],
            'image' => ['required', 'file', 'max:10240', 'mimes:png,jpg,jpeg,svg,webp'],
            'desc' => ['required'],

        ]);

        $simpan = [
            'item_name' => $request->input('item_name'),
            'item_code' => $request->input('item_code'),
            'desc' => $request->input('desc'),
            'room_id' => $request->input('room_id'),
            'status' => $request->input('status'),
            'date_purchase' => $request->input('date_purchase'),
            'slug' => Str::slug($request->input('item_name')) . random_int(0, 1000000),
        ];

        // kondisi saat upload file
        if ($request->hasFile('image')) {

            $gambar = $request->file('image'); //mengambil data file yang diupload oleh user
            $path = 'public/images/items'; //path penyimpanan
            $ext = $gambar->getClientOriginalExtension();
            $nama = 'item-image-' . Carbon::now('Asia/Jakarta')->format('Ymdhis') . '.' . $ext;

            // nilai yang akan disimpan ke database : 
            $simpan['image'] = $nama;
            $gambar->storeAs($path, $nama);

        }
        Item::create($simpan); //menambahkan data ke database
        return redirect()->route('item.index')->with('success', 'Item Created');
    }

    public function detail($param)
    {
        $data = Item::where('slug', $param)->firstOrFail();
        $rooms = Room::all();
        return view(
            'item.detail',
            compact('data', 'rooms')
        );
    }

    public function update(Request $request, $param)
    {

        $data = Item::where('slug', $param)->firstOrFail(); //object

        $request->validate([
            'item_name' => ['required', 'string', 'min:3', 'max:20'],
            'category_id' => ['required', 'integer'],
            'stok' => ['required', 'integer', 'min:0', 'max:1000'],
            'image' => ['file', 'max:10240', 'mimes:png,jpg,jpeg,svg,webp'],
            'desc' => ['required'],
        ]);

        $simpan = [
            'item_name' => $request->input('item_name'),
            'desc' => $request->input('desc'),
            'category_id' => $request->input('category_id'),
            'stok' => $request->input('stok'),
            'slug' => Str::slug($request->input('item_name')) . random_int(0, 1000000),
        ];

        // kondisi saat upload file
        if ($request->hasFile('image')) {

            // hapus file lama

            $path_lama = 'public/images/items/' . $data->image;

            // jika path lama ada maka akan dihapus;
            if ($data->image && Storage::exists($path_lama)) {
                Storage::delete($path_lama);
            }

            $gambar = $request->file('image'); //mengambil data file yang diupload oleh user
            $path = 'public/images/items'; //path penyimpanan
            $ext = $gambar->getClientOriginalExtension();
            $nama = 'item-image-' . Carbon::now('Asia/Jakarta')->format('Ymdhis') . '.' . $ext;

            // nilai yang akan disimpan ke database : 
            $simpan['image'] = $nama;
            $gambar->storeAs($path, $nama);
        }
        $data->update($simpan); //menyimmpan data baru data ke database
        return redirect()->route('item.detail', $data->slug)
            ->with('success', 'Item Created');
    }

    public function delete($param)
    {
        $data = Item::where('slug', $param)->firstOrFail();

        $path_lama = 'public/images/items/' . $data->image;

        // jika path lama ada maka akan dihapus;
        if ($data->image && Storage::exists($path_lama)) {
            Storage::delete($path_lama);
        }

        $data->delete();
        return redirect()->route('item.index')
            ->with('success', 'Item Deleted');
    }
}
