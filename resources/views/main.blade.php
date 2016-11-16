<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="../public/css/style.css"> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="{{{asset('/js/style.js')}}}"> -->
    <script src="{{URL:: to('js/style.js')}}" type="text/javascript" charset="utf-8" async defer></script>
	<title>Accounts</title>
</head>
<body style="text-align: center;" class="col-md-12">
<center>
<br>

	
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Registration</h4>
			        <label style="display: none" id="sampleLabel">Input is invalid</label>
			    </div>

			    <div class="modal-body">
			        	
			        	<img src="{{URL:: to('public/avatar/default.png')}}" id="showimages" style="width: 150px; height: 150px" alt="Profile Picture"><br><br>
			        	<input type="file" name="picture" id="newPicture" value="" class="form-control" placeholder="">
			        	<br>
						Enter your name: <input id="enterName" type="text" name="name" value="" placeholder="eg. Juan Dela Cruz" class="form-control" style="text-align: center;"> <br>
						Enter your email: <input id="enterEmail" type="text" name="email" value="" placeholder="eg. juandcruz@gmail.com" class="form-control" style="text-align: center;"> <br>
						Choose a password: <input id="enterPassword" type="password" name="password" value="" placeholder="" class="form-control" style="text-align: center;"> <br>

						<div id="createAlert">

						</div>

						<button class="btn btn-primary btn-lg btn-block" name="addsubmit" id="createBtn" class="form-control">Create account</button>
					
			    </div>
			    <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			    </div>
		    </div>

		</div>
	</div>
	
	
	<div>

		<table style="width: 100%;" class="table table-inverse table-stripped" id="listTable">
			<h1>List of Accounts</h1><br>
			<button class="btn btn-info" data-toggle="modal" data-target="#myModal" >Add Account</button><br>
			<br>

			<div id="editalert">
				
			</div>

			
			<thead class="thead-inverse">
				<tr>
					<th style="text-align: center;">Avatar</th>
					<th style="text-align: center;">Name</th>
					<th style="text-align: center;">Email</th>
					<th style="text-align: center;">Edit</th>

				</tr>
			</thead>
			<tbody>
			@foreach ($create as $users)
				<tr style="width: 100%;text-align: center;" id="thisTR">


					<!-- <td colspan="" rowspan="" headers="">{{$users->id}}</td> -->
					<td style="padding: 10px">
						<img src="{{ URL:: to('http://placeholdit/100x100')}}" style="width:100px; height: 100px">
					</td>
					<td style="padding: 10px;">
						<label class="nameLabel" style="width: 100%;display: inline-block;">{{ $users->name }}</label>
						<input type="text" class="nameInput form-control" style="width: 100%;display: inline-block;" name="nameInput" value="{{ $users->name }}" >
						<input type="hidden" name="id" class="userid" value="{{ $users->id }}">
					</td>
					<td style="padding: 10px;">
						<label class="emailLabel" style="width: 100%;display: inline-block;">{{ $users->email }}</label>
						<input type="text" class="emailInput form-control" style="width: 100%;display: inline-block;" name="emailInput" value="{{ $users->email }}" >
					</td>
					<td style="padding: 10px;">

							<button class="btn btn-primary editBtn btn-md" id="editBtn" style="display: inline-block">Edit</button>

							<button class="btn btn-danger removeBtn btn-md" id="removeBtn" style="display: inline-block">Remove</button>

							<button class="btn btn-success saveBtn btn-md" id="saveBtn" style="display: inline-block">Save</button>
					
							<button class="btn btn-warning cancelBtn btn-md" id="cancelBtn" style="display: inline-block">Cancel</button>
						
					</td>

				</tr>
			@endforeach
			</tbody>
		</table>
		
	</div>

	<br><br><br>

</center>

<br>



</body>
</html>



