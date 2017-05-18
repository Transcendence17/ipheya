<?php
     include('includes/head.php');
     include'includes/navigation.php';
     include'../core/logic.php';
     include '../core/controllers/clientRequest-controller.php';
?>
<div class="row"  style="margin:25px 1px 25px 25px;">
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 b" id='change'>

<?php      if(!isset($_GET['RType']))
            {
                include'includes/summary.php';
            }
            else
            {
                include'includes/RequestInfo.php';
            }
?> 
        
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 shift b">
        <h2>Client Requests</h2><hr class="bhr"/>
        <table class="table" id="cRequest">
            <thead>
                <th>Client Name</th>
                <th>Request Type</th>
                <th>Request Date</th>
                <th>Request for</th>
                <th>Status</th>
            </thead>
            <tbody>
                 <?= $allRequest; ?>
                 
            </tbody>
        </table>
    </div>
</div>
<?php include('includes/footer.php'); ?>
<script>
    $(document).ready(function(){
    $('table tbody tr').click(function()
    {
        window.location = $(this).attr('href');
        return false;
    });
});
</script>