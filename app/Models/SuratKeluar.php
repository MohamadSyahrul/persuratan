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


    // public function user() {
    //     return $this->belongsTo(User::class, 'id_penerima');
    // }

    public function disposisi() {
        return $this->hasMany(Disposisi::class, 'id_surat');
    }

    public function pembuat() {
        return $this->belongsTo(User::class, 'id_pembuat');
    }

    public function ttd() {
        return $this->belongsTo(User::class, 'id_ttd');
    }
}
