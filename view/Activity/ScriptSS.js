'use-strict';

    // Si on clique sur un button change le contenu du paragraphe

     /****** ACTIVITE *******/
     /****** Soft Skills *******/

    function apprendre() {
        $('div#descriptionSS').load('/view/Activity/softskill/apprendre.html');
    };

    function memoire() {
        $('div#descriptionSS').load('/view/Activity/softskill/memoire.html');
    };

    function confiance() {
        $('div#descriptionSS').load('/view/Activity/softskill/confiance.html');
    };

    function mindmapping() {
        $('div#descriptionSS').load('/view/Activity/softskill/mindmapping.html');
    };

    function mindmapping2() {
        $('div#descriptionSS').load('/view/Activity/softskill/mindmapping2.html');
    };

    function mindmapping3() {
        $('div#descriptionSS').load('/view/Activity/softskill/mindmapping3.html');
    };

    function mindmapping4() {
        $('div#descriptionSS').load('/view/Activity/softskill/mindmapping4.html');
    };

    function mindmapping5() {
        $('div#descriptionSS').load('/view/Activity/softskill/mindmapping5.html');
    };

    function parole() {
        $('div#descriptionSS').load('/view/Activity/softskill/prisedeparole.html');
    };

    function parole2() {
        $('div#descriptionSS').load('/view/Activity/softskill/prisedeparole2.html');
    };

    function gestionStress() {
        $('div#descriptionSS').load('/view/Activity/softskill/stress.html');
    };

    function gestionStress2() {
        $('div#descriptionSS').load('/view/Activity/softskill/stress2.html');
    };

    function empathie() {
        $('div#descriptionSS').load('/view/Activity/softskill/empathie.html');
    };

    function communication() {
        $('div#descriptionSS').load('/view/Activity/softskill/communication.html');
    };

    function communication2() {
        $('div#descriptionSS').load('/view/Activity/softskill/communication2.html');
    };

    function comportement() {
        $('div#descriptionSS').load('/view/Activity/softskill/comportement.html');
    };

    function image() {
        $('div#descriptionSS').load('/view/Activity/softskill/image.html');
    };

    function cognitive() {
        $('div#descriptionSS').load('/view/Activity/softskill/cognitive.html');
    };

    $('div#descriptionSS').load('/view/Activity/softskill/softskill.html')
    $("#apprendre").on("click",apprendre);
    $("#memoire").on("click",memoire);
    $("#confiance").on("click",confiance);
    $("#mindmapping").on("click",mindmapping);
    $("#mindmapping2").on("click",mindmapping2);
    $("#mindmapping3").on("click",mindmapping3);
    $("#mindmapping4").on("click",mindmapping4);
    $("#mindmapping5").on("click",mindmapping5);
    $("#parole").on("click",parole);
    $("#parole2").on("click",parole2);
    $("#stress").on("click",gestionStress);
    $("#stress2").on("click",gestionStress2);
    $("#empathie").on("click",empathie);
    $("#communication").on("click",communication);
    $("#communication2").on("click",communication2);
    $("#comportement").on("click",comportement);
    $("#image").on("click",image);
    $("#cognitive").on("click",cognitive);
