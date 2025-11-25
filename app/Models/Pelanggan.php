<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory as FactoryHasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $primaryKey = 'id_pelanggan';
    use FactoryHasFactory;
    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
    ];
    public function laundries()
    {
        return $this->hasMany(Laundry::class, 'id_pelanggan', 'id_pelanggan');
    }
}
