<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table name
    protected $table = 'posts';
    //Primary key
    public $primaryKey = 'id';
    //timestamps
    public $timestamps = true;
    //Establishing a User post relationship using laravels model relationships. Use documentation to better understand this.
    public function user(){

      return $this->belongsTo('App\User');

    }




}
