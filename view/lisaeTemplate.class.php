<?php
abstract class LisaeTemplate {

    public function __construct() {

    }

    public function run($content, $errorMess="") {
        $this->setHeader($errorMess);
        $this->setBody($content);
        $this->setFooter();
    }

    public function setHeader($errorMess="") {
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
                    <title>LISAE - ELOCE</title>
                </head>
                <header>
                    <div id="headerIMG">
                        <figure>
                            <img src="/images/header-logo.png" alt="logo AFPA-ELOCE" />
                            <img src="/images/LISAE.png" alt="logo LISAE" />
                        </figure>
                    </div>
                    <figure>
                        <img src="/images/Life-line.png" alt="Ligne de Vie" />
                    </figure>
                </header>
                <body>
                <p>$errorMess<p> 
        EOD;
    }

    public function setFooter() {
        echo <<<EOD
            <footer> 
                <figure>
                    <img src="/images/AFPA.jpg" alt="logo AFPA" />
                    <img src="/images/ELOCE.png" alt="logo ELOCE" />
                    <img src="/images/LISAE.png" alt="logo LISAE" />
                </figure>
            </footer>
        </body>
        EOD;
    }

    abstract public function setBody($content);

}