<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    //overriding our default table name
    protected $table = 'cars'; //in this situation it will be the same

    //you can override/change default pk as well
    protected $primaryKey = 'id'; //remains to be id
    //protected $primaryKey = false; //or remove it

    
    // as well you can set timestamps to false 
    // protected $timestamps=false;

    // protected $timestamps=true;  or set it true and change time  format
    //protected $dateFormat = 'h:m:s';

    protected $fillable = ['name','founded','description','image_path'];

    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }


    //Define hasManyThrough relationships
    public function engines()
    {
        return $this->hasManyThrough(
            Engine::class,
            CarModel::class, //this is the intermidiate class to access the car model
            'car_id',//foreign key on CarModel table
            'model_id',//foreign key on Engine table
        );
    }

    //Define hasOneThrough relationships
    public function productionDate()
    {
        return $this->hasOneThrough(
            CarProductionDate::class,
            CarModel::class, //this is the intermidiate class to access the car model
            'car_id',//foreign key on CarModel table
            'model_id',//foreign key on  CarProductionDate table
        );
    }

    //Define Many to Many relationship
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
