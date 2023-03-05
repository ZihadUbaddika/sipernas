<?php

namespace App\Models;

use App\Models\UserManagement\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggotapengajuan extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];
    protected $fillable = [
        'id',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
