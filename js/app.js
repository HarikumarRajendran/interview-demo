var BaseURL = 'http://localhost/Zaigo/';

$tknVl = $('input[name=_token]').val(), $DtTbl = $('.e-br'), $TblCnt = $('#table-row-cnt');

$(document).ready(function(){

$('#loginForm').on('submit', function(e){

	$Err = 0;
	$name = $("#username").val(), $pwd = $("#password").val();

	if($name == '' || $pwd == ''){

		$Err = 1;
		$('.err').html('Please fill the details!');
		return false;
	}

});

       $(".profile").on('click', function(){
       	$id = $("#profileId").val();
       	$("#e-br-in").val($id);
        $("#UserForm").addClass('d-none');
        $("#UpdateUserForm").removeClass('d-none');
        return false;
       });

       $(".backBtn").on('click', function(){
       	$("#e-br-in").val('');
        $("#UserForm").removeClass('d-none');
        $("#UpdateUserForm").addClass('d-none');
        return false;
       });

});

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
         return false;
    }else{
        return true;
    }
}

var AddUser = function () {

    $Err = 0, $name = $('#inputName'), $email = $('#inputEmail'), $mobile = $('#inputMobile');

	$address = $('#inputAddress'), $zipcode = $('#inputZipcode'), $access = $('#inputAccess');

	$EBrIn = $('#e-br-in');

	if ($EBrIn.val() != '') {

        UpdateUser($EBrIn.val());
        return false;
    }

    if ($name.val() == '' || $email.val() == '' || $mobile.val() == '' || 
    	$address.val() == '' || $zipcode.val() == '' || $access.val() == '' || 
    	IsEmail($email.val() == false)) {

        $Err = 1;
        $('.err').html('Please fill the details');
        return false;
    }


    if (!$Err == 1) {

    	
        $User = {
            userName: $name.val(),
            email: $email.val(),
            mobileno: $mobile.val(),
            address: $address.val(),
            zipcode: $zipcode.val(),
            access:$access.val(),
            _token: $tknVl
        };


        $.ajax({
            url: BaseURL + 'add-user',
            type: 'POST',
            dataType: 'json',
            data: $User,
            encode: !0
        }).done(function (t) {
            if (t.Success) {

            	$("#UserForm")[0].reset();

	            alert('Added Successfully!'); 

            	if (t.UserDt){

	            	$UsrD      = t.UserDt;
	                $ActRw     = parseInt($TblCnt.val());
	                $ActRw     = $ActRw + 1;
	                $AdDtTbl   = $DtTbl.dataTable().fnAddData([
	                    $ActRw,
	                    $UsrD.name,
	                    $UsrD.email,
	                    $UsrD.mobile,
	                    $UsrD.address,
	                    $UsrD.zipcode,
	                    $UsrD.access == 1 ? 'Admin' : 'User',                  
	                    $UsrD.status == 1 ? 'Active' : 'In-active',                                   
	                   '<i class="fa fa-edit cursor-pointer" aria-hidden="true" data-row=' + $ActRw + ' id="e-br-in-' + $UsrD.id + '" data-value=\'' + JSON.stringify($UsrD) + '\' onclick="EditUser(this)"></i>',
	                   '<i class="fa fa-power-off chng-sts cursor-pointer" aria-hidden="true" data-row="'+ $ActRw + '" data="' + $UsrD.id + '" data-td-act="7" onclick="StatusUser(this)"></i>'
	                ]);

	                $AdDtTblRw = $DtTbl.dataTable().fnGetNodes($AdDtTbl);

	                $($AdDtTblRw).attr('id', 'row-' + ($ActRw));

             	}

            } else {
            	$('.err').html(t.Msg);
            }

        }).fail(function (t) {
            
            $('.err').html(t.Msg);
       
        });
    }
    return false;
};

var EditUser = function (t) {

    $ErbId = $('#e-br-in'), $name = $('#inputName'), $email = $('#inputEmail'), $mobile = $('#inputMobile');

	$address = $('#inputAddress'), $zipcode = $('#inputZipcode'), $access = $('#inputAccess');

    $dataRow     = $(t).attr('data-row');
    $UserD        = JSON.parse($(t).attr('data-value'));

    $('#dataRow').val($dataRow);
    $ErbId.val($UserD.id);
    $name.val($UserD.name);
    $email.val($UserD.email);
    $mobile.val($UserD.mobile);
    $address.val($UserD.address);
    $zipcode.val($UserD.zipcode);
    $access.val($UserD.access).trigger('chosen:updated').attr("disabled", true); 
    $('.StrBtn').html('Update');
    $(window).scrollTop(0);
};

var UpdateUser = function (t) {

    $Err = 0, $DataRow = $('#dataRow'), $name = $('#inputName'), $email = $('#inputEmail'), $mobile = $('#inputMobile');

	$address = $('#inputAddress'), $zipcode = $('#inputZipcode'), $access = $('#inputAccess');
    
    if ($name.val() == '' || $email.val() == '' || $mobile.val() == '' || 
    	$address.val() == '' || $zipcode.val() == '' || $access.val() == '' || 
    	IsEmail($email.val() == false)) {

        $Err = 1;
        $('.err').html('Please fill the details');
        return false;
    }


    if (!$Err == 1) {

    	
        $User = {

            UserId: t,
            name: $name.val(),
            email: $email.val(),
            mobile: $mobile.val(),
            address: $address.val(),
            zipcode: $zipcode.val(),
            _token: $tknVl
        };


        $.ajax({
            url: BaseURL + 'update-user',
            type: 'POST',
            dataType: 'json',
            data: $User,
            encode: !0
        }).done(function (t) {
        	alert('Updated Successfully!');
            if (t.Success) {
            	if (t.UserDt) {
	                $UsrD = t.UserDt;
	                $AdDtTbl = $DtTbl.dataTable().fnUpdate([
	                    $DataRow.val(),
	                    $UsrD.name,
	                    $UsrD.email,
	                    $UsrD.mobile,
	                    $UsrD.address,
	                    $UsrD.zipcode,
	                    $UsrD.access == 1 ? 'Admin' : 'User',                  
	                    $UsrD.status == 1 ? 'Active' : 'In-active',                                   
	                   '<i class="fa fa-edit cursor-pointer" aria-hidden="true" data-row=' + $DataRow.val() + ' id="e-br-in-' + $UsrD.id + '"  data-value=\'' + JSON.stringify($UsrD) + '\' onclick="EditUser(this)"></i>',
	                   '<i class="fa fa-power-off chng-sts cursor-pointer" aria-hidden="true" data-row="'+ $DataRow.val() + '" data="' + $UsrD.id + '" data-td-act="7" onclick="StatusUser(this)"></i>'
	                ], $('tr#row-' + $DataRow.val())[0]);

	                $("#UserForm")[0].reset();
	                $('.StrBtn').html('Add');
            	} 
            } else {
            	$('.err').html(t.Msg);
            }

        }).fail(function (t) {
            
            $('.err').html(t.Msg);
       
        });
    }
    return false;
};

var UserUpdate = function (t) {

    $Err = 0, $name = $('#profileName'), $email = $('#profileEmail'), $mobile = $('#profileMobile');

	$address = $('#profileAddress'), $zipcode = $('#profileZipcode'), $access = $('#profileAccess');
    
    if ($name.val() == '' || $email.val() == '' || $mobile.val() == '' || 
    	$address.val() == '' || $zipcode.val() == '' || $access.val() == '' || 
    	IsEmail($email.val() == false)) {

        $Err = 1;
        $('.err').html('Please fill the details');
        return false;
    }


    if (!$Err == 1) {

    	
        $User = {

            UserId: t,
            name: $name.val(),
            email: $email.val(),
            mobile: $mobile.val(),
            address: $address.val(),
            zipcode: $zipcode.val(),
            _token: $tknVl
        };


        $.ajax({
            url: BaseURL + 'update-user',
            type: 'POST',
            dataType: 'json',
            data: $User,
            encode: !0
        }).done(function (t) {
        	
            if (t.Success) {

            	alert('Updated Successfully!');

            } else {
            	$('.err').html(t.Msg);
            }

        }).fail(function (t) {
            
            $('.err').html(t.Msg);
       
        });
    }
    return false;
};

var StatusUser = function (t) {


        $TdAct = $(t).attr('data-td-act');

        $DtRw = $(t).attr('data');
        $DtRwNm = $(t).attr('data-row');

        $ActVal = {
            ActId: $DtRw,
            _token: $tknVl
        };

            $.ajax({
            url: BaseURL + 'admin/user-status',
            type: 'POST',
            dataType: 'json',
            data: $ActVal,
            encode: !0
            }).done(function (t) {

            if (t.Success) {
                $Status = 'In-active';
                if (t.Status == 1) {
                    $Status = 'Active';
                }
                $DtTbl.find('tr#row-' + parseInt($DtRwNm)).find('td:eq(' + $TdAct + ')').html($Status);



            } 
            
            
        }).fail(function (t) {});

        return false;

};