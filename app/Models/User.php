<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'role'];

    public function rayons() {
        return $this->belongsTo(Rayon::class, 'user_id');
    }
}

