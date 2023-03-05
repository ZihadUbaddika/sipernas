<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kepegawaian extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'nama',
        'nip',
        'pangkat',
        'golongan',
        'foto',
        'email',
        'no_hp',
    ];
}