<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class space extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'email'];  // Fillable fields
}
