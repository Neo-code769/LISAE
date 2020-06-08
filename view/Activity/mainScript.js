'use-strict';

    // Si on clique sur un button change le contenu du paragraphe

    /****** THEMES *******/

    function softSkill() {
        $('div#theme').load('softskill.php');
    };

    function jobCible() {
        $('div#theme').load('jobcible.php');
    };

    function conference() {
        $('div#theme').load('conference.php');
    };

    $("#SS").on("click",softSkill);
    $("#JC").on("click",jobCible);
    $("#CONF").on("click",conference);

     /****** ACTIVITE *******/
     /****** Soft Skills *******/

    function confiance() {
        $('div#activitySS').load('confiance.php');
    };

    function mindmapping() {
        $('div#activitySS').load('mindmapping.php');
    };

    function gestionStress() {
        $('div#activitySS').load('stress.php');
    };

    function communication() {
        $('div#activitySS').load('communication.php');
    };

    function cognitive() {
        $('div#activitySS').load('cognitive.php');
    };

    function numerique() {
        $('div#activitySS').load('numerique.php');
    };

    $("#confiance").on("click",confiance);
    $("#mindmapping").on("click",mindmapping);
    $("#stress").on("click",gestionStress);
    $("#communication").on("click",communication);
    $("#cognitive").on("click",cognitive);
    $("#numerique").on("click",numerique);


    /****** JOB CIBLE *******/

    function profil() {
        $('div#activityJC').load('profil.php');
    };
    
    function recherche() {
        $('div#activityJC').load('recherche.php');
    };

    function reputation() {
        $('div#activityJC').load('reputation.php');
    };

    function CV() {
        $('div#activityJC').load('CV.php');
    };

    function motivation() {
        $('div#activityJC').load('motivation.php');
    };

    function entretien() {
        $('div#activityJC').load('entretien.php');
    };
    
    $("#profil").on("click",profil);    
    $("#recherche").on("click",recherche);
    $("#reputation").on("click",reputation);
    $("#CV").on("click",CV);
    $("#motivation").on("click",motivation);
    $("#entretien").on("click",entretien);

