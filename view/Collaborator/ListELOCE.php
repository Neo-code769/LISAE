
    <div id="title" class="container">
        <h1>Calendrier ELOCE</h1>
    </div>

    <nav id="navigation" class="container-fluid">
        <div>
            <button id="link">Thémes Activité</button>
        </div>
        <div>
            <button id="link" a href="">Tableau de Bord</button>
        </div>
    </nav>

    <h3>Liste des créneaux</h3>
    <section id="dashboard">
        <article>
            <div>
            <?php //echo $this->_themeList;?>
                <ul>
                    <?php echo $this->_eloce ?>
                </ul>
            </div>
        </article>
        <br><br><br><br><br><br><br><br><br><br>
    </section>
