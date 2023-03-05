<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'wilayah_id',
        'tipe',
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public const wilayah_select = [
        '1'                    => 'Wilayah 1',
        '2'                    => 'Wilayah 2',
        '3'                    => 'Wilayah 3',
        '4'                    => 'Wilayah 4',
    ];
    public const tipe_select = [
        'admin'                => 'Admin',
        'inspektur'            => 'Inspektur',
        'pptk'                 => 'PPTK',
        'irban'                => 'Irban',
        'pegawai'              => 'Pegawai',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }
}
