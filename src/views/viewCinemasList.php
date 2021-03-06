<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestion des cinémas - Cinémas</title>
        <link type="text/css" href="css/cinema.css" rel="stylesheet"/>
    </head>
    <body>
        <header><h1>Liste des cinémas</h1></header>
        <table class="std">
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th colspan="3">Action</th>
            </tr>
            <?php
            // on récupère la liste des cinémas ainsi que leurs informations
            $cinemas = $managers['cinema']->getCinemasList();
            // boucle de construction de la liste des cinémas
            foreach ($cinemas as $cinema) {
                ?>
                <tr>
                    <td><?= $cinema['DENOMINATION'] ?></td>
                    <td><?= $cinema['ADRESSE'] ?></td>
                    <td>
                        <form name="cinemaShowtimes" action="cinemaShowtimes.php" method="GET">
                            <input name="cinemaID" type="hidden" value="<?= $cinema['CINEMAID'] ?>"/>
                            <input type="submit" value="Consulter les séances"/>
                        </form>
                    </td>
                    <?php
                    if ($isUserAdmin):
                        ?>
                        <td>
                            <form name="modifyCinema" action="editCinema.php" method="GET">
                                <input type="hidden" name="cinemaID" value="<?= $cinema['CINEMAID'] ?>"/>
                                <input type="image" src="images/modifyIcon.png" alt="Modify"/>
                            </form>
                        </td>
                        <td>
                            <form name="deleteCinema" action="deleteCinema.php" method="POST">
                                <input type="hidden" name="cinemaID" value="<?= $cinema['CINEMAID'] ?>"/>
                                <input type="image" src="images/deleteIcon.png" alt="Delete"/>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php
            }
            if ($isUserAdmin):
                ?>
                <tr class="new">
                    <td colspan="5">
                        <form name="addCinema" action="editCinema.php">
                            <button class="add" type="submit">Cliquer ici pour ajouter un cinéma</button>
                        </form>
                    </td>
                </tr>

            <?php endif; ?>
        </table>

        <form name="backToMainPage" action="index.php">
            <input type="submit" value="Retour à l'accueil"/>
        </form>
    </body>
</html>
