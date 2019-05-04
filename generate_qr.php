<?php
include 'includes/connect.php';
include 'includes/wallet.php';
include 'includes/functions.php';

if($_SESSION['admin_sid']==session_id() && isset($_GET['o_id']))
{
	$o_id = sanitizeData($_GET['o_id']);
	$sql = mysqli_query($con, "SELECT verification_string, status FROM orders WHERE id = $o_id");
	$verification_string = "";
	$status = "";
	while($row = mysqli_fetch_array($sql))
	{
		$verification_string = $row['verification_string'];
		$status = $row['status'];
	}

	$sql = mysqli_query($con, "SELECT pkey FROM users WHERE id = $user_id");
	$pkey = "";

	while($row = mysqli_fetch_array($sql))
	{
		$pkey = $row['pkey'];
	}

	$qr_string = my_simple_crypt($verification_string,'e',$pkey);

	$string = "";
	if($status=='Ready for pickup'){
		$string = '<h3>Order No. '.$o_id.'</h3>'.
			  '<br>'.
			  '<h4 style="color:orange;">Status: Waiting for user verification</h4>'.
			  '<br>';
	    echo $string."<img alt='$qr_string' height='500' width='500' src='https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=$qr_string'>";
	    ?>
	    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
	    <script type="text/javascript">
      $( document ).ready(function() {

        var interval = self.setInterval(function(){checkupdates()},1000);
          
      });

      function checkupdates(){
        $.ajax({url: "checkstatus2.php?o_id=<?php echo $o_id; ?>", success: function(result){
            if(result==1){
              window.location.reload();
            }
          }});
      }
    </script>

	    <?php
	    
	}elseif ($status=='Verified'){
		$string = '<h3>Order No. '.$o_id.'</h3>'.
			  '<br>'.
			  '<h4 style="color:green;">Status: '.$status.'</h4>'.
			  '<br>';
		echo $string; 

	}else{
		$string = '<h3>Order No. '.$o_id.'</h3>'.
			  '<br>'.
			  '<h4 style="color:blue;">Status: '.$status.'</h4>'.
			  '<br>';
	  	echo $string;
			  
	}

die();

	
}else{

	header("location:login.php");
}

?>