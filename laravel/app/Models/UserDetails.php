<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\Notes;

class UserDetails extends Model
{
    use HasFactory;

    public function showAll()
    {
       return self::with('user')->get();
    }

    public function showNotes()
    {
       return self::with('notes')->paginate(20);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function notes()
    {
        return $this->hasMany(Notes::class,'users_id');
    }
}