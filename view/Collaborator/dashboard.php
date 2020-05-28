<body>

    <div class="titre">
        <h1>Tableau de Bord</h1>
    </div>

    <nav class="navigation">
        <div class="button">
            <h2>Activités par thémes</h2>
        </div>
        <div class="button">
            <h2>Calendrier ELOCE</h2>
        </div>
    </nav>

    <section class="list">
        <article>
            <h3>Mes Rendez-Vous</h3>
        <div>
        <table class="host">
            <caption>Liste des Rendez-Vous</caption>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Activité</th>
                        <th>Heure</th>
                    </tr>
                </thead>
            <tbody>
                <?php foreach($host as $host): ?>
                    <tr>
                        <td><a href="index.php?infoActivity<?= $host->getHostDate()?> <?$host->getActivityName() ?> <?= $host->getHostHour() ?>"> </a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        </div>
        </article>
    </section>

    <?php 
        /*$sql = "SELECT `host.slotDate`, `activity.name`, `host.slotHour` 
                FROM `activity` INNER JOIN `host` ON `activity.id_activity` = `host.id_activity`
                                INNER JOIN `users` ON `host.id_user` = `users.id_user` 
                WHERE `users.id_user` = `host.id_user` ";
        $exec = (Dao::getConnexion())->prepare($sql);
        try {
        $exec->execute();
        }
        catch (PDOException $e) {
            throw new LisaeException("Erreur", 1);
        }*/
    ?>