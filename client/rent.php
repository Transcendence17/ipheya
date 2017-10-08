<?php

				require('core/init.php');
				require('core/logic.php');
				require('core/controllers/rent-controller.php');
				if(isset($_POST['proceed']))
				{
					$pickup_date=$_POST['pickup_date'];
					$return_date=$_POST['return_date'];   
					$quantity=$_POST['quantity'];   
					$total_charge=$_POST['total_charge'];
					$total_deposit=$_POST['total_deposit'];
					$total_amount=$_POST['total_amount'];
				$order[] = array("pickup_date"=>$pickup_date,"return_date"=>$return_date,"quantity"=>$quantity,"total_charge"=>$total_charge,"total_deposit"=>$total_deposit,"total_amount"=>$total_amount);   
					$thisarr[] = $order;
					if(count($thisarr)>=3)
					{
						die(json_encode($thisarr));
					}
				}
	   	else
		  {
					header("Location:../login.php");
		  }
			
		?>

	 
<!DOCTYPE HTML>
<html lang="en-US">

<!-- Mirrored from demo.shapedtheme.com/Ipheya-html/slider/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 May 2017 12:43:17 GMT -->
<head>
	<meta charset="UTF-8">
	<title>rentals</title>

	<!-- CSS -->
	<link rel="stylesheet" href="assets/index/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/index/css/font-awesome.min.css" />
	<link rel="stylesheet" href="assets/index/css/style.css" />
 	<!-- COLORS -->
	<link rel="stylesheet" href="assets/index/css/colors/blue.css" title="blue"> <!-- DEFAULT COLOR/ CURRENTLY USING -->
	<link rel="alternate stylesheet" href="assets/index/css/colors/green.css" title="green">
	<link rel="alternate stylesheet" href="assets/index/css/colors/orange.css" title="orange">
	<link rel="alternate stylesheet" href="assets/index/css/colors/purple.css" title="purple">
	<link rel="alternate stylesheet" href="assets/index/css/colors/slate.css" title="slate">
	<link rel="alternate stylesheet" href="assets/index/css/colors/yellow.css" title="yellow">
	<link rel="alternate stylesheet" href="assets/index/css/colors/red.css" title="red">
	<link rel="alternate stylesheet" href="assets/index/css/colors/blue-munsell.css" title="blue-munsell">

	<!-- STYLE SWITCH STYLESHEET ONLY FOR DEMO -->
	<link rel="stylesheet" href="assets/index/demo/demo.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="assets/Site.css">

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="assets/index/images/favicon.gif">

	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.js"></script>
    <![endif]-->
</head>
<body>
	<div id="st-preloader">
		<div id="pre-status">
			<div class="preload-placeholder"></div>
		</div>
	</div><!-- /#st-preloader -->

	<section id="home-page">
		<div class="container-fluid home-bg" style="padding-top:10px;">

			<div class="row">
				<div class="col-md-12 text-center home-page">
					 <div class="navbar-collapse collapse">
						<div class="col-xs-offset-3 col-md-8">
      <ul class="nav navbar-nav">
       <li><a class="active"  href="index.php" target="_top">Home</a></li>
       <li><a  href="#service-page" target="_top">Services</a></li>
       <li><a  href="#about-page" target="_top">About-us</a></li>
       <li><a  href="#contact-page" target="_top">Contact-us</a></li>
							<li><a  href="events.php" target="_top">Events</a></li>
							<li><a href="rent.php" target="_top">Rentals</a></li>
       <li><a  href="supports.php" target="_top">Support</a></li>
      </ul>
     </div>
     </div>
					<div class="main-logo">
						<h2 class="text-center" style="font-size:68px;">Rentals</h2>
					</div>
					<div class="col-sm-12 social-shear text-center">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
						<a href="#"><i class="fa fa-pinterest"></i></a>
						<a href="#"><i class="fa fa-dribbble"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
					</div><!-- /.social-shear -->
				</div>
			</div>
		</div>
	</section><!-- /#home-page -->

	<section id="service-page">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="service-title">Rental EquipMent</h1>
					<div class="service-aro-icon">
						<div class="service-aro-left"></div>
      <button type="button" name="proceed" class="btn btn fa fa">Proceed</button>
						<div class="service-aro-right"></div>
					</div>
					<div class="service-aro-icon">
						</div>
						
						<div class="col-xs-11 col-xs-offset-1">
								<hr class="bhr" style="margin-left:-105px;">
								<?=$feedback?>
										<?=$inventories?>
								</div>
						</div>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</section><!-- /#service-page -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modpal-content" id="event-data">

    </div>
  </div>
</div>
	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<div class="col-md-12">
						<div class="col-md-12" id="foot">
							<div class="col-md-4">
								<ul>
									<li>Cloud IT Solution</li>
									<li>UPN Solution</li>
									<li>Computing</li>
									<li>IT Support</li>
									<li>IP VNP</li>
								</ul>
							</div>
							<div class="col-md-4">
								<ul>
									<li>Business Uncapped ADSL</li>
									<li>E-Learning</li>
									<li>IT Support</li>
									<li>Sales</li>
									<li>WIFI</li>
								</ul>
							</div>
							<div class="col-md-4">
								<ul>
									<li>Hardware and Software Maintanance</li>
									<li>Internet Solution</li>
									<li>Lease Equipment</li>
									<li>IT Solution</li>
									<li>Confrence</li>
								</ul>
							</div>
						</div>
						<p>&copy; <?=date('Y');?> <strong><a href="#">Ipheya IT Solution</a></strong>. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- /.footer -->

					<!--Modal-->
		<?php ob_start(); ?>
<div class="modal fade" id="rentalModal" tabindex="-1" role="modal">
<div class="modal-dialog">
		<div class="modal-content">
		<?= $feedback ?>
		<form action="" method="post" class="form-horizontal">

					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class="fa fa-exchange"></i>Rental-Booking</h4>
					</div>

					<div class="modal-body">

							<div class="removeProductMessages"></div>
											<div class="form-group">
													<div class="col-xs-12">
															<label class="col-xs-3" for="">Pick-Date :</label>
																<div class="col-xs-6  input-group input-append " style='padding-left:15px; float: inherit;'>
																<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
																<input name="pickup_date" class="form-control"style="width:100%" placeholder="Pick Date" id="pdate" type="text" value="" required/>
															</div>
													</div>
											</div>
											<div class="form-group">
													<div class="col-xs-12">
															<label class="col-xs-3" for="">Return-Date  :</label>
															<div class="col-xs-6  input-group input-append " style='padding-left:15px; float: inherit;'>
																<span class="input-group-addon" id=''><i class='glyphicon glyphicon-calendar'></i></span>
																<input required type="text"   placeholder="Return Date" class="form-control " id='rdate' name ="return_date"/>
															</div>
													</div>
											</div>
											<div class="form-group">
													<div class="row"></div>
													<div class="col-xs-12">
															<label class="col-xs-3" for="">Quantity :</label>
															<div class="col-xs-4">
																	<input type="number" required class="form-control" id="squantity" name="quantity" >
															</div>
													</div>
											</div>
<hr/>
											<div class="form-group">
													<div class="col-xs-4">
															<label class="col-xs-12" for="">Total Charge:</label>
															<div class="col-xs-12">
																	<input readonly type="text" class="form-control" id="total_charge" name="total_charge"/>
															</div>
													</div>
													<div class="col-xs-4">
													<label class="col-xs-12" for="">Total Deposit:</label>
													<div class="col-xs-12">
															<input readonly type="text"  class="form-control" id="total_deposit" name="total_deposit" />
													</div>
													</div>
													<div class="col-xs-4">
															<label class="col-xs-12" for="">Total Amount:</label>
															<div class="col-xs-12">
																	<input readonly type="text" class="form-control" id="total_amount" name="total_amount"/>
															</div>
													</div>
													
											</div>
											
							</div>
							<!-- /modal body -->
							
							<div class="modal-footer">

									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary" name="Submit" id="createBrandBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>

							</div>
						<!-- /modal-footer -->
						</form>

		</div>
		<!-- /modal-content -->
</div>
<!-- /modal-dailog -->
</div>

<!-- JS -->
<script type="text/javascript" src="assets/index/js/jquery.min.js"></script><!-- jQuery -->
	<script type="text/javascript" src="assets/index/js/bootstrap.min.js"></script><!-- Bootstrap -->
	<script type="text/javascript" src="assets/index/js/countdown.js"></script><!-- Countdown -->
	<script type="text/javascript" src="assets/index/js/jquery.backstretch.min.js"></script><!-- Backstretch -->
	<script type="text/javascript" src="assets/index/js/jquery.ajaxchimp.js"></script><!-- ajaxchimp -->
	<script type="text/javascript" src="assets/index/js/scripts.js"></script><!-- Scripts -->

	<!-- =========================================================
	     STYLE SWITCHER | ONLY FOR DEMO NOT INCLUDED IN MAIN FILES
	============================================================== -->
	<script type="text/javascript" src="assets/index/demo/demo.js"></script>
<link rel="stylesheet" href="assets/plugins/jquery-ui/jquery-ui.css">	<script type="text/javascript" src="assets/plugins/jquery-ui/jquery-ui.js"></script>
	
	<style>
		#view:hover{
			cursor :pointer;
		}

	</style>

<!-- / add modal -->
<script>
	var jsrentals = new Array();
	var rental = new Object();
	<?php foreach($rentals as $rental){?>
				rental = <?php echo json_encode($rental) ?>;
				jsrentals.push(rental);
<?php }?>
console.log(jsrentals);
		function loadevent(id)
		{
				$('#event-data').load('/ipheya/core/sub/finatialR.php?uevent_data='+id);
		}
		$(document).ready(function(){

			$('#pdate').datepicker(
							{
							minDate:0,
							dateFormat: 'yy-mm-dd',
							onSelect: function (date) {
                var date2 = $('#pdate').datepicker('getDate');
                date2.setDate(date2.getDate() + 7);
                $('#rdate').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                $('#rdate').datepicker('option', 'minDate', date2);
            }
							}
			);
			$('#rdate').datepicker(
							{
							minDate:+7,
							dateFormat: 'yy-mm-dd'
							}
			);
		});
		function rent(q)
		{
			var rent = new Object();
			for(var x=0; x< jsrentals.length; x++)
			{
				if(jsrentals[x].rental_id == q)
				{
					rent = jsrentals[x];
					console.log("equal");
				}
			}

			$('#squantity').attr('max',rent.quantity);
			$('#total_deposit').val(rent.product_deposit);
		}

		function closeModal(){
    $('#rentalModal').modal('hide');
    setTimeout(function(){
      $('#rentalModal').remove();
    },500);
  }
	</script>
</body>
</html>
<?php echo ob_get_clean(); ?>