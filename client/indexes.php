<?php
session_start();
if(isset($_SESSION['Client']))
{
			include'../core/init.php';
			include('../core/logic.php');
			include('includes/head.php');
			$email   = $_SESSION['Client'];
			$amount  = $_SESSION['amount'];
			$message = $_SESSION['message'];
			$name    = $_SESSION['payament-status'];
}
else 
{
	header('Location: ../login.php');
}
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
              <div class="col-xs-11 b">
															<h2>Payment Verification</h2>
														<hr class="bhr"/>
															<h1 class="text-center"><?=$message;?></h1>
														<div class='web'>
																<p>Pay to: Ipheya IT Solutions</p>
																<p>Payment type: <?=$name?></p>
																<p>Amount:R<?=number_format($amount,2,","," ");?></p>
																<p>Date of payment : <?php echo date("d-F-Y");?></p>
																<form name="pay" action="payments.php?Verification=1" method="POST">
																	<script src="https://checkout.stripe.com/checkout.js" 
																	class="stripe-button" 
																	data-key="pk_test_TyOhbjfLozte9N18heMMjOSC" 
																	data-image="Ipheya.log" 
																	data-name="Ipheya IT Solution" 
																	data-description="<?=$name?> <?=$amount;?>"
																	data-amount="<?=$amount;?>" />
																	</script>
																</form>
															</div>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>

<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Standard Deposit</title>
</head>
<body>
<div class="col-sm-12"  style="margin-top:2%;">

</div>
</body>
</html>-->
<style>
.web{
	font-family:tahoma;
	size:12px;
	top:10%;
	border:1px solid #CDCDCD;
	border-radius:10px;
	padding:10px;
	width:45%;
	margin:auto;
	height:auto;
}
h1{
	margin:3px 0;
	font-size:13px;
	text-decoration:underline;
}
.tLink{
	font-family:tahoma;
	size:12px;
	padding-left:10px;
	text-align:center;
}

.talign_right{
	text-align:right;
}
.username_availability_result{
	display:block;
	width:auto;
	float:left;
	padding-left:10px;
}
.input{
	float:left;
}
.error{
	color:#FF0000;
	font-size:12px;
}

</style> 