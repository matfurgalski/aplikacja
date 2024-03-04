<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ogloszenia;
class Zdjecia extends Model
{
    public $table = 'zdjecia';
    use HasFactory;

    protected $fillable = [
        'file_path'   
    ];

  

    public function ogloszenia(): BelongsToMany
    {
        return $this->belongsToMany(Ogloszenia::class);
    }
}
