<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    public $table = 'monitor';
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'woda',
        'prad',
        'gaz',
        'notatki',
        'user_id',
        'nieruchomosc_id',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function nieruchomosci(): HasMany
    {
        return $this->hasMany(Nieruchomosci::class);
    }

}
