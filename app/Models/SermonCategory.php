<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SermonCategory extends Model
{
    use HasFactory;

    protected $table = "sermoncategories";
    protected $primaryKey = "sermoncategories_id";
}
