<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $table = "items";

    public function types()
    {
    	return $this->belongsToMany('App\Type', 'item_type', 'fk_item_id', 'fk_type_id')->withTimeStamps();
    }
}
