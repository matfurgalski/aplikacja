<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Wiadomosci;

class Konwersacje extends Model
{
    public $table = 'konwersacje';
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nadawca_id',
        'odbiorca_id',
        'temat',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function wiadomosci(): BelongsToMany
    {
        return $this->belongsToMany(Wiadomosci::class);
    }
}
