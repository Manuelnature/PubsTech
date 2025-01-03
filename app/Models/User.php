<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $table = 'tbl_users';
    public $timestamps = false;

    public static function delete_user(String $user_id){
        return  DB::table('tbl_users')
        ->where('id', '=', $user_id)
        ->delete();
    }
}
