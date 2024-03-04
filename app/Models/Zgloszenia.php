<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zgloszenia extends Model
{
    public $table = 'zgloszenia';
    use HasFactory;

          /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'temat',
        'users_id',
        'nieruchomosci_id',
        'opis',
        'status',
        'typ_zgloszenia',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function ulubione(): BelongsTo
    {
        return $this->belongsTo(Ulubione::class);
    }

    public function nieruchomosci(): HasMany
    {
        return $this->hasMany(Nieruchomosci::class);
    }
}
