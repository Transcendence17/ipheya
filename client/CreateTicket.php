<?php
   session_start();
   if(isset($_SESSION['Client']))
   {
      require_once('../core/init.php');
      include('includes/head.php');
      include('../core/logic.php');
      include('../core/controllers/ticket-controller.php');
   }
   else
   {
     header('Location: ../login.php');
   }
   $profile_page = 'selected';
?>

<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-6'>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active"><i class="fa fa-shopping-cart"></i> My Order</li>
                </ol>
            </div><!-- /col-xs-6-->
            <div class='col-xs-10 col-xs-offset-1 cb'>
              <form class='form' method="POST" action="CreateTicket.php" enctype="multipart/form-data">
                <fieldset>
                    <legend class='thelegend'>Create Ticket</legend>
                    <div class='form-group col-xs-5'>
                        <label >Subject:</label>
                        <input  type="Text" name="Subject" class="form-control" placeholder="Subject" required>
                    </div>
                    <div class='form-grou col-xs-6'>
                        <label>Whay was your request?</label>
                        <select id="Request" class="form-control" name="RequestType" required>
                            <option value="0">--Select Request Type--</option>
                            <option value="1">Service</option>
                            <option value="2">Maintenance</option>
                            <option value="3">Repairs</option>
                        </select>                            
                    </div>
                    <div class='form-group col-xs-11'>
                        <label>Explain the descovered fault:</label>
                        <textarea class="form-control foo" name="ProblemDescription"  cols="80" rows="6" required></textarea>                           
                    </div>
                    <div class='form-group col-xs-7'>
                        <label>Attatch Pictures:</label>
                        <input type="file" name="files[]" multiple="true"/>                           
                    </div>
                    <hr class="bhr"/>
                    <div class="form-group row">
                        <div class='col-xs-6 col-xs-offset-3'>
                            <input type="submit" name="Submit" class="btn btn-success form-control" value="Submit"/>
                        </div>
                    </div>
                </fieldset>
            </form>
          </div>
        </div>
      </div>
  </div>
</body>
<style>
        textarea.foo
        {
        resize:true;
        }
</style>
