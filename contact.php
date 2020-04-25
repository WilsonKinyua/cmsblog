    <?php include "includes/db.php"; ?>
    <?php include "includes/header.php"; ?>



    <?php include "includes/nav.php"; ?>

<?php




if(isset($_POST['submit'])){

$to                 = "wilsonkinyuam@gmail.com";
$subject            = wordwrap($_POST['subject'],70);
$phone              = $_POST['phone'];
$body               = $_POST['body'];
$header             = "From: ". $_POST['email'];


mail($to,$subject,$phone,$body,$header);

// cleaning the data before going to the database
if(!empty($subject)&& !empty($phone) && !empty($body) ){


$message = "<div class='alert alert-success' role='alert'>Your Message has been submitted and I will get back to you as soon as possible.</div>";

}else{
$message = "<div class='alert alert-danger' role='alert'>Fields Cannot be empty.</div>";

}

}else{

$message = "";

}



?>

        <!-- Page Content -->
        <div class="container">

        <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">

                    <div class="form-wrap">
                    <h1>Contact Me</h1>
                        <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                            <h5 class="text_center"><?php echo $message; ?></h5>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                                </div>


                                    <div class="form-group">
                                    <label for="subject" >Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Say hae">
                                    </div>
                                    <div class="form-group">
                                    <label for="phone" >Phone Number</label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="+254717255460">
                                    </div>
                                    <div class="form-group">
                                    <label for="body" >Message</label>
                                    <textarea name="body" id="body" class="form-control" cols="30" rows="10" placeholder="Hae ...."></textarea>
                                    </div>
                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                        </form>
                    
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

            <hr>

        <?php include "includes/footer.php"; ?>