<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Nieruchomosci extends Model
{
    public $table = 'nieruchomosci';
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nazwa',
        'opis',
        'powierzchnia',
        'liczba_pokoi',
        'ulica',
        'kod_pocztowy',
        'miasto',
        'users_id',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function zgloszenia(): BelongsTo
    {
        return $this->belongsTo(Zgloszenia::class);
    }

    public function monitor(): BelongsTo
    {
        return $this->belongsTo(Monitor::class);
    }

    public function statystyki(): BelongsTo
    {
        return $this->belongsTo(Statystyki::class);
    }
}
