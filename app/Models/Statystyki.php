<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statystyki extends Model
{
    public $table = 'statystyki';
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rodzaj',
        'kwota',
        'notatki',
        'nieruchomosci_id',
        'users_id'
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