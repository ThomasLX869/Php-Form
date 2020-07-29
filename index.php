<?php
    $firstname = $name = $email = $phone = $message = "";
    $firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
    $isSuccess = false;
    $emailTo = "thomas.lescieux@live.fr";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $firstname = verifyInput($_POST["firstname"]);
        $name = verifyInput($_POST["name"]);
        $email = verifyInput($_POST["email"]);
        $phone = verifyInput($_POST["phone"]);
        $message = verifyInput($_POST["message"]);
        $isSuccess =true;
        $emailText = "";

        if(empty($firstname)){
            $firstnameError ="Insérez votre prénom !";
            $isSuccess = false;
        }else{
            $emailText .= "Firstname : $firstname\n";
        }

        if(empty($name)){
            $nameError ="Insérez votre nom !";
            $isSuccess = false;
        }else{
            $emailText .= "Name : $name\n";
        }

        if(!isEmail($email)){
            $emailError = "Ce n'est pas un e-mail valide !";
            $isSuccess = false;
        }else{
            $emailText .= "Email : $email\n";
        }

        if(!isPhone($phone)){
            $phoneError = "Ce n'est pas un téléphone valide !";
            $isSuccess = false;
        }else{
            $emailText .= "Phone : $phone\n";
        }

        if(empty($message)){
            $messageError ="Insérez votre message !";
            $isSuccess = false;
        }else{
            $emailText .= "Message : $message\n";
        }

        if($isSuccess){
            $headers = "From: $firstname $name <email> \r\nReply-To: $email";
            mail($emailTo, "Un message de votre site ", $emailText , $headers);
            $firstname = $name = $email = $phone = $message = "";
        }
    }

    function isEmail($var){
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function isPhone($var){
        return preg_match("/^[0-9 ]*$/", $var);
    }

    function verifyInput($var){
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Contactez-moi</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="witdh=device-width, initial-scale=1"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <link rel ="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class ="container">
            <div class="divider"></div>
            <div class="heading">
                <h2>Contactez-moi</h2>
            </div>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                        <div class="row">

                            <div class="col-md-6">
                                <label for="firstname">Prénom<span class="blue"> *</span></label>
                                <input type = "text" id="firstname" name="firstname" required class="form-control" placeholder="Votre prénom" value="<?php echo $firstname;?>">

                                <p class="comments"><?php echo $firstnameError; ?></p>
                            </div>


                            <div class="col-md-6">
                                <label for="name">Nom<span class="blue"> *</span></label>
                                <input type = "text" id="name" name="name" required class="form-control" placeholder="Votre nom" value="<?php echo $name;?>">
                                <p class="comments"><?php echo $nameError; ?></p></p>
                            </div>

                            <div class="col-md-6">
                                <label for="email">Email<span class="blue"> *</span></label>
                                <input type = "email" id="email" name="email" required class="form-control" placeholder="Votre Email" value="<?php echo $email;?>">
                                <p class="comments"><?php echo $emailError; ?></p></p>
                            </div>

                            <div class="col-md-6">
                                <label for="phone">Téléphone</label>
                                <input type = "tel" id="phone" name="phone" class="form-control" placeholder="Votre téléphone" value="<?php echo $phone;?>">
                                <p class="comments"><?php echo $phoneError; ?></p></p>
                            </div>

                            <div class="col-md-12">
                                <label for="message">Message<span class="blue"> *</span></label>
                                <textarea id="message" name="message" required class="form-control" placeholder="Votre message" rows="4"><?php echo $message; ?></textarea> 
                                <p class="comments"><?php echo $messageError; ?></p></p>
                            </div>

                            <div class="col-md-12">
                                <p class="blue"><strong>* Ces informations sont requises</strong></p>
                            </div>

                            <div class="col-md-12">
                                <input type="submit" class="button1" value="Envoyer">
                            </div>

                        </div>

                        <p class="thank-you" style="display: <?php if($isSuccess) echo 'block'; else echo 'none';?>">Votre message a bien été envoyé. Merci de m'avoir contacté.</p>

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>