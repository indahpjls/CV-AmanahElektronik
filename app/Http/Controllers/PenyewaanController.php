<?php

namespace App\Http\Controllers;

use App\Models\PenyewaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenyewaanController extends Controller
{
    protected $penyewaanModel;
    public function __construct()
    {
        $this->penyewaanModel = new PenyewaanModel();
    }

    public function index()
    {
        $penyewaan = $this->penyewaanModel->get_penyewaan();
        if (count($penyewaan) === 0) {
            return response()->json([], 204);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data pelanggan berhasil didapatkan!',
                'data' => $penyewaan //ambil dr database
            ], 200);
        }
    }

    public function show($id)
    {
        $penyewaan = PenyewaanModel::find($id);
        if ($penyewaan === null) {
            return response()->json([
            'status' => 404,
            'suscess' => false,
            'messange' => 'Gagal mendapatkan data pelanggan! Pelanggan tidak ditemukan',
            'data' => $penyewaan
            ], 404);
           
        } else {
            return response()->json([
                'status' => 200,
                'suscess' => true,
                'message' => 'Berhasil mendapatkan data pelanggan!',
                'data' => $penyewaan
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'penyewaan_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
            'penyewaan_tglsewa' => 'required|date',
            'penyewaan_tglkembali' => 'required|date',  
            'penyewaan_sttspembayaran' => 'required|in:Lunas, Belum Bayar, DP',
            'penyewaan_sttskembali'=> 'required|in:Sudah Kembali, Belum Kembali',
            'penyewaan_totalharga' => 'required|numeric'
        ]);
        
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data pelanggan gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $penyewaan = $this->penyewaanModel->create_penyewaan($validator->validated());
            return response()->json([
                'status' => 201,
                'message' => 'Data pelanggan berhasil dibuat!',
                'data' => $penyewaan
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
            'penyewaan_pelanggan_id' => 'required|exists:pelanggan,pelanggan_id',
            'penyewaan_tglsewa' => 'required|date',
            'penyewaan_tglkembali' => 'required|date',  
            'penyewaan_sttspembayaran' => 'required|in:Lunas, Belum Bayar, DP',
            'penyewaan_sttskembali'=> 'required|in:Sudah Kembali, Belum Kembali',
            'penyewaan_totalharga' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data pelanggan gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $penyewaan = $this->penyewaanModel->update_penyewaan($validator->validated(), $id);
            return response()->json([
                'status' => 200,
                'message' => 'Data pelanggan berhasil diupdate!',
                'data' => $penyewaan
            ], 200);
        }
    }

    public function destroy($id)
    {
        $penyewaan = $this->penyewaanModel->delete_penyewaan($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data pelanggan berhasil dihapus!',
            'data' => $penyewaan
        ], 200);
    }
}