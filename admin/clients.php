<?php
session_start();
    if(isset($_SESSION['Employee']))
    {
		 require_once('../core/init.php');
		 include('includes/head2.php');
		 include('../core/logic.php');
		 require_once('../core/controllers/client-controller.php');
		//  include('includes/navigation.php');
    }
    else
    {
      header("Location:../login.php");
    }
     

?>

<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-10 b'>
              <h2 class="text-center">All Clients</h2></h2><hr class="bhr">
							<table class="table  " style="padding:2%;">
								<thead>
									<th>Client No</th><th>Name</th><th>Email</th><th>Options</th>
								</thead>
								<tbody>
									<?=$allClients;?>
								</tbody>
								<tfoot>
<<<<<<< HEAD
<<<<<<< HEAD
								</tfoot>
							</table>
=======
=======
>>>>>>> bf70662ea22827d46098b33ba13833a6c3395e99
                  <tr><td><a href="">Show clients statisticks?</a></td></tr>
								</tfoot>
							</table>
              <hr class="bhr"/>
              <div class="col-xs-12">
                <div class="col-xs-6 col-xs-offset-3">
                </div>
              </div>
<<<<<<< HEAD
>>>>>>> 99a079921e80d6f614019d96f8546c8a862ae4b0
=======
>>>>>>> bf70662ea22827d46098b33ba13833a6c3395e99
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script>
	$(".table").dataTable();
</script>