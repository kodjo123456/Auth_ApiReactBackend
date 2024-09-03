<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    //php artisan migrate --path/database/migration/le chemin de la table créee
    //ça supprime et recrée la table 

    use HasFactory;

    protected $fillable = [
        'code',
        'email',
    ];


    // protected $hidden = [
    //     'email',
    //     'code',
    // ];

    protected function casts(): array
    {
        return [
            'code' => 'hashed',
        ];
    }
}
