<!DOCTYPE html>
<html lang="en" class="loading">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <title>User Details</title>
  <link rel="icon" href="#" type="image/x-icon" />



  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/fonts/feather/style.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/fonts/simple-line-icons/style.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/fonts/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/css/perfect-scrollbar.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendors/css/prism.min.css') ?>">

  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/app.css') ?>">

</head>

<body data-col="1-column" class=" 1-column  blank-page blank-page">
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="wrapper">
    <!--Login Page Starts-->
    <section id="login">
      <div class="container-fluid">
        <div class="row full-height-vh">
          <div class="col-12 d-flex align-items-center justify-content-center gradient-aqua-marine">
            <div class="card px-4 py-2 box-shadow-2 width-400">
              <div class="card-header text-center">
                <h4 class="text-uppercase text-bold-400 grey darken-1">User Details</h4>
              </div>
							<?php if ($this->session->flashdata('success_msg')) : ?>
							<div class="alert alert-success">
								<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
								<?php echo $this->session->flashdata('success_msg') ?>
							</div>
						<?php endif ?>
						<?php if ($this->session->flashdata('error_msg')) : ?>
							<div class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
								<?php echo $this->session->flashdata('error_msg') ?>
							</div>
						<?php endif ?>
              <div class="card-body">
                <div class="card-block">

                <select class="selectpicker" id ="select_val" onchange="show_detail(this.value);">
            
             
            </select>
            <button type="button" onclick="function_show();">+</button>
            <div class="row" style="display:none;" id="show_div">

                  <form id="frm" class="xhr_form">
			<div class="form-group">
                      <div class="col-md-12">
                      <label>User Name *</label>
                        <input type="text" class="form-control form-control-lg" name="u_name" id="u_name" placeholder="User name" required>
                        <p id="user_email_error"></p>
                      </div>
                    </div>
			<div class="form-group">
                      <div class="col-md-12">
                      <label>Name *</label>
                        <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Name" required>
                        <p id="user_email_error"></p>
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <div class="col-md-12">
                      <label>Password *</label>
                        <input type="text" class="form-control form-control-lg" name="password" id="password" placeholder="Password" required>
                        <p id="user_email_error"></p>
                      </div>
                    </div>
 			<div class="form-group">
                      <div class="col-md-12">
                      <label>Otp Mail *</label>
                        <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Email Address" required>
                        <p id="user_email_error"></p>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="text-center col-md-12">
			<input type="hidden" name="user_id" id="user_id">
                        <button type="submit" class="btn btn-primary px-4 py-2 text-uppercase white font-small-4 box-shadow-2 border-0">Submit</button>
                      </div>
                    </div>
                  </form>
                  <div>
                </div>
              </div>
             
            </div>
          </div>
        </div>
s      </div>
    </section>

    <!--Login Page Ends-->
  </div>

  <script src="<?= base_url('assets/vendors/js/core/jquery-3.3.1.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendors/js/core/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendors/js/perfect-scrollbar.jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendors/js/jquery.matchHeight-min.js') ?>"></script>
  <script src="<?= base_url('assets/vendors/js/screenfull.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendors/js/pace/pace.min.js') ?>"></script>
  <script>

$(document).ready(function () {
get_data();
});


function get_data(){
    
    $.ajax({
        url:"<?php echo base_url('User/fetch_data'); ?>",
        type:"POST",
        
        dataType:'json',
        encode: true,
        success:function(response){
            
	
	var selectElem = $("#select_val");
                        selectElem.html('<option value="All">Select User</option>');
                        $.each(response, function(index){
                          $("<option/>", {
                                  value: response[index].user_id,
                                  text: response[index].full_name
                              }).appendTo(selectElem);
                        });


   
           
        }
    }); 
}

function show_detail(val){
$.ajax({
        url:"<?php echo base_url('User/fetch_data_for_edit'); ?>",
        type:"POST",
        data:{val:val},
        dataType:'json',
        encode: true,
        success:function(response){
	$("#show_div").show();
	$('#user_id').val(response.result.user_id);  
	$('#u_name').val(response.result.user_name);  
	$('#name').val(response.result.full_name);  
	$('#password').val(response.result.password);  
	$('#email').val(response.result.email);  
            
	
	


   
           
        }
    }); 



}

	
function function_show(){
$("#show_div").show();
}

$('#frm').submit(function(event){
        event.preventDefault();


       
        let form_val=$('#frm').serialize();
     
       
        $.ajax({
            url: "<?php echo base_url('User/user_data_store'); ?>",
            type:'POST',
            data: form_val,
            success:function(data){
                //alert(data);
                if(data==1){
                 alert('User added Successfully Done');
		$("#show_div").hide();
		get_data();
                 
                }
		else if(data==2){
                 alert('User Updated Successfully Done');
		$("#show_div").hide();
		get_data();
                 
                }
		else if(data==0){
                 alert('Username already Exist.please select other');
		
                 
                }
		else{
                    alert('Error! Please try again')
                }
               
            }
        });

    });



</script>





</body>

</html>
