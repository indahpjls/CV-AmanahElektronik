<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaanDetailModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'penyewaan_detail';
    protected $primaryKey = 'penyewaan_detail_id';
    protected $fillable = [
        'penyewaan_detail_penyewaan_id',
        'penyewaan_detail_alat_id',
        'penyewaan_detail_jumlah' ,
        'penyewaan_detail_subharga',
    ];


    public function get_penyewaan_detail()
    {
        return self::all();
    }


    public function create_penyewaan_detail($data)
    {
        return self::create($data);
    }


    public function update_penyewaan_detail($data, $id)
    {
        $penyewaandetail = self::find($id);
        $penyewaandetail->fill($data);
        $penyewaandetail->update();
        return $penyewaandetail;
    }

    public function delete_penyewaan_detail($id)
    {
        $penyewaandetail = self::find($id);
        self::destroy($id);
        return $penyewaandetail;
    }
}
