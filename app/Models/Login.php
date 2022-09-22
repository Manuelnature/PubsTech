<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Login extends Model
{
    protected $table = 'tbl_users';
    public $timestamps = false;

    public static function set_user_password(String $email){
        return DB::table('tbl_users')
            ->select('tbl_users.*')
            ->where('email', '=', $email)
            ->get();
    }
}
