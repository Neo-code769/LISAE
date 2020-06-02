<?php

    class confMail {

        public function confMail() {
            
            $id = (int) $_GET['id_user'];
            $token = (String) htmlentities($_GET['token']);

            if(!isset($id)){
                $valid = false;
                $err_mess = "Le lien est erroné";

            }elseif(!isset($token)){
                $valid = false;
                $err_mess = "Le lien est erroné";
            }

            if($valid){
            $req = $DB->query("SELECT id_user 
                FROM users 
                WHERE id_user = ? AND token = ?", array($id_user, $token));
            $req = $req->fetch();
            

                if(!isset($req['id_user'])){
                    $valid = false;
                    $err_mess = "Le lien est erroné";
                } else {
                    $DB->insert("UPDATE users SET token = NULL, confirmation_token = ? WHERE id_user = ?", array(date('Y-m-d H:i:s'), $req['id_user']));

                    $info_mess = "Votre compte a bien été validé";
                }
            }
        }
    }
?>
