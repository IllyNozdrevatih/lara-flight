<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirtDBLite extends Model
{
    // Указываем именно то имя, которое мы дали в config/database.php
    protected $connection = 'sqlite';

    // Укажите имя таблицы, если оно не "first_db_data"
    protected $table = 'my_first_db';

    protected $fillable = ['name'];

    public $timestamps = false;
}
