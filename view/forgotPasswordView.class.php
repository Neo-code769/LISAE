<?php

require_once 'lisaeTemplate.class.php';

class ForgotPasswordView extends LisaeTemplate {

    public function setBody($content) {
        
        echo <<<EOD

        <div id="title" class="container">
            <h2>Mot de passe oublié</h2>
        </div>
            <div id="connexion" class="container">
                <form method="post">
                    <fieldset>
                
                        <label for="email">E-mail:</label><br>
                        <input type="email" id="email" name="mail"><br><br>
                        <input id="button" type="submit" value="Renvoyer Mot de Passe">
                
                </fieldset><br>
                    <button id="button" value="Connexion"><a id="button" href="C:\wamp64\www\LISAE\index.php"> Connexion </a></button><br><br>
            </form>  
        </div>

        EOD;
    }

    public function sendMailPassword() {
        try{
            $mail= new PHPMailer\PHPMailer\PHPMailer();
        
            $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
            $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
            $mail->SMTPAuth = true; // Activer authentication SMTP
            $mail->Username = 'contact.afpa.lisae@gmail.com'; // Votre adresse email d'envoi
            $mail->Password = 'AR3n96f4aQ'; // Le mot de passe de cette adresse email
            $mail->SMTPSecure = 'ssl'; // Accepter SSL
            $mail->Port = 465; 
        
            $mail->setFrom('contact.afpa.lisae@gmail.com', 'AFPA LISAE');
            $mail->addAddress($_POST['mail']);  // Personnaliser l'adresse d'envoi  
            $mail->addReplyTo('contact.afpa.lisae@gmail.com', 'Information'); // L'adresse de réponse
            $mail->Subject = 'Confirmation de votre Mail - AFPA-LISAE';
        
            $mdp = new UserDao();
            $mdp->getPassword($_POST['mail']);
            $mail->Body = "Votre mot de passe est: <br><br>". ' '.$mpd; // Creation page: "LISAE/registration/confirm-registration"
            $mail->isHTML(true);
            $mail->setLanguage('fr');
        
            if ($mail->send()) {
                echo 'Confirmation Message has been sent.';
            }else {
                echo 'Message was not sent.<br>';
                echo 'Mailer error: ' . $mail->ErrorInfo; 
            }
        
        } catch (Exception $e) {
            var_dump($e->getLine());
            throw new LisaeException("ERROR" . $e->getLine());
        }
    }

}

?>