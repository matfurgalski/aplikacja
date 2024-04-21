<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Zdjecia;
use App\Models\Ulubione;

class Ogloszenia extends Model
{
    public $table = 'ogloszenia';
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tytul',
        'opis',
        'nieruchomosci_id',
        'wlasciciel_id',
        'cena',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function zdjecia(): BelongsToMany
    {
        return $this->belongsToMany(Zdjecia::class);
    }
    public function ulubione(): BelongsTo
    {
        return $this->belongsTo(Ulubione::class);
    }
}
