<?php

namespace ClassyPOS;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Item extends Model
{

	use Searchable;

    public $fillable = ['title'];

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function searchableAs()
    {
        return 'items_index';
    }
}
