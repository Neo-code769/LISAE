'use-strict';

    // Si on clique sur un button change le contenu du paragraphe

    /****** THEMES *******/

    function softSkill() {
        $('div#theme').load('/view/Activity/softskill.html');
    };

    function jobCible() {
        $('div#theme').load('/view/Activity/jobcible.php');
    };

    $("#SS").on("click",softSkill);
    $("#JC").on("click",jobCible);

     /****** ACTIVITE *******/
     /****** Soft Skills *******/

    function confiance() {
        $('div#activitySS').load('/view/Activity/confiance.php');
    };

    function mindmapping() {
        $('div#activitySS').load('/view/Activity/mindmapping.php');
    };

    function gestionStress() {
        $('div#activitySS').load('/view/Activity/stress.php');
    };

    function communication() {
        $('#activitySS').load('/view/Activity/communication.php');
    };

    function cognitive() {
        $('div#activitySS').load('/view/Activity/cognitive.php');
    };

    function numerique() {
        $('div#activitySS').load('/view/Activity/numerique.php');
    };

    $("#confiance").on("click",confiance);
    $("#mindmapping").on("click",mindmapping);
    $("#stress").on("click",gestionStress);
    $("#communication").on("click",communication);
    $("#cognitive").on("click",cognitive);
    $("#numerique").on("click",numerique);


    /****** JOB CIBLE *******/

    function profil() {
        $('div#activityJC').load('/view/Activity/profil.php');
    };
    
    function recherche() {
        $('div#activityJC').load('/view/Activity/recherche.php');
    };

    function reputation() {
        $('div#activityJC').load('/view/Activity/reputation.php');
    };

    function CV() {
        $('div#activityJC').load('/view/Activity/CV.php');
    };

    function motivation() {
        $('div#activityJC').load('/view/Activity/motivation.php');
    };

    function entretien() {
        $('div#activityJC').load('/view/Activity/entretien.php');
    };
    
    $("#profil").on("click",profil);    
    $("#recherche").on("click",recherche);
    $("#reputation").on("click",reputation);
    $("#CV").on("click",CV);
    $("#motivation").on("click",motivation);
    $("#entretien").on("click",entretien);
