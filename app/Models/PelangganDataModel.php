<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganDataModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pelanggan_data';
    protected $primaryKey = 'pelanggan_data_id';
    protected $fillable = [
        'pelanggan_data_pelanggan',
        'pelanggan_data_jenis',
        'pelanggan_data_file',
    ];


    public function get_pelanggan_data()
    {
        return self::all();
    }

    public function pelanggan()
    {
        return $this->belongsTo(PelangganModel::class,'pelanggan_data_pelanggan_id','pelanggan_id');
    }


    public function create_pelanggan_data($data)
    {
        return self::create($data);
    }


    public function update_pelanggan_data($data, $id)
    {
        $pelanggandata = self::find($id);
        $pelanggandata->fill($data);
        $pelanggandata->update();
        return $pelanggandata;
    }

    public function delete_pelanggan_data($id)
    {
        $pelanggandata = self::find($id);
        self::destroy($id);
        return $pelanggandata;
    }
}
