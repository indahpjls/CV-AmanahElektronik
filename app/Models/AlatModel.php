<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'alat';
    protected $primaryKey = 'alat_id';
    protected $fillable = [
        'alat_kategori',
        'alat_nama',
        'alat_deskripsi',
        'alat_hargaperhari',
        'alat_stok',
    ];


    public function get_alat()
    {
        return self::all();
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class,'alat_kategori_id','kategori_id');
    }


    public function create_alat($data)
    {
        return self::create($data);
    }


    public function update_alat($data, $id)
    {
        $alat = self::find($id);
        $alat->fill($data);
        $alat->update();
        return $alat;
    }

    public function delete_alat($id)
    {
        $alat = self::find($id);
        self::destroy($id);
        return $alat;
    }
}
