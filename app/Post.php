<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    //
    public function __construct() {

        $this->primaryKey = 'POST_KEY';
        $this->table = 'POSTS';
    }
    
}
    