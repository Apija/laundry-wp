<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory as FactoryHasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    protected $primaryKey = 'id_laundry';
    use FactoryHasFactory;
    protected $fillable = [
        'id_laundry',
        'id_pelanggan',
        'id_layanan',
        'resi',
        'berat',
        'total_harga',
        'status',
        'tgl_masuk',
        'tgl_selesai',
    ];
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
}
