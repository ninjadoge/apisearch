<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstateProperty extends Model
{
    protected $fillable = ['address','size','bedrooms','price','latitude','longitude']; 
    use HasFactory;
}
