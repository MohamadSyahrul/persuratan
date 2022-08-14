<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;
    protected $table = 'disposisis';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function namapenerima() {
        return $this->belongsTo(User::class, 'penerima_disposisi');
    }
    public function surat() {
        return $this->belongsTo(SuratKeluar::class, 'id_surat');
    }
}
