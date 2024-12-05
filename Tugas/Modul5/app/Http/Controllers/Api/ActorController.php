<?php

namespace App\Http\Controllers\Api;

use App\Models\Actor;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ActorController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $actors = Actor::all(); // Pastikan Anda mengambil semua data actor
        // return view('Tugas2', ['data' => $actors]);  // Adjust the view if needed
        return new ActorResource(true, 'List Data Actors', $actors);
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
            'actor_name' => 'required|string',
            'ranking' => 'required|integer',
            'film_popular' => 'required|string',
            'actor_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload actor photo
        $actor_photo = $request->file('actor_photo');
        $actor_photo->storeAs('public/actors', $actor_photo->hashName());

        // Simpan data actor
        $actor = Actor::create([
            'actor_name' => $request->actor_name,
            'ranking' => $request->ranking,
            'film_popular' => $request->film_popular,
            'actor_photo' => $actor_photo->hashName(),
        ]);

        return new ActorResource(true, 'Data Actor Berhasil Ditambahkan!', $actor);
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
            'actor_name' => 'required',
            'ranking' => 'required|integer',
            'film_popular' => 'required|string',
            'actor_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cari actor berdasarkan ID
        $actor = Actor::find($id);

        if (!$actor) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        if ($request->hasFile('actor_photo')) {
            // Upload gambar baru
            $actor_photo = $request->file('actor_photo');
            $actor_photo->storeAs('public/actors', $actor_photo->hashName());

            // Hapus gambar lama
            Storage::delete('public/actors/' . basename($actor->actor_photo));

            // Update data dengan gambar baru
            $actor->update([
                'actor_name' => $request->actor_name,
                'ranking' => $request->ranking,
                'film_popular' => $request->film_popular,
                'actor_photo' => $actor_photo->hashName(),
            ]);
        } else {
            // Update data tanpa gambar baru
            $actor->update([
                'actor_name' => $request->actor_name,
                'ranking' => $request->ranking,
                'film_popular' => $request->film_popular,
            ]);
        }

        return new ActorResource(true, 'Data Actor Berhasil Diubah!', $actor);
    }

    /**
     * destroy
     *
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $actor = Actor::find($id);

        if (!$actor) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Hapus gambar
        Storage::delete('public/actors/' . basename($actor->actor_photo));

        // Hapus data actor
        $actor->delete();

        return new ActorResource(true, 'Data Actor Berhasil Dihapus!', null);
    }
}
