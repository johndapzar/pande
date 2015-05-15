<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\ChiefEngineer;
use App\OfficeCircle;

class OfficeCircleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$circleAll = OfficeCircle::orderBy('name')->paginate();
		$chiefAll	= ChiefEngineer::orderBy('name')->lists('name','id');
		$index = $circleAll->perPage() * ($circleAll->currentPage()-1) + 1;
		return view('officecircle.index',compact('circleAll','chiefAll','index')); 
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
		$rules	= ['name'=>'required', 'chief_engineer_id'=>'required'];
		$this->validate($request, $rules);

		$circle = new OfficeCircle();
		$circle->name = $request['name'];
		$circle->chief_engineer_id = $request['chief_engineer_id'];
		$circle->save();

		//OfficeCircle::create($request->except('_token'));

		return redirect('officecircle');
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
		$circleById	= OfficeCircle::find($id);
		$circleAll = OfficeCircle::orderBy('name')->paginate();
		$chiefAll	= ChiefEngineer::orderBy('name')->lists('name','id');
		$index = $circleAll->perPage() * ($circleAll->currentPage()-1) + 1;
		return view('officecircle.edit',compact('circleAll','chiefAll','index','circleById'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$rules	= ['name'=>'required', 'chief_engineer_id'=>'required'];
		$this->validate($request, $rules);

		$circle =  OfficeCircle::find($id);
		$circle->name = $request['name'];
		$circle->chief_engineer_id = $request['chief_engineer_id'];
		$circle->save();
		return redirect('officecircle');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		OfficeCircle::destroy($id);
		return redirect('officecircle');
	
	}

}
