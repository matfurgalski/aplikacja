<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Konwersacje;

class Wiadomosci extends Model
{
    public $table = 'wiadomosci';
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'wiadomosc',
        'user_id',
    ];

    public function konwersacje(): BelongsToMany
    {
        return $this->belongsToMany(Konwersacje::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
