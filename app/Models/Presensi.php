<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presensi extends Model
{
  use HasFactory;
  protected $table = 'presensi';
  public $timestamps = false;

  protected $fillable = [
    'tanggal',
    'jam_masuk',
    'jam_keluar',
    'status',
    'id_user',
  ];

  public function user(): BelongsTo {
    return $this->belongsTo(User::class, 'id_user');
  }
}
