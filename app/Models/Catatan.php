<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    use HasFactory;

    // Wajib ditambahkan karena nama tabel di database adalah 'catatan', bukan 'catatans'
    protected $table = 'catatan';

    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'lampiran',
        'is_archived',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}