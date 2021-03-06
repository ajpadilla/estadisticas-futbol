<?php namespace soccer\Users;

use Zizaco\Confide\ConfideUser;
use Zizaco\Entrust\HasRole;

class User extends ConfideUser {

	use HasRole;

	//protected $table = 'users';

	protected $dates = ['deleted_at'];

	protected $hidden = ['password'];

	public function userdetail()
	{
		return $this->hasOne('Userdetail');
	}

	public function familie()
	{
		return $this->hasOne('Familie');
	}

	public function calendars()
	{
		return $this->hasMany('Calendar');
	}

	public function people() {
		return $this->hasOne('s4h\store\Peoples\people','user_id');
	}

	public function wishlist()
	{
		return $this->belongsToMany('s4h\store\Products\Product', 'wishlist')->withTimestamps();
	}

	public function carts()
	{
		return $this->hasMany('s4h\store\Carts\Cart');
	}

	public function products(){
		return $this->hasMany('s4h\store\Products\Product');
	}

}