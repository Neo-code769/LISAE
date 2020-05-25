<?php

class Controller{

    public function run()
    {
        //TODO TEST
        //$act1 = new Activity("Atelier CV", "hey", "heyyyy", 2, 3, "3 jours avant", "2 jours avant");
        //echo($act1->getName());

        //var_dump($_GET['action']);

        if(isset($_GET['action'])){
            switch ($_GET['action']) {
                case 'registrationCollab':
                    include 'view/registrationCollab.phtml';
                break;

                case 'registrationAnim':
                    include 'view/registrationAnim.phtml';

                break;

                default:
                    include 'view/loginPage.phtml';
                    break;
            }
        }else{
            include 'view/loginPage.phtml';
        }
        
    }

}
