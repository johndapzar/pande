<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeCircle extends Model {

	protected $fillable = ['name'];
	
	public function chief(){
		return $this->belongsTo('App\ChiefEngineer','chief_engineer_id');
	}

}
