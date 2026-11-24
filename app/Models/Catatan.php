<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    protected $fillable = ['judul', 'isi', 'lampiran', 'user_id'];

public function user()
{
    return $this->belongsTo(User::class);
}
}

