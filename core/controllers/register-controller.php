<?php
    // Your Account SID and Auth Token from twilio.com/console
    use Twilio\Rest\Client;
    if(isset($_POST['Register']))
    {
      session_start();
      $name = mysqli_real_escape_string($db, $_POST['name']);
      $name = sanitize($name);
      $surname = mysqli_real_escape_string($db, $_POST['surname']);
      $surname = sanitize($surname);
      $email = mysqli_real_escape_string($db, $_POST['email']);
      $email = sanitize($email);
      $postal = mysqli_real_escape_string($db, $_POST['postal']);
      $postal = sanitize($postal);
      $number = mysqli_real_escape_string($db, $_POST['number']);
      $number = sanitize($number);
      $password = mysqli_real_escape_string($db, $_POST['password']);
      $password = sanitize($password);
      $province = $account = $token = 'default';

      #check if any required fields are empty
      if(empty($name))
      {
        $errors[] .= 'Name is required.';
      }
      if(empty($surname))
      {
        $errors[] .= 'Surname is required.';
      }
      if(empty($email))
      {
        $errors[] .= 'Email is required.';
      }
      if(empty($postal))
      {
        $errors[] .= 'Postal is required.';
      }
      if(empty($number))
      {
        $errors[] .= 'Number is required.';
      }
      if(empty($password))
      {
        $errors[] .= 'Password is required.';
      }
      if(!empty($errors))
      {
        $displayR = display_errors($errors);
      }

	    $check_existing_user = "SELECT * FROM users WHERE email = '$email'";
      $check_existing_exe = mysqli_query($db,$check_existing_user);
      $count = mysqli_num_rows($check_existing_exe);

	    if($count>0)
      {
        $errors[] .= 'The email you entered already belongs to a user.';
      }
      else
      {
        #generating unique client number
        $date = date('Y-m-d');//we take a date
        $client_unique = uniqid();//generate unique id
        $client_no ="C".substr($date,2,2).substr($date,0,2).strtoupper(substr($client_unique,4,4));//create new client no by date and unique values by miniseconds

        $insert_c = "INSERT INTO clients(client_no,name,surname,email,postal_address,contact_number,account,archived,token)
                                VALUES('$client_no','$name','$surname','$email','$postal','$number','$account',0,'$token')";
        $adduser = mysqli_query($db,$insert_c);
        if($adduser)
        {
          #hashing a password
            $password = password_hash($password, PASSWORD_DEFAULT);
            $addtoUsers="INSERT INTO users VALUES(NULL,'$email','$email',true,'$password')";
            if(!mysqli_query($db,$addtoUsers))
            {
              die("Error Users".mysqli_error($db));
            }
             $UserID = mysqli_insert_id($db);
            if(!mysqli_query($db,"INSERT INTO userroles VALUES(2,$UserID)"))
            {
              die("Error RolesU".mysqli_error($db));
            }
            echo '<script>alert("'.$adduser.'");</script>';
            header('Location:login.php');
        }
        else{
          echo '<script>alert("'.mysqli_error($db).'");</script>';
        }

      }
    }
?>
