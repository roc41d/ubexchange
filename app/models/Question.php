<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
class Question extends Eloquent implements SluggableInterface {
    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
        'separator'       => '-',
	    'unique'          => true,
	    'include_trashed' => false,
	    'on_update'       => false,
	    );
}
