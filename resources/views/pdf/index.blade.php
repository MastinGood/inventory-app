<!DOCTYPE html>
<html>
<head>
	<title>Summary</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
	<style type="text/css">
		*{
			font-family: 'Roboto', sans-serif;
		}
		th, h1{
			font-family: 'Roboto', sans-serif;
			font-weight: 700;
		}
		th{
			width: : 20%;
		}
		td{
			font-family: 'Roboto', sans-serif;
			font-weight: 400;
		}
	</style>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			{{-- <div class="row">
				<div class="col-md-5">
					<img src="{{url('images/Organico-Logo.png')}}" style="width: 100%" height="100">
				</div>

			</div> --}}
			<h1 class="display-4 text-center" style="text-align: center!important;">{{$branch->branchname}} Branch</h1>
				<table class="table table-bordered table-striped text-center" style="width: 100%;text-align:center!important">
				<thead>
					<tr style="border-bottom: 2px solid black!important;">
						<th colspan="2">Item Type</th>
                        <th colspan="2">Name</th>
                        <th colspan="2">Price</th>
                        <th colspan="2">Description</th>
                        <th colspan="2">Added At</th>
					</tr>
				</thead>
				<tbody>
					@if(count($items))
                	@foreach($items as $item)
					<tr>
						<td colspan="2">{{$item->getType($item->type)->type}}</td>
						<td colspan="2">{{$item->name}}</td>
						<td colspan="2">P{{$item->price}}</td>
						<td colspan="2">{{$item->description}}</td>
						<td colspan="2">{{$item->addedat}}</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
			<br>
			<table class="table table-bordered table-striped text-center" style="width: 100%; text-align:center!important">
				<br>
				<br>
				<thead>
					<tr>
						<th colspan="2">Total Asset</th>
						<th colspan="2">Total Items</th>
						<th colspan="2">Total Staff</th>
					</tr>
					<tbody>
						<tr>
							<td colspan="2">
								P{{$tots}}
							</td>
							<td colspan="2">
								{{$totz}}
							</td>
							<td colspan="2">
								{{$staff}}
							</td>
						</tr>
					</tbody>
				</thead>
			</table>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>