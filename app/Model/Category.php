<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;


class Category extends Model
{


    public $fillable = ['title', 'parent_id'];


    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function childs()
    {
        return $this->hasMany('App\Model\Category', 'parent_id', 'id');
    }
}
