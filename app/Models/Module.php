<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aplication;

class Module extends Model
{
    use HasFactory;

    public $table = 'modules';

    protected $dates = ['deletd_at'];

    public $fillable = [
        'name',
        'description',
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
        'description' => 'string',
        'id_aplication' => 'integer'
    ];

     /**
     *  Validation rules
     * 
     * @var array
     */

    public static $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'id_aplication' => 'required'
    ]; 

    public function aplication(){
        return $this->hasOne(Aplication::class, 'id', 'id_aplication');
    }
}
