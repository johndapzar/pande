<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\ChiefEngineer;

class ChiefEngineerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$ceAll	= ChiefEngineer::orderBy('name')->paginate();
		$index = $ceAll->perPage() * ($ceAll->currentPage()-1) + 1;

		return view('chiefengineer.index',compact('ceAll','index')); 
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
		$rules	= ['name'=>'required'];
		$this->validate($request, $rules);

		ChiefEngineer::create($request->except('_token'));

		return redirect('chiefengineer');
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
		$ceAll	= ChiefEngineer::orderBy('name')->paginate();
		$ceById	= ChiefEngineer::find($id);
		$index = $ceAll->perPage() * ($ceAll->currentPage()-1) + 1;

		return view('chiefengineer.edit',compact('ceAll','ceById','index'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$rules	= ['name'=>'required'];
		$this->validate($request, $rules);

		$chief = ChiefEngineer::find($id);
		$chief->update($request->except('_token'));

		return redirect('chiefengineer');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		ChiefEngineer::destroy($id);
		return redirect('chiefengineer');
	}

}
