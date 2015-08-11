<?php
/**
 * Author: PanOtlet
 */

namespace Elephpant\Functions;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Pages extends Eloquent{

    protected $table = 'page';
    protected $fillable = [
        'title',
        'description',
        'author',
        'meta_name',
    ];

    public function getPage($id){
    	
    }
}