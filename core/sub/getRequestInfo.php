<?php
include('../logic.php');
$logic=new Logic();

if(isset ($_GET['ri']))
{
   $type = $_GET['RType'];
   $cid = $_GET['ci'];
   $rid = $_GET['ri'];
   $clientQR = $logic->getClientsById($cid);
   $client=mysqli_fetch_assoc($clientQR);
   $request = null;
   $a ="";
   $table ='';
   $height='';
   if($type =='Service')
   {
       #if its a service request it search information from service request table from database...
       $request =$logic->getServiceRequestById($rid);
       $Rrequest = mysqli_fetch_assoc($request);
       $table ='servicerequest';
   }
   else if($type =='Maintanance')
   {
       #if its a maintanance request it search information from maintanance request table from database...
       $request =$logic->getMaintananceRequestById($rid);#mysli result
       $Rrequest =mysqli_fetch_assoc($request);
       $table ='maintenancerequest';
   }
   else if($type =='Repair')
   {
       #if they requestered for repair it search information from repair  table from database...
       $request =$logic->getRepairRequestById($rid);#mysli result
       $Rrequest =mysqli_fetch_assoc($request);
       $table ='repairrequest';

   }
   else
   {
       #if its a search for survey it search information from survey request request table from database...
       $request =$logic->getSurveyRequestById($rid);#mysli result
       $Rrequest =mysqli_fetch_assoc($request);
       $table ='technicalobservation';

   }

   $id = $Rrequest["RequestID"];
   $cid = $Rrequest['ClientID'];
   $obsevation = $logic->viewOTask($id,$type);
   $employee = $logic ->getByEById($obsevation['employee_id']);
   $taskInfor='';
   if($Rrequest['RequestStatus'] == 'unread'|| $Rrequest['RequestStatus'] == 'readed' )
   {
        $a ='<a href="obsevation.php?ci='.$_GET['ci'].'&ri='.$_GET['ri'].'&type='.$_GET['RType'].'" class="btn btn-default"><span class="fa fa-eye-open"></span> Send Surveyor</a>
        ';
        $result=$logic->updateStatus('readed',$rid,$table);
        $height ='250px';

   }
   else if($Rrequest['RequestStatus'] == 'observed')
   {
     $a =' <a href="viewobservation.php?id='.$obsevation['task_id'].'" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> View Observation</a>
     <a href="quotation.php?id='.$id.'&Type='.$_GET['RType'].'&cid='.$_GET['ci'].'" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Create Qoute</a>
     ';
     $height='450px';
     $taskInfor ='<div class ="col-xs-12">
                    <h4 style="color:#70747a"><span class="fa fa-clock-o"></span><b> Obsevation Details</b></h4>
                    <hr class="bhr"/>
                    <div class="col-xs-12">
                    <div class="col-xs-6">
                      <table>
                        <tr><td><b>Employee Name</b></td><td>: '.$employee['name'].'<td></tr>
                        <tr><td><b>Email</b></td><td>: '.$employee['email'].'<td></tr>
                        <tr><td><b>Assigned date</b></td><td>: '.date_format(date_create($obsevation['s_date']),'d F Y-l').'<td></tr>
                        <tr><td><b>Job Status </b></td><td>: '.$obsevation['status'].'<td></tr>
                      </table>
                    </div>
                    <div class="col-xs-3">

                   <div class="panel panel-default">
                        <div class="panel-heading"><b>Job Progress '.$obsevation['complete'].'%</b></div>
                    </div>

                    </div>
                    </div>
                </div>';
   }
   else
   {
     $a='<a href="viewobservation.php?id='.$obsevation['task_id'].'" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> View job process</a>
     ';
     $height='450px';
     $taskInfor ='<div class ="col-xs-12">
                    <hr class="bhr"/>
                    <h4 style="color:#70747a"><span class="fa fa-clock-o"></span><b> Obsevation Details</b></h4>
                    <hr class="bhr"/>
                    <div class="col-xs-12">
                    <div class="col-xs-6">
                        <table>
                            <tr><td><b>Employee Name</b></td><td>: '.$employee['name'].'<td></tr>
                            <tr><td><b>Email</b></td><td>: '.$employee['email'].'<td></tr>
                            <tr><td><b>Assigned date</b></td><td>: '.date_format(date_create($obsevation['s_date']),'d F Y-l').'<td></tr>
                            <tr><td><b>Job Status </b></td><td>: '.$obsevation['status'].'<td></tr>
                        </table>
                    </div>
                    <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Job Progress :'.$obsevation['complete'].'%</b></div>
                    </div>
                    </div>
                    </div>
                    </div>';
   }
   $client_name = substr($client['name'],0,1).' '.$client['surname'];
$data='<div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h2 class="modal-title text-center" style="color:#888">Request Information</h2>
        </div>

        <div class="modal-body" style="min-height:'.$height.';">
         <div class="col-xs-12">
           <div class="col-xs-6">
            <h4 style="color:#70747a"><span class="fa fa-user"></span><b>  Client Information</b></h4>
            <hr class="bhr"/>
            <div class="col-xs-12">
                <table>
                    <tr><td><b>Initials & Surname</b></td><td>: '.$client_name.'<td></tr>
                    <tr><td><b>Cell</b></td><td>: '.$client['contact_number'].'<td></tr>
                    <tr><td><b>Email</b></td><td>: '.$client['email'].'<td></tr>
                    <tr><td colspan=2><br></td></tr>
                    <tr><td colspan=2><i><a href="viewclient.php?view='.$_GET['ci'].'" >View this client?</a></i><td></tr>
                </table>
            </div>
           </div>
           <div class ="col-xs-6">
               <h4 style="color:#70747a"><span class="fa fa-cog"></span><b> '.$_GET['RType'].' Information</b></h4>
               <hr class="bhr"/>
               <div class="col-xs-12">
                Requested '.$_GET['RType'].' for '.$logic->getServiceNameByID($Rrequest['ServiceID']).' on '.date_format(date_create($Rrequest['RequestDate']),"l d F Y").'<br/>
                Request description: <br/>
                <textarea rows="3" cols="60" class="form-control" readonly>'.$Rrequest['Description'].' </textarea><br/>
               </div>
           </div>
           '.$taskInfor.'
       </div>
      </div>
   <div class="modal-footer">
   <div class="col-xs-12">
    <div class="col-xs-10" style="text-align:left">
    '.$a.'
    </div>
    </div>
   </div>';
   echo $data;
}
?>
