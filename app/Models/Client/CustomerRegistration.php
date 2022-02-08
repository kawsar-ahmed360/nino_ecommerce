<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRegistration extends Model
{
    use HasFactory;

    public function Country(){

        return $this->hasOne(Countrie::class,'country_id','id');
    }

    public function State(){

        return $this->hasOne(State::class,'id','state_id');
    }
    public function Citie(){

        return $this->hasOne(Citie::class,'id','city_id');
    }
}
