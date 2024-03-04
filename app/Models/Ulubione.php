<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Ogloszenia;
class Ulubione extends Model
{
    public $table = 'ulubione';
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'ogloszenia_id'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function ogloszenia(): HasMany
    {
        return $this->hasMany(Ogloszenia::class);
    }
}
