<?php
abstract class LisaeTemplate {

    public function __construct() {

    }

    public function setHeader() {
        // Menu Bootstrap
        // Lien sur les thémes : index.php?galerie
        echo <<<EOD
        <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="LISAE" content="SoftWare Manage Registration to Activity ELOCE AFPA">
                    <meta name="author" content="Emma SCHURRER, Nathan LEBON, Pierre TRUBLEREAU">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="icon" type="image/x-icon" href="./images/favicon.ico" />
                    <link rel="stylesheet" href="/view/front-end/style.css" >
                    <title>LISAE - ELOCE</title>
                </head>
        EOD;
    }

    public function setFooter() {
        echo <<<EOD
            <footer> 
                <figure>
                <img src="images/AFPA.jpg" alt="logo AFPA" />
                </figure>
        
                <figure>
                <img src="images/LISAE.png" alt="logo LISAE" />
                </figure>
        
            </footer>
        EOD;
    }

    abstract public function setBody($content);

}