<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class UserMongoDB extends Model
{
    use HasFactory;

    protected  $connection = 'mongodb';
    protected  $collection = 'users';

    protected  $fillable = ['guid', 'first_name', 'email', 'password'];

}
