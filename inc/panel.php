<div class="p-container">
    <h1 class="p-main-title">
        Configuration du portfolio
    </h1>
    <form action="options.php" method="POST">

            <?php
                settings_fields( PLUGIN_SLUG );
                do_settings_sections( PLUGIN_SLUG );
                $dbLinker = new \PortfolioPlugin\DBLinker(P_AUTHOR_DATA, P_THEME_DATA);
                $dbLinker->updateAuthorData()
                         ->updateThemeData();
                $form = new \PortfolioPlugin\Form($dbLinker->getAuthorData(), $dbLinker->getThemeData());


            ?>
            <h2 class="p-sub-title">Définir les informations de l'auteur</h2>
            <div class="auth-head">
                <?php
                $form->generateAuthorInputs();
                ?>
            </div>
            <h2 class="p-sub-title">Définir les couleurs du thème</h2>
            <div>
                <?php
                    $form->generateThemeInput();
                ?>

            </div>
            

            <?php
                submit_button();
            ?>

    </form>

</div>
