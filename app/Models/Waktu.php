<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waktu extends Model
{
    use HasFactory;
    protected $table = 'waktu';
    public $timestamps = false;

    protected $fillable = [
      'hari',
      'buka',
      'tutup'
    ];
}
