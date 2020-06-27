<?php
abstract class LisaeTemplate {

    public function __construct() {

    }

    public function run($content, $errorMess="") {
        $this->setHead();
        $this->setHeader($errorMess);
        $this->setBody($content);
        $this->setFooter();
    }

    public function setHead() {
        echo <<<EOD
        <!DOCTYPE html >
            <html leng="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="LISAE" content="SoftWare Manage Registration to Activity ELOCE AFPA">
                    <meta name="author" content="Emma SCHURRER, Nathan LEBON, Pierre TRUBLEREAU">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
                    <link rel="stylesheet" href="/view/Front-end/style.css" >
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 
                    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
                    <title>LISAE</title>
                </head>
        EOD;
    }

    public function setFooter() {
        echo <<<EOD
            <footer> 
                <figure id="figure">
                    <img src="/images/AFPA.jpg" alt="logo AFPA" />
                    <img src="/images/ELOCE.png" alt="logo ELOCE" />
                    <img src="/images/AFPA.jpg" alt="logo AFPA" />
                </figure>
                <p style='font-size:75%;text-align:center;'>© Lisae - Emma SCHURRER, Nathan LEBON, Pierre TRUBLEREAU </p>
            </footer>
        </body>
        EOD;
    }

    abstract public function setBody($content);

    abstract public function setHeader($errorMess);

}