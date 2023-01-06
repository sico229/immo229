<?php

namespace App\Models;

use visits;
use App\Models\User;
use App\Models\Images;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Annonce extends Model
{
    use HasFactory;

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Images(){
        return $this->hasMany(Images::class);
    }

    public function Messages(){
        return $this->hasMany(Message::class);
    }

    public function vzt()
    {
        return visits($this);
    }

    
}
