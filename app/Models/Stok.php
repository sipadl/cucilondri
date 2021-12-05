<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Suplier;

class Stok extends Model
{
    protected $table = 'stok';
    protected $guarded = ['id'];
    use HasFactory;

    function suplier()
    {
        return $this->hasOne(Suplier::class, 'id', 'id_suplier');
    }
}
