@extends('app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>List Sub-Division</strong></div>
				<div class="panel-body">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-hover" style="margin-bottom:0px;">
					<thead>
					  <tr>
					    <th height="38" class="text-center">#</th>
					    <th height="38" align="left">Sub Division</th>
					    <th height="38" align="left">Chief Engineer</th>
					    <th height="38" align="left">Division</th>
					    <th align="left" class="action text-center">Control</th>
					  </tr>
					  </thead>
					  <tbody>
					@foreach($subAll as $sub)
						<tr bgcolor="">
					    <td height="25" class="text-center">{{ $index++ }}</td>
					    <td height="25" align="left">{{ $sub->name }}&nbsp;</td>
   					    <td height="25" align="left">{{ $sub->chief->name }}&nbsp;</td>
   					    <td height="25" align="left">{{ $sub->officecircle->name }}&nbsp;</td>
					    <td align="left" class="action text-center">
					    	{!! Form::open(array('url'=>route('officesubdivision.destroy', array($sub->id)),'method'=>'delete')) !!}
								<a href="{{route('officesubdivision.edit', array($sub->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit" style="padding:5px 10px 5px 10px;"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;
								<button type="submit" onclick="return confirm ('<?php echo ('Are you sure') ?>');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove " value="{{$sub->id}}" style="padding:5px 10px 5px 10px;"><i class="glyphicon glyphicon-trash"></i></button>
							{!!Form::close() !!}
					    </td>
					    </tr>
					@endforeach
					</tbody>
					</table>
				</div>
			</div>
	   {!! $subAll !!} 
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Add Sub-Division</strong></div>
				<div class="panel-body">
					<div class="col-md-12">
					{!! Form::open(['route'=>'officesubdivision.store','class'=>'form-horizontal']) !!}
						<div class="form-group">
							{!! Form::label('Name','',['class'=>'control-label'])!!}
							{!! Form::text('name',null,['class'=>'form-control']) !!}
							@if($errors->has('name'))
								<span class="text-danger">{{$errors->first('name')}}</span>
							@endif
						</div>

						<div class="form-group">
			            	{!! Form::label('CE Circle') !!}
			            	    <select name="office_circle_id" class="form-control input-sm" required id="office_circle_id">
			                <!--     <select name="office_circle_id" class="form-control input-sm" required> -->
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
			               {!! Form::label('Division') !!}
			                    <select name="office_division_id" class="form-control input-sm" required id="office_division_id">
			                        <option></option>
			                        <?php
			                            $officeDivision = App\OfficeDivision::orderBy('name','asc')->lists('name','id'); 
			                            foreach ($officeDivision as $id => $name) {
			                                echo "<option value='$id'>$name</option>";
			                            }
			                        ?>
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

<script>
$("#office_circle_id").change(function(){
	var catId = this.value;
    $.ajax({
        url: "{{ URL::to('subdivision')}}",
        data: {'catId': catId},
        type: 'GET',
    }).success(function(data){
        $('#office_division_id').html(data);
    });
});
</script>
@endsection
