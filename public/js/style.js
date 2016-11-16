$('.editBtn').each(function() //EDIT BUTTON FUNCTIONS
    {
        //CHANGE LABEL TO TEXTBOX HEHE
        var thisBtn = $(this);
        var labelemail =  $(this).closest('tr').find('label.emailLabel');
        var labelname = $(this).closest('tr').find('label.nameLabel');

        var inputname = labelname.next();
        var inputemail = labelemail.next();

        inputname.hide();
        inputemail.hide();
        $(this).next().next().hide();//SAVE BUTTON
        $(this).next().next().next().hide();//CANCEL BUTTON

    });

$(document).on('click', '.editBtn', function(){

    var thisBtn = $(this);
    var labelemail =  $(this).closest('tr').find('label.emailLabel');
    var labelname = $(this).closest('tr').find('label.nameLabel');

    var inputname = labelname.next();
    var inputemail = labelemail.next();
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


});

$('.removeBtn').each(function() //REMOVE BUTTON FUNCTIONS
    {
        var thisBtn = $(this);
        var remove = $(this).closest('tr');
        var labelemail =  $(this).closest('tr').find('label.emailLabel');
        var labelname = $(this).closest('tr').find('label.nameLabel');

        var inputname = labelname.next();
        var hiddenid = inputname.next();
        var inputemail = labelemail.next();

    });

$(document).ready(function() {
    
    $(document).on('click', '.removeBtn', function(){
        var thisBtn = $(this);
        var remove = $(this).closest('tr');
        var labelemail =  $(this).closest('tr').find('label.emailLabel');
        var labelname = $(this).closest('tr').find('label.nameLabel');

        var inputname = labelname.next();
        var hiddenid = inputname.next();
        var inputemail = labelemail.next();

        //CONFIRMATION MESSAGE
        var confirmation = confirm('Are you sure you want to delete this record?');
        if (confirmation == true)
        {
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

            $.ajax({
                method: 'GET',
                url: '/delete/'+idData,
                success: function(data)
                {
                    console.log(data);
                    //alert("Record deleted.");
                    remove.remove();
                    $('#modalAlertEdit').remove();
                    $('#editalert').append('<div class="alert alert-success" id="modalAlertEdit" style="display: none"><strong>Success!</strong> Record successfully deleted.</div>');
                    $('#modalAlertEdit').show();
                }
            });
        }

    });
});


$('.saveBtn').each(function() //SAVE BUTTON FUNCTIONS
    {
        var labelemail =  $(this).closest('tr').find('label.emailLabel');
        var labelname = $(this).closest('tr').find('label.nameLabel');

        var inputname = labelname.next();
        var hiddenid = inputname.next();
        var inputemail = labelemail.next();

    });

$(document).on('click', '.saveBtn', function(){


    var labelemail =  $(this).closest('tr').find('label.emailLabel');
    var labelname = $(this).closest('tr').find('label.nameLabel');

    var inputname = labelname.next();
    var hiddenid = inputname.next();
    var inputemail = labelemail.next();

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
            //alert('Account successfully updated!');
            console.log(data);
            inputname.val(data["name"]);
            labelname.text(data["name"]);
            inputemail.val(data["email"]);
            labelemail.text(data["email"]);
            $('#modalAlertEdit').remove();
            $('#editalert').append('<div class="alert alert-success" id="modalAlertEdit" style="display: none"><strong>Success!</strong> Changes have been saved.</div>');
            $('#modalAlertEdit').show();
            
        },
        error: function(data)
        {
            var nameOldData = labelname.text();
            var emailOldData = labelemail.text();

            var error = data.responseJSON;
            
            $('#modalAlertEdit').remove();
            $('#editalert').append('<div class="alert alert-danger" id="modalAlertEdit" style="display: none"><strong>Oops!</strong></div>');

            $('#modalAlertEdit').show();

            if(error.name!=null)
            {
                $('#modalAlertEdit').append(error.name);
            }
            if(error.email!=null)
            {
                $('#modalAlertEdit').append(error.email);

            }

            inputname.val(nameOldData);
            inputemail.val(emailOldData);
            
            console.log(error.name);
            console.log(error.email);
        }
    });
});

$('.cancelBtn').each(function() //SAVE BUTTON FUNCTIONS
    {
        var labelemail =  $(this).closest('tr').find('label.emailLabel');
        var labelname = $(this).closest('tr').find('label.nameLabel');

        var inputname = labelname.next();

        var inputemail = labelemail.next();

        var nameData = inputname.val();
        var emailData = inputemail.val();

    });

$(document).on('click', '.cancelBtn', function(){
    
    var labelemail =  $(this).closest('tr').find('label.emailLabel');
    var labelname = $(this).closest('tr').find('label.nameLabel');

    var inputname = labelname.next();

    var inputemail = labelemail.next();

    var nameData = labelname.text();
    var emailData = labelemail.text();

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

$('#createBtn').on('click',(function() 
{

    var eName = $('#enterName').val();
    var eEmail = $('#enterEmail').val();
    var ePass = $('#enterPassword').val();
    //var ePicture = $('#newPicture').val();

    $.ajax({
        method: 'POST',
        url: 'create/submit',
        data: {
            name: eName,
            email: eEmail,
            password: ePass,

         },
        success: function(data)
        {
            console.log(data);
            

            $('#listTable tbody').append('<tr style="width: 100%;text-align: center;" id="thisTR"><td style="padding: 10px;"><label class="nameLabel" style="width: 100%;display: inline-block;">'+data["newName"]+'</label><input type="text" class="nameInput form-control" style="width: 100%;display: none;" name="nameInput" value="'+data["newName"]+'" ><input type="hidden" name="id" class="userid" value="'+data["newId"]+'"></td><td style="padding: 10px;"><label class="emailLabel" style="width: 100%;display: inline-block;">'+data["newEmail"]+'</label><input type="text" class="emailInput form-control" style="width: 100%;display: none;" name="emailInput" value="'+data["newEmail"]+'" ></td><td style="padding: 10px;">&nbsp;&nbsp;<button class="btn btn-primary editBtn btn-md" id="editBtn" style="display: inline-block">Edit</button>&nbsp;<button class="btn btn-danger removeBtn btn-md" id="removeBtn" style="display: inline-block">Remove</button>&nbsp;<button class="btn btn-success saveBtn btn-md" id="saveBtn" style="display: none">Save</button>&nbsp;<button class="btn btn-warning cancelBtn btn-md" id="cancelBtn" style="display: none">Cancel</button></td></tr>');

            $('#myModal').modal('toggle');
            $('#modalAlertEdit').remove();
            $('#editalert').append('<div class="alert alert-success" id="modalAlertEdit" style="display: none"><strong>Success!</strong> Account successfully created.</div>');
            $('#modalAlertEdit').show();

            if($('#enterName').val() == eName)
            {
                $('#enterName').val("");
            }
            if($('#enterEmail').val() == eEmail)
            {
                $('#enterEmail').val("");
            }
            if($('#enterPassword').val() == ePass)
            {
                $('#enterPassword').val("");
            }
            $('#modalAlert').remove();

        },
        error: function(data)
        {
            var error = data.responseJSON;
            //console.log(data);
            $('#modalAlert').remove();
            $('#createAlert').append('<div class="alert alert-danger" id="modalAlert" style="display: none"><strong>Oops!</strong></div>');
            $('#modalAlert').show();

            if(error.name!=null)
            {
                $('#modalAlert').append(error.name);
            }
            if(error.email!=null)
            {
                $('#modalAlert').append(error.email);

            }
            if(error.password!=null)
            {
                $('#modalAlert').append(error.password);

            }

        }
    });

}));

//SHOW CHOSEN IMAGE
function readURL(input)
{
    if(input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e)
        {
            $('#showimages').attr('src',e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).on('change', '#newPicture', function()
{
    readURL(this);
});
//END OF SHOW CHOSEN IMAGE