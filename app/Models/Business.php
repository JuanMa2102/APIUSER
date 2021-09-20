<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aplication;

class Business extends Model
{
    use HasFactory;

    public $table = 'businesses';

    protected $dates = ['deleted_at'];

    
    public $fillable = [
        'name',
        'direction',
        'cp',
        'contact',
        'phone',
        'email',
        'rfc',
        'id_aplication'
    ];

    /**
     * The attributes that should be casted to nativa types
     * 
     * @var array
    */

    protected $cast = [
        'id' => 'integer',
        'name' => 'string',
        'direction' => 'string',
        'cp' => 'integer',
        'contact' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'rfc' => 'string',
        'id_aplication' => 'integer'
    ];

    /**
     *  Validation rules
     * 
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|min:max',
        'direction' => 'required|string|max:255',
        'cp' => 'required|integer|min:5',
        'contact' => 'required|string|max:255',
        'phone' => 'required|string|max:10|min:10',
        'email' => 'required|string|max:30',
        'rfc' => 'max:13|min:13',
        'id_aplication' => 'required'
    ];

    public function aplication(){
        return $this->hasOne(Aplication::class, 'id', 'id_aplication');
    }


}
