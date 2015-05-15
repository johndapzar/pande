@extends('app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>List Division</strong></div>
				<div class="panel-body">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-hover" style="margin-bottom:0px;">
					<thead>
					  <tr>
					    <th height="38" class="text-center">#</th>
					    <th height="38" align="left">Name</th>
					    <th height="38" align="left">Chief Engineer</th>
					    <th height="38" align="left">Division</th>
					    <th align="left" class="action text-center">Control</th>
					  </tr>
					  </thead>
					  <tbody>
					@foreach($divisionAll as $division)
						<tr bgcolor="">
					    <td height="25" class="text-center">{{ $index++ }}</td>
					    <td height="25" align="left">{{ $division->name }}&nbsp;</td>
   					    <td height="25" align="left">{{ $division->chief->name }}&nbsp;</td>
   					    <td height="25" align="left">{{ $division->officecircle->name }}&nbsp;</td>
					    <td align="left" class="action text-center">
					    	{!! Form::open(array('url'=>route('officedivision.destroy', array($division->id)),'method'=>'delete')) !!}
								<a href="{{route('officedivision.edit', array($division->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit" style="padding:5px 10px 5px 10px;"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;
								<button type="submit" onclick="return confirm ('<?php echo ('Are you sure') ?>');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove " value="{{$division->id}}" style="padding:5px 10px 5px 10px;"><i class="glyphicon glyphicon-trash"></i></button>
							{!!Form::close() !!}
					    </td>
					    </tr>
					@endforeach
					</tbody>
					</table>
				</div>
			</div>
	   {!! $divisionAll !!} 
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Add Division</strong></div>
				<div class="panel-body">
					<div class="col-md-12">
					{!! Form::open(['route'=>'officedivision.store','class'=>'form-horizontal']) !!}
						<div class="form-group">
							{!! Form::label('Name','',['class'=>'control-label'])!!}
							{!! Form::text('name',null,['class'=>'form-control']) !!}
							@if($errors->has('name'))
								<span class="text-danger">{{$errors->first('name')}}</span>
							@endif
						</div>

						<div class="form-group">
			            	{!! Form::label('CE Circle') !!}
			                    <select name="office_circle_id" class="form-control input-sm" required>
			                        <option></option>
			                        @foreach($chiefAll as $id => $officeZone)
			                            <optgroup label="{{ $officeZone }}">
			                            <?php
			                                $officeCircle = App\OfficeCircle::where('chief_engineer_id','=',$id)->orderBy('name','asc')->lists('name','id'); 
			                                foreach ($officeCircle as $office_circle_id => $office_circle_name) {
			                                    echo "<option value='$office_circle_id'>$office_circle_name</option>";
			                                }
			                            ?> 
			                            </optgroup>
			                        @endforeach
			                    </select>
			            </div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-success">
								Save
							</button>
						</div>
					{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection