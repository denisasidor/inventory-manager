<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInvitation extends Model
{
    protected $fillable = [
        'company_id',
        'email',
        'role',
        'token',
        'expires_at',
    ];
}
