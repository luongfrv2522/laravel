<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    protected $table = "types";

    public function items()
    {
    	return $this->belongsToMany('App\Item', 'item_type', 'fk_type_id', 'fk_item_id')->withTimeStamps();
    }
}
