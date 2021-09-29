<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplication extends Model
{
    use HasFactory;

    public $table = 'aplications';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'description',
        'url'
    ];

    /**
    *The attributes that should be casted to native types.
    *
    *@var array
    */
    protected $cast = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'url' => 'string'
    ];

    /**
     * Validation rules
     * 
     *@var array
    */
    public static $rules = [
        'name' => 'required|string|max:45',
        'description' => 'required|string|max:255',
        'url' => 'required|string|max:255'
    ];
}
