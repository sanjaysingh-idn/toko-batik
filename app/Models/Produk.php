<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kat()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    public function foto()
    {
        return $this->hasMany(FotoProduk::class);
    }
}
