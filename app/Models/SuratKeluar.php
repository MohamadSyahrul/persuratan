<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;
    protected $table = 'surat_keluars';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function user() {
        return $this->belongsTo(User::class, 'id_penerima');
    }

    public function ttd() {
        return $this->belongsTo(User::class, 'id_ttd');
    }
}
