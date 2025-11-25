<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory as FactoryHasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $primaryKey = 'id_layanan';
    use FactoryHasFactory;
    protected $fillable = [
        'kode',
        'nama_layanan',
        'harga_perkilo',
    ];
    public function laundries()
    {
        return $this->hasMany(Laundry::class, 'id_layanan', 'id_layanan');   
    }
}
