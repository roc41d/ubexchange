<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
class Answer extends Eloquent implements UserInterface {

	use UserTrait;

	protected $table = 'answers';

}
