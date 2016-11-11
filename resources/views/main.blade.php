<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
			    </div>
			    <div class="modal-body">
			        <form >
						Enter your name: <input id="enterName" type="text" name="name" value="" placeholder="eg. Juan Dela Cruz" class="form-control" style="text-align: center;"> <br>
						Enter your email: <input id="enterEmail" type="text" name="email" value="" placeholder="eg. juandcruz@gmail.com" class="form-control" style="text-align: center;"> <br>
						Choose a password: <input id="enterPassword" type="password" name="password" value="" placeholder="" class="form-control" style="text-align: center;"> <br><br>
						<button class="btn btn-primary btn-lg btn-block" name="addsubmit" id="createBtn" class="form-control">Create account</button>
					</form>
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
			<!-- <a href="/create" > --><button class="btn btn-info" data-toggle="modal" data-target="#myModal" >Add Account</button><!-- </a> --><br><br>
			<thead class="thead-inverse">
				<tr>
					<th style="text-align: center;">Name</th>
					<th style="text-align: center;">Email</th>
					<th style="text-align: center;">Edit</th>

				</tr>
			</thead>
			<tbody>
			@foreach ($create as $users)
				<tr style="width: 100%;text-align: center;" id="thisTR">

					<td style="padding: 10px;">
						<label class="nameLabel" style="width: 100%;display: inline-block;">{{ $users->name }}</label><br>
						<input type="text" class="nameInput form-control" style="width: 100%;display: inline-block;" name="nameInput" value="{{ $users->name }}" >
						<input type="hidden" name="id" class="userid" value="{{ $users->id }}">
					</td>
					<td style="padding: 10px;">
						<label class="emailLabel" style="width: 100%;display: inline-block;">{{ $users->email }}</label><br>
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

	<script>

		//$('input.nameInput').each().hide();

		$('.editBtn').each(function() //EDIT BUTTON FUNCTIONS
			{
				//CHANGE LABEL TO TEXTBOX HEHE
				var labelemail =  $(this).closest('tr').find('label.emailLabel');
			    var labelname = $(this).closest('tr').find('label.nameLabel');

			    var inputname = labelname.next().next();
			    var inputemail = labelemail.next().next();

			    inputname.hide();
				inputemail.hide();
				$(this).next().next().hide();//SAVE BUTTON
				$(this).next().next().next().hide();//CANCEL BUTTON

			    $(this).on('click', function(){
			    	labelname.hide();
			    	labelemail.hide();
				    inputname.show();
				    inputemail.show();
				    $(this).hide();//EDIT BUTTON
				    $(this).next().hide();//REMOVE BUTTON
				    $(this).next().next().show();//SAVE BUTTON
				    $(this).next().next().next().show();//CANCEL BUTTON

				    var nameData = inputname.val();
				    var emailData = inputemail.val();
				    //var idData = userid.val();

				    /*$.ajax({
				        method: 'POST',
				        url: '/update',
				        data: {
				            id: idData,
				            name: nameData,
				            email: emailData
				         },
				    });*/

			    });

			    //END OF CHANGE LABEL TO TEXTBOX HEHE

			});

		$('.removeBtn').each(function() //REMOVE BUTTON FUNCTIONS
			{
				var remove = $(this).closest('tr');
				var labelemail =  $(this).closest('tr').find('label.emailLabel');
			    var labelname = $(this).closest('tr').find('label.nameLabel');

			    var inputname = labelname.next().next();
			    var hiddenid = inputname.next();
			    var inputemail = labelemail.next().next();


			    $(this).on('click', function(){
			    	labelname.show();
			    	labelemail.show();
				    inputname.hide();
				    inputemail.hide();
				    $(this).show();//REMOVE BUTTON
				    $(this).prev().show();//REMOVE BUTTON
				    $(this).next().hide();//CANCEL BUTTON
				    $(this).next().next().hide();//CANCEL BUTTON

				    //GET REQUEST FOR REMOVAL
				    var nameData = inputname.val();
				    var emailData = inputemail.val();
				    var idData = hiddenid.val();

				    /*$.get("/delete/"+idData,function(data, status)
				    {
				    	alert("Account successfully removed.");
				    	//$(this).closest('#thisTR').remove();
				    });*/

				    $.ajax({
				        method: 'GET',
				        url: '/delete/'+idData,
				        success: function(data)
				        {
				        	console.log(data);
				        	alert("Record deleted.");
				        	remove.remove();
				        }
				    });
				    
			    });

			});

		$('.saveBtn').each(function() //SAVE BUTTON FUNCTIONS
			{
				var labelemail =  $(this).closest('tr').find('label.emailLabel');
			    var labelname = $(this).closest('tr').find('label.nameLabel');

			    var inputname = labelname.next().next();
			    var hiddenid = inputname.next();
			    var inputemail = labelemail.next().next();

			    $(this).on('click', function(){

			    	labelname.show();
			    	labelemail.show();
				    inputname.hide();
				    inputemail.hide();
				    $(this).hide();//SAVE BUTTON
				    $(this).prev().show();//REMOVE BUTTON
				    $(this).next().hide();//CANCEL BUTTON
				    $(this).prev().prev().show();//CANCEL BUTTON

				    var nameData = inputname.val();
				    var emailData = inputemail.val();
				    var idData = hiddenid.val();

				    $.ajax({
				        method: 'POST',
				        url: '/update',
				        data: {
				            id: idData,
				            name: nameData,
				            email: emailData
				         },
				        success: function(data)
				        {
				        	console.log(data);
				        	inputname.val(data["name"]);
				        	labelname.text(data["name"]);
				        	inputemail.val(data["email"]);
				        	labelemail.text(data["email"]);
				        }
				    });
			    });

			});

		$('.cancelBtn').each(function() //SAVE BUTTON FUNCTIONS
			{
				var labelemail =  $(this).closest('tr').find('label.emailLabel');
			    var labelname = $(this).closest('tr').find('label.nameLabel');

			    var inputname = labelname.next().next();

			    var inputemail = labelemail.next().next();

			    var nameData = inputname.val();
			    var emailData = inputemail.val();


			    $(this).on('click', function(){
			    	labelname.show();
			    	labelemail.show();
				    inputname.hide();
				    inputemail.hide();
				    $(this).hide();//CANCEL BUTTON
				    $(this).prev().hide();//SAVE BUTTON
				    $(this).prev().prev().show();//REMOVE BUTTON
				    $(this).prev().prev().prev().show();//EDIT BUTTON

				    inputname.val(nameData);
				    inputemail.val(emailData);

			    });

			});

		$('#createBtn').on('click',(function(event) {
			
			var eName = $('#enterName').val();
			var eEmail = $('#enterEmail').val();
			var ePass = $('#enterPassword').val();

			$.ajax({
				        method: 'POST',
				        url: 'create/submit',
				        data: {
				            name: eName,
				            email: eEmail,
				            password: ePass
				         },
				        success: function(data)
				        {
				        	console.log(data);

				        	$('#listTable tbody').append('<tr style="width: 100%;text-align: center;" id="thisTR"><td style="padding: 10px;"><label class="nameLabel" style="width: 100%;display: inline-block;">'+data["newName"]+'</label><br><input type="text" class="nameInput form-control" style="width: 100%;display: inline-block;" name="nameInput" value="'+data["newName"]+'" ><input type="hidden" name="id" class="userid" value="'+data["newId"]+'"></td><td style="padding: 10px;"><label class="emailLabel" style="width: 100%;display: inline-block;">'+data["newEmail"]+'</label><br><input type="text" class="emailInput form-control" style="width: 100%;display: inline-block;" name="emailInput" value="'+data["newEmail"]+'" ></td><td style="padding: 10px;"><button class="btn btn-primary editBtn btn-md" id="editBtn" style="display: inline-block">Edit</button><button class="btn btn-danger removeBtn btn-md" id="removeBtn" style="display: inline-block">Remove</button><button class="btn btn-success saveBtn btn-md" id="saveBtn" style="display: inline-block">Save</button><button class="btn btn-warning cancelBtn btn-md" id="cancelBtn" style="display: inline-block">Cancel</button></td></tr>');

				        	alert('Account successfully created!')

				        }
				    });

		});

		

	</script>

	<!-- <div id="updateDiv">

		<form action="/update" method="post" accept-charset="utf-8">
			<input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}" >
			Name: <input type="text" name="name" value="{{ isset($name) ? $name : '' }}" placeholder=""> <br><br>
			Email: <input type="text" name="email" value="{{ isset($email) ? $email : '' }}" placeholder=""> <br><br>
			New Password: <input type="password" name="password" value="" placeholder=""> <br><br>

			<input type="submit" class="btn btn-success" name="updatesubmit" value="Update account">

		</form>
		
	</div> -->
</center>

<br>



</body>
</html>



