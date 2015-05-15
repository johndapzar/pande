<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\OfficeDivision;
use App\ChiefEngineer;
use App\OfficeCircle;


class OfficeDivisionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$divisionAll = OfficeDivision::orderBy('name')->paginate();
		$chiefAll	= ChiefEngineer::orderBy('name')->lists('name','id');
		$index = $divisionAll->PerPage() * ($divisionAll->currentPage()-1) + 1;
		return view('officedivision.index',compact('divisionAll','chiefAll','index')); 
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$rules	= ['name'=>'required', 'office_circle_id'=>'required'];
		$this->validate($request, $rules);

		$officeCircle 		= OfficeCircle::find($request['office_circle_id']); 

		$circle = new OfficeDivision();
		$circle->name 					= $request['name'];
		$circle->chief_engineer_id		= $officeCircle->chief_engineer_id;
		$circle->office_circle_id 		= $request['office_circle_id'];
		$circle->save();

		//OfficeCircle::create($request->except('_token'));

		return redirect('officedivision');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$divisionById	= OfficeDivision::find($id);
		$divisionAll = OfficeDivision::orderBy('name')->paginate();
		$chiefAll	= ChiefEngineer::orderBy('name')->lists('name','id');
		$index = $divisionAll->PerPage() * ($divisionAll->currentPage()-1) + 1;
		return view('officedivision.edit',compact('divisionAll','chiefAll','index','divisionById')); 
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$rules	= ['name'=>'required', 'office_circle_id'=>'required'];
		$this->validate($request, $rules);

		$officeCircle 		= OfficeCircle::find($request['office_circle_id']); 

		$circle =  OfficeDivision::find($id);
		$circle->name 					= $request['name'];
		$circle->chief_engineer_id		= $officeCircle->chief_engineer_id;
		$circle->office_circle_id 		= $request['office_circle_id'];
		$circle->save();

		//OfficeCircle::create($request->except('_token'));

		return redirect('officedivision');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		OfficeDivision::destroy($id);
		return redirect('officedivision');
	}

}
