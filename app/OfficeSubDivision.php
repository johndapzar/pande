<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeSubDivision extends Model {

	protected $fillable = ['name'];
	
	public function officecircle(){
		return $this->belongsTo('App\OfficeCircle','office_circle_id');
	}
public function chief(){
		return $this->belongsTo('App\ChiefEngineer','chief_engineer_id');
	}

}
