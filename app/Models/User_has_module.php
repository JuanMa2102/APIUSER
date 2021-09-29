<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_has_module extends Model
{
    use HasFactory;

    public $table ='user_has_modules';

    protected $dates = ['delete_at'];

    public $fillable = [
        'id_user',
        'id_module'
    ];

    /**
     * The attributes that should be casted to nativa types
     * 
     * @var array
    */
    protected $cast = [
        'id' => 'integer',
        'id_user' => 'integer',
        'id_module' => 'integer'
    ];

    /**
     * Validation rules
     * 
     * @var array
     */
    public static $rules = [
        'id_user'=> 'reuquired',
        'id_module' => 'required'
    ];

    //Relaciones de modelos
    public function user(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function module(){
        return $this->hasOne(Module::class, 'id', 'id_module');
    }
}
