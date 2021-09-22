<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Business;

class Business_unit extends Model
{
    use HasFactory;

    public $table = 'business_units';

    protected $dates = ['delete_at'];

    public $fillable = [
        'name',
        'description',
        'id_business'
    ];

    /**
     * The attributes that should be casted to nativa types
     * 
     * @var array
    */
    protected $cast = [
        'id' => 'integer',
        'name' => 'string',
        'id_business' => 'integer'

    ];

    /**
     *  Validation rules
     * 
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'id_business' => 'reuquired'
    ];

    //relacion entre tablas
    public function business(){
        return $this->hasOne(Business::class, 'id', 'id_business');
    }
}
