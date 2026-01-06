<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenaltySetting extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'settings_denda';
    
    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = ['nominal_denda', 'tipe_denda', 'masa_tenggang'];

    // Matikan timestamps karena tabel Anda tidak punya kolom created_at/updated_at
    public $timestamps = false;
}