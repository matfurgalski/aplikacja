<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Nieruchomosci;
use App\Models\Storage;
use App\Models\Ulubione;
use App\Models\Konwersacje;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function nieruchomosci(): BelongsTo
    {
        return $this->belongsTo(Nieruchomosci::class);
    }

    public function storages(): BelongsTo
    {
        return $this->belongsTo(Storage::class);
    }

    public function ulubione(): BelongsTo
    {
        return $this->belongsTo(Ulubione::class);
    }

    public function zgloszenia(): BelongsTo
    {
        return $this->belongsTo(Zgloszenia::class);
    }

    public function konwersacje(): BelongsTo
    {
        return $this->belongsTo(Konwersacje::class);
    }

    public function wiadomosci(): BelongsTo
    {
        return $this->belongsTo(Wiadomosci::class);
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
