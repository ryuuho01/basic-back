<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    public static $rules = array(
        'genrea_name' => 'required',
    );

    // public function getgenresData()
    // {
    //     // return $this->genre->genre_name;
    //     return $this->genre_name;
    // }
}
