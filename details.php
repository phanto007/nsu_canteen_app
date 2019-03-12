<?php

include 'includes/connect.php';
$user_id = $_SESSION['user_id'];

$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");

while($row = mysqli_fetch_array($result)){
  $name = $row['name'];	
  $username = $row['username'];
  $email = $row['email'];
  $address = $row['address'];
  $city = $row['city'];
  $post = $row['post'];
  $country = $row['country'];
  $contact = $row['contact'];
}
	if($_SESSION['customer_sid']==session_id())
	{
		?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Edit Details</title>

  <!-- Favicons-->
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
   <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
  .left-alert input[type=text] + label:after, 
  .left-alert input[type=password] + label:after, 
  .left-alert input[type=email] + label:after, 
  .left-alert input[type=url] + label:after, 
  .left-alert input[type=time] + label:after,
  .left-alert input[type=date] + label:after, 
  .left-alert input[type=datetime-local] + label:after, 
  .left-alert input[type=tel] + label:after, 
  .left-alert input[type=number] + label:after, 
  .left-alert input[type=search] + label:after, 
  .left-alert textarea.materialize-textarea + label:after{
      left:0px;
  }
  .right-alert input[type=text] + label:after, 
  .right-alert input[type=password] + label:after, 
  .right-alert input[type=email] + label:after, 
  .right-alert input[type=url] + label:after, 
  .right-alert input[type=time] + label:after,
  .right-alert input[type=date] + label:after, 
  .right-alert input[type=datetime-local] + label:after, 
  .right-alert input[type=tel] + label:after, 
  .right-alert input[type=number] + label:after, 
  .right-alert input[type=search] + label:after, 
  .right-alert textarea.materialize-textarea + label:after{
      right:70px;
  }
  </style> 
</head>

<body>
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="#" class="brand-logo darken-1"><img src="images/materialize-logo.png" alt="logo"></a> <span class="logo-text">Logo</span></h1></li>
                    </ul>				
                </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">
      <?php
          include 'includes/sidebar.php';
      ?>

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">User Details</h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <p class="caption">Edit user details and credentials</p>
          <div class="divider"></div>
            <div class="row">
              <div class="col s12 m4 l3">
                <h4 class="header">Details</h4>
              </div>
              <div>
                <div class="card-panel">
                  <div class="row">
                    <form class="formValidate" id="formValidate" method="post" action="routers/details-router.php" novalidate="novalidate"class="col s12">

                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-account-circle prefix"></i>
                          <input name="name" id="name" type="text" value="<?php echo $name;?>" data-error=".errorTxt2">
                          <label for="name" class="">Name</label>
						              <div class="errorTxt2"></div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-communication-email prefix"></i>
                          <input name="email" id="email" type="email" value="<?php echo $email;?>" data-error=".errorTxt3">
                          <label for="email" class="">Email</label>
						              <div class="errorTxt3"></div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-lock-outline prefix"></i>
                          <input name="password" id="password" type="password" data-error=".errorTxt4" required>
                          <label for="password" class="">Password</label>
						              <div class="errorTxt4"></div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-home prefix"></i>
                          <textarea name="address" id="address" class="materialize-textarea validate" data-error=".errorTxt6"><?php echo $address;?></textarea>
                          <label for="address" class="">Address</label>
						              <div class="errorTxt6"></div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-home prefix"></i>
                          <textarea name="city" id="city" class="materialize-textarea validate" data-error=".errorTxt6"><?php echo $city;?></textarea>
                          <label for="city" class="">City</label>
                          <div class="errorTxt6"></div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-home prefix"></i>
                          <textarea name="country" id="country" class="materialize-textarea validate" data-error=".errorTxt6"><?php echo $country;?></textarea>
                          <label for="country" class="">Country</label>
                          <div class="errorTxt6"></div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-home prefix"></i>
                          <textarea name="post" id="post" class="materialize-textarea validate" data-error=".errorTxt6"><?php echo $post;?></textarea>
                          <label for="address" class="">Post Code</label>
                          <div class="errorTxt6"></div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-communication-phone prefix"></i>
                          <textarea name="phone" id="contact" class="materialize-textarea validate" data-error=".errorTxt6"><?php echo $contact;?></textarea>
                          <label for="contact" class="">Phone</label>
                          <div class="errorTxt6"></div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="input-field col s12">
                          <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                            <i class="mdi-content-send right"></i>
                          </button>
                        </div>
                      </div>

                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <div class="divider"></div>
            
          </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->
    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

    <?php
      include 'includes/footer.php';
    ?>



    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>

    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
            username: {
                required: false,
                minlength: 5,
				        maxlength: 10
            },

            name: {
                required: false,
                minlength: 5,
				        maxlength: 15
            },

            email: {
				        required: false,
				        maxlength: 35,
			      },

			      password: {
  				      required: false,
  				      minlength: 5,
  				      maxlength: 16,
  			    },

            phone: {
				      required: false,
				      minlength: 4,
				      maxlength: 11
			      },
			      address: {
				      required: false,
				      minlength: 10,
				      maxlength: 300
			      },
        },
        messages: {
            username: {
                required: "Enter username",
                minlength: "Minimum 5 characters are required.",
                maxlength: "Maximum 10 characters are required."				
            },
            name: {
                required: "Enter name",
                minlength: "Minimum 5 characters are required.",
                maxlength: "Maximum 15 characters are required."
            },
            email: {
				        required: "Enter email",
                maxlength: "Maximum 35 characters are required."				
			      },
      			password: {
      				  required: "Enter password",
      				  minlength: "Minimum 5 characters are required.",
                maxlength: "Maximum 16 characters are required."				
    			  },
            phone:{
    				    required: "Specify contact number.",
    				    minlength: "Minimum 4 characters are required.",
                maxlength: "Maximum 11 digits are accepted."				
    			  },	
            address:{
				        required: "Specify address",
				        minlength: "Minimum 10 characters are required.",
                maxlength: "Maximum 300 characters are accepted."				
			      },			
        },

        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
    </script>
</body>

</html>
<?php
	}
	else
	{
		if($_SESSION['admin_sid']==session_id())
		{
			header("location:admin-page.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>
