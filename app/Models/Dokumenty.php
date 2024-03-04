<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Dokumenty extends Model
{
    public $table = 'dokumenty';
    use HasFactory;
    /**
  * The attributes that are mass assignable.
  *
  * @var array<int, string>
  */
 protected $fillable = [
     'nazwa' ,
     'file_path'    
 ];

 public function users(): HasMany
 {
     return $this->hasMany(User::class);
 }
}
