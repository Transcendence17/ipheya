<?php
  // include('../logic.php');
  $logic = new Logic();
  $date = date("Y-m-d");
  
#general requests
    if(isset($_POST['Request-service']))
    {
      $service_id = sanitize($_POST['service']);
      // $service_id =$logic->getServiceIdByName($service);
      $description = mysqli_real_escape_string($db,$_POST['description']);
      $description = sanitize($description);
      $client_id = $logic->getClientIdByEmail($_SESSION['Client']);
      $client_name = $logic->getByEmail($_SESSION['Client'])['name'];
      $service_name = $logic->getServiceById($service_id)['service'];
      // die($service_name);
      // echo $service.$description.$user_id;
      if(empty($service_id))
      {
        $errors[] .= 'Please select service.';
      }
      if(!empty($errors))
      {
        $gr_display = display_errors($errors);
      }
      else
      {
        #remember due_date for live server
        $gr_query="INSERT INTO `servicerequest` (`RequestID`, `ClientID`, `ServiceID`, `Description`, `RequestDate`, `RequestStatus`, `SurveyingDate`, `Duration`, `Warrant`, `DueDate`, `RequestType`) 
        VALUES (NULL, {$client_id}, {$service_id}, '{$description}', '$date', 'unread', '$date', 0, 0, '$date', 'Service')";

       if(!mysqli_query($db,$gr_query))
       {
         die('Error'.mysqli_error($db)."\n $gr_query");
       }
       else
       {
         //make a notification
         $logic->notify($client_name,"Admin@gmail.com",$client_name." has requested for ".$service_name,"/ipheya/admin/clientrequest.php");
          header('Location: home.php');
          $_SESSION['message'] =" Hy there, Your request is being proccesed!!!<br/> We will call you back within 24 hrs.";
       }
      }
    }
#maintenance requests
    if(isset($_POST['Request-maintenance']))
    {
      $ServiceID = sanitize($_POST['maintenance']);
      $specify = mysqli_real_escape_string($db,$_POST['specify']);
      $specify = sanitize($specify);
      $frequency = mysqli_real_escape_string($db,$_POST['frequency']);
      $frequency = sanitize($frequency);
      $period = mysqli_real_escape_string($db,$_POST['period']);
      $period = sanitize($period);
      $description = mysqli_real_escape_string($db,$_POST['desc']);
      $description = sanitize($description);
      $user = sanitize($_SESSION['Client']);
      $user_id = $logic->getClientIdByEmail($user);
      if(empty($ServiceID))
      {
        $errors[] .= 'Please select service.';
      }
      if($ServiceID==0&&empty($specify))
      {
        $errors[] .= 'Please specify.';
      }
      if(empty($frequency))
      {
        $errors[] .= 'Please select frequency.';
      }
      if(empty($period))
      {
        $errors[] .= 'Please select period.';
      }
      if(!empty($errors))
      {
        $mr_display = display_errors($errors);
      }
      else
      {
        #remember for live server
        $mr_query = "INSERT INTO maintenancerequest(RequestID,ClientID,ServiceID,Description,RequestDate,RequestStatus,MaintenanceFrequency,MaintenancePeriod,EndDate,RequestType)
        VALUES(NULL,'{$user_id}',{$ServiceID},'{$description}',NOW(),'unread','{$frequency}',{$period},NOW(),'Maintenance')";
        if(!mysqli_query($db,$mr_query))
        {
          die('error'.mysqli_error($db));
        }
        header('Location: request.php');
      }
    }
?>