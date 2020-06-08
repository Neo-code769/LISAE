'use-strict';

    // Si on clique sur un button change le contenu du paragraphe

     /****** ACTIVITE *******/
     /****** Soft Skills *******/

    function confiance() {
        $('div#description').load('/view/Activity/confiance.html');
    };

    function mindmapping() {
        $('div#description').load('/view/Activity/mindmapping.html');
    };

    function gestionStress() {
        $('div#description').load('/view/Activity/stress.html');
    };

    function communication() {
        $('div#description').load('/view/Activity/communication.html');
    };

    function cognitive() {
        $('div#description').load('/view/Activity/cognitive.html');
    };

    function numerique() {
        $('div#description').load('/view/Activity/numerique.html');
    };

    $("#confiance").on("click",confiance);
    $("#mindmapping").on("click",mindmapping);
    $("#stress").on("click",gestionStress);
    $("#communication").on("click",communication);
    $("#cognitive").on("click",cognitive);
    $("#numerique").on("click",numerique);


    /****** JOB CIBLE *******/

    function profil() {
        $('div#description').load('/view/Activity/profil.html');
    };
    
    function recherche() {
        $('div#description').load('/view/Activity/recherche.html');
    };

    function reputation() {
        $('div#description').load('/view/Activity/reputation.html');
    };

    function CV() {
        $('div#description').load('/view/Activity/CV.html');
    };

    function motivation() {
        $('div#description').load('/view/Activity/motivation.html');
    };

    function entretien() {
        $('div#description').load('/view/Activity/entretien.html');
    };
    
    $("#profil").on("click",profil);    
    $("#recherche").on("click",recherche);
    $("#reputation").on("click",reputation);
    $("#CV").on("click",CV);
    $("#motivation").on("click",motivation);
    $("#entretien").on("click",entretien);
