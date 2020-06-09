'use-strict';

    // Si on clique sur un button change le contenu du paragraphe

     /****** ACTIVITE *******/
    /****** JOB CIBLE *******/
    
        function profil() {
            $('div#description').load('/view/Activity/jobcible/profil.html');
        };
        
        function recherche() {
            $('div#description').load('/view/Activity/jobcible/recherche.html');
        };
    
        function reputation() {
            $('div#description').load('/view/Activity/jobcible/reputation.html');
        };
    
        function CV() {
            $('div#description').load('/view/Activity/jobcible/cv.html');
        };
    
        function motivation() {
            $('div#description').load('/view/Activity/jobcible/motivation.html');
        };
    
        function entretien() {
            $('div#description').load('/view/Activity/jobcible/entretien.html');
        };
        
        $("#description").load('/view/Activity/jobcible/jobcible.html'); 
        $("#profil").on("click",profil);    
        $("#recherche").on("click",recherche);
        $("#reputation").on("click",reputation);
        $("#CV").on("click",CV);
        $("#motivation").on("click",motivation);
        $("#entretien").on("click",entretien);