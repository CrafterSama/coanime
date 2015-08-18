<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Category extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	protected $softDelete = false;

	public static function getName($id)
	{
		$categ = Category::find($id);
		return $categ->name;
	}

}