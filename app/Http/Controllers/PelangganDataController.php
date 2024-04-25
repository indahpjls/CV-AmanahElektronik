<?php

namespace App\Http\Controllers;

use App\Models\PelangganDataModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelangganDataController extends Controller
{
    protected $pelanggandataModel;
    public function __construct()
    {
        $this->pelanggandataModel = new PelangganDataModel();
    }

    public function index()
    {
        $pelanggan_data = $this->pelanggandataModel->get_pelanggan_data();
        if (count($pelanggan_data) === 0) {
            return response()->json([], 204);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data pelanggan berhasil didapatkan!',
                'data' => $pelanggan_data //ambil dr database
            ], 200);
        }
    }

    public function show($id)
    {
        $pelanggan_data = PelangganDataModel::find($id);
        if ($pelanggan_data === null) {
            return response()->json([
            'status' => 404,
            'suscess' => false,
            'messange' => 'Gagal mendapatkan data pelanggan! Pelanggan tidak ditemukan',
            'data' => $pelanggan_data
            ], 404);
           
        } else {
            return response()->json([
                'status' => 200,
                'suscess' => true,
                'message' => 'Berhasil mendapatkan data pelanggan!',
                'data' => $pelanggan_data
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_data_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
            'pelanggan_data_jenis' => 'required|in:KTP,SIM', 
            'pelanggan_data_file' => 'required|string|max:255'
        ]);
        
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data pelanggan gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $pelanggan_data = $this->pelanggandataModel->create_pelanggan_data($validator->validated());
            return response()->json([
                'status' => 201,
                'message' => 'Data pelanggan berhasil dibuat!',
                'data' => $pelanggan_data
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
            'pelanggan_data_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
            'pelanggan_data_jenis' => 'required|in:KTP,SIM', 
            'pelanggan_data_file' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data pelanggan gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $pelanggan_data = $this->pelanggandataModel->update_pelanggan_data($validator->validated(), $id);
            return response()->json([
                'status' => 200,
                'message' => 'Data pelanggan berhasil diupdate!',
                'data' => $pelanggan_data
            ], 200);
        }
    }

    public function destroy($id)
    {
        $pelanggan_data = $this->pelanggandataModel->delete_pelanggan_data($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data pelanggan berhasil dihapus!',
            'data' => $pelanggan_data
        ], 200);
    }
}