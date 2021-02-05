<?php


namespace Modules\Passport\Models;


use App\Models\BaseModel;

class UserModel extends BaseModel
{
    protected   $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}