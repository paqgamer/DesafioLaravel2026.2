<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// essa merda tava errada, eu mexendo no modal por  3 horas para esse caraio ser oculpado, maldito fillable
#[Fillable([
    'name',
    'email',
    'password',
    'cpf',
    'phone',
    'birth_date',
    'photo',
    'is_admin', //considerando  que no store()  tá como false por  padrão, acho que  é  seguro deixar assim
    'saldo',
    'cep',
    'street',
    'number',
    'neighborhood',
    'city',
    'state',
    'complement',
])]

// na minha epoca era protected  $hidden, eu acho pelo menos.
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     * você jura??????
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}