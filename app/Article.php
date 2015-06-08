<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	protected $guarded = array('id');

  public function category()
  {
    return $this->belongsTo('App\Category');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

}
