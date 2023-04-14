<?php

    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class User extends Model{
        protected $table = 'tbluser';
        protected $fillable = [
            'userid','username','password', 'gender'
        ];

        public $timestamps = false;
        protected $primarykey = 'userid';
    }

