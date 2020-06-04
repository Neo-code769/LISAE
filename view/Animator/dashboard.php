    
    <div id="titre" class="container">
        <h2>Tableau de Bord</h2>
    </div>

    <nav class="navigation" class="container">
        <div class="button">
            <h2>Activités par thémes</h2>
        </div>
        <div class="button">
            <h2>Calendrier ELOCE</h2>
        </div>
    </nav>

    <?php


    ?>

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
                <?php /*foreach($slot as $slot): ?>
                    <tr>
                        <td><a href="index.php?infoActivity<?= $host->getSlotDate()?> <?$host->getActivityName() ?> <?= $host->getSlotHour() ?>"> </a></td>
                    </tr>
                <?php endforeach */?>
            </tbody>
        </table>
        </div>
        </article>
    </section>