<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Categories extends Model
{
    use HasFactory;
    //  use NodeTrait;
    protected $primaryKey = 'id';

     protected $fillable = ([
        'name',
        'lft',
        'rgt'
    ]);

    // protected $fillable = ['name'];
}
