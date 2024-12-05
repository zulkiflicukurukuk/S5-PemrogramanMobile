<?php

namespace App\Http\Controllers\Api;

use App\Models\Cinema;
use App\Http\Controllers\Controller;
use App\Http\Resources\CinemaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CinemaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $cinemas = Cinema::all(); // Pastikan Anda mengambil semua data
        // return view('Tugas2', ['data' => $cinemas]);      
        return new CinemaResource(true, 'List Data Cinema', $cinemas);

    }

    /**
     * store
     *
     * @param mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'cinema_name' => 'required',
            'price' => 'required|integer',
            'cinema_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload gambar
        $cinema_image = $request->file('cinema_image');
        $cinema_image->storeAs('public/cinemas', $cinema_image->hashName());

        // Simpan data
        $cinema = Cinema::create([
            'cinema_name' => $request->cinema_name,
            'price' => $request->price,
            'cinema_image' => $cinema_image->hashName(),
        ]);

        return new CinemaResource(true, 'Data Cinema Berhasil Ditambahkan!', $cinema);
    }

    /**
     * update
     *
     * @param mixed $request
     * @param mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'cinema_name' => 'required',
            'price' => 'required|integer',
            'cinema_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cari cinema berdasarkan ID
        $cinema = Cinema::find($id);

        if (!$cinema) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        if ($request->hasFile('cinema_image')) {
            // Upload gambar baru
            $cinema_image = $request->file('cinema_image');
            $cinema_image->storeAs('public/cinemas', $cinema_image->hashName());

            // Hapus gambar lama
            Storage::delete('public/cinemas/' . basename($cinema->cinema_image));

            // Update data dengan gambar baru
            $cinema->update([
                'cinema_name' => $request->cinema_name,
                'price' => $request->price,
                'cinema_image' => $cinema_image->hashName(),
            ]);
        } else {
            // Update data tanpa gambar baru
            $cinema->update([
                'cinema_name' => $request->cinema_name,
                'price' => $request->price,
            ]);
        }

        return new CinemaResource(true, 'Data Cinema Berhasil Diubah!', $cinema);
    }

    /**
     * destroy
     *
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $cinema = Cinema::find($id);

        if (!$cinema) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Hapus gambar
        Storage::delete('public/cinemas/' . basename($cinema->cinema_image));

        // Hapus data
        $cinema->delete();

        return new CinemaResource(true, 'Data Cinema Berhasil Dihapus!', null);
    }
}
