<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presensi extends Model
{
  use HasFactory;
  protected $table = 'presensi';
  public $timestamps = false;

  protected $fillable = [
    'tanggal',
    'jam_masuk',
    'id_user',
  ];

  public function user(): BelongsTo {
    return $this->belongsTo(User::class, 'id_user');
  }

}
