<?php
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('includes/head.php');
  // include('../core/controllers/chat-controller.php');
}
else
{
  header("Location:../login.php");
}
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
              <div class="col-xs-10 b">
                <h1>Welcome to Ipheya IT Solutions</h1>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>

