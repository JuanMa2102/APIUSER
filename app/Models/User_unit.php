<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Business_unit;
use App\Models\User;

class User_unit extends Model
{
    use HasFactory;

    public $table = 'user_units';

    protected $dates = ['delete_at'];

    public $fillable = [
        'id_business_unit',
        'id_user'
    ];

     /**
     * The attributes that should be casted to nativa types
     * 
     * @var array
    */
    protected $cast = [
        'id' => 'integer',
        'id_business_unit' => 'integer',
        'id_user' => 'integer'
    ];

    /**
     *  Validation rules
     * 
     * @var array
     */
    public static $rules = [
        'id_business_unit' => 'required',
        'id_user' => 'required'
    ];

    //relaciones
    public function businessUnit(){
        return $this->hasOne(Business_unit::class, 'id', 'id_business_unit');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
