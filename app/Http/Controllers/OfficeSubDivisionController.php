<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\OfficeDivision;
use App\ChiefEngineer;
use App\OfficeCircle;
use App\OfficeSubDivision;

class OfficeSubDivisionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$subAll = OfficeSubDivision::orderBy('name')->paginate();
		$chiefAll	= ChiefEngineer::orderBy('name')->lists('name','id');
		$index = $subAll->PerPage() * ($subAll->currentPage()-1) + 1;
		return view('officesubdivision.index',compact('subAll','chiefAll','index'));
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

		$circle = new OfficeSubDivision();
		$circle->name 					= $request['name'];
		$circle->chief_engineer_id		= $officeCircle->chief_engineer_id;
		$circle->office_circle_id 		= $request['office_circle_id'];
		$circle->office_division_id		= $request['office_division_id'];
		$circle->save();

		//OfficeCircle::create($request->except('_token'));

		return redirect('officesubdivision');
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
		$subById = OfficeSubDivision::find($id);
		$subAll = OfficeSubDivision::orderBy('name')->paginate();
		$chiefAll	= ChiefEngineer::orderBy('name')->lists('name','id');
		$index = $subAll->PerPage() * ($subAll->currentPage()-1) + 1;
		return view('officesubdivision.edit',compact('subAll','chiefAll','index','subById'));
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

		$circle =  OfficeSubDivision::find($id);
		$circle->name 					= $request['name'];
		$circle->chief_engineer_id		= $officeCircle->chief_engineer_id;
		$circle->office_circle_id 		= $request['office_circle_id'];
		$circle->office_division_id		= $request['office_division_id'];
		$circle->save();

		//OfficeCircle::create($request->except('_token'));

		return redirect('officesubdivision');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		OfficeSubDivision::destroy($id);
		return redirect('officesubdivision');
	}
	public function subdivision(Request $request){
		$id = $request['catId'];

		$divByCircle = OfficeDivision::where('office_circle_id','=',$id)->orderBy('name')->lists('name','id');
		foreach ($divByCircle as $id => $name) {
			echo "<option value='$id'>$name</option>";
		}
	}
}
