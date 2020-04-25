<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "functions.php"; ?>

<?php


    require "./vendor/autoload.php";
    

//=================== to avoid users from being there if they don't have the unique key from the get request form the login form

    if(!isset($_GET['forgot'])){

        header("Location: index.php");

    }


    if(IsItMethod('post')){

            if(isset($_POST['email'])){

                $email = $_POST['email'];
                $length = 50;

                $token = bin2hex(openssl_random_pseudo_bytes($length));

                if(email_exists($email)){

                if($stmt = mysqli_prepare($connection, "UPDATE users SET token = '{$token}' WHERE user_email = ?")){

                    mysqli_stmt_bind_param($stmt,"s", $email);
                    mysqli_stmt_execute($stmt);


                    // ===============================================   config PHPMailer


                   $mail = new PHPMailer(true);
               
                   $mail->isSMTP();                                            // Send using SMTP
                   $mail->Host       = 'smtp.mailtrap.io';                    // Set the SMTP server to send through
                   $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                   $mail->Username   = '549d224ecba2cc';                     // SMTP username
                   $mail->Password   = 'a1d26c076e3a3b';                               // SMTP password
                   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                   $mail->Port       = 2525;   

                   $mail->setFrom('wilsonkinyuam@gmail.com', 'Wilson Kinyua');
                   $mail->addAddress('wilsonkinyuam@gmail.com', 'Guru Wilson');         // Name is optional

                   $mail->isHTML(true);                                  // Set email format to HTML
                   $mail->Subject = 'Password reset';
                   $mail->Body    = '<p>Please click here to reset your password:
                   
                   <a href="http://localhost/cms/reset.php?email='.$email.'&token='.$token.' ">http://localhost/cms/reset.php?email='.$email.'&token='.$token.' </a>
                   
                   
                   </p>
                
                   ';

                   if($mail->send()){

                    $emailSent = true;

                } else{

                    echo "NOT SENT";

                }

               




                }
                }

            }

    }


?>

                    


<?php  include "includes/nav.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                    <?php if(!isset($emailSent)): ?>

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">
                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                            <h4><?php //echo $message; ?></h4>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                                    <?php else: ?>
                                    <h1>Please check your email</h1>
                                <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

