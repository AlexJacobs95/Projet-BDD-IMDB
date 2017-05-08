<section id="Resume" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center" id=resume_block>
                <h2 class="section-heading" id="resume-title">Résumé</h2>
                <div class="content hideContent-plot" id="plot"><span> <?php echo $plot ?> </span></div>

            </div>
        </div>
    </div>
</section>

<section id="Acteurs" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center" id="actors">
                <h2 class="section-heading" id="actor-title">Acteurs</h2>
                <?php
                echo "<table border=1 frame=void rules=rows id = \"actors_table\">";

                while ($actors_row = mysqli_fetch_array($roles)) {
                    $fn = $actors_row['Prenom'];
                    $ln = $actors_row['Nom'];
                    $num = $actors_row['Numero'];
                    $role = $actors_row['Role'];
                    $nom = sprintf('%s %s', $fn, $ln);
                    echo "<tr>";
                    echo "<td >";
                    echo '<a href="personne.php?id=' . urlencode($fn . ';' . $ln . ';' . $num) . '">' . $nom . '</a>';
                    echo "</td>";
                    echo "<td >" . $role . "</td></tr>";
                    //echo '<a href="film.php?id='.urlencode($actors_row['Prenom']).'">'.$actors_row['ID'].'</a>';
                }
                echo "</table>";
                ?>
            </div>
        </div>
    </div>
</section>


<section id="Directeurs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" id="director-title">Directeurs</h2>
            </div>
        </div>

        <?php
        echo "<table class='directorsAndWriters' border=1 frame=void rules=rows>";

        while ($directors_row = mysqli_fetch_array($directors)) {
            $fn = $directors_row['Prenom'];
            $ln = $directors_row['Nom'];
            $num = $directors_row['Numero'];
            $nom = sprintf('%s %s', $fn, $ln); //prenom + nom
            echo "<tr>";
            echo "<td >";
            echo '<a href="personne.php?id=' . urlencode($fn . ';' . $ln . ';' . $num) . '">' . $nom . '</a>';
            echo "</td>";
            echo "</tr>";
            //echo '<a href="film.php?id='.urlencode($actors_row['Prenom']).'">'.$actors_row['ID'].'</a>';
        }
        echo "</table>";
        ?>
    </div>
</section>

<section id="Auteurs" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" id="writer-title">Auteurs</h2>
            </div>
        </div>

        <?php
        echo "<table class='directorsAndWriters' >";

        while ($writers_row = mysqli_fetch_array($writers)) {
            $fn = $writers_row['Prenom'];
            $ln = $writers_row['Nom'];
            $num = $writers_row['Numero'];
            $nom = sprintf('%s %s', $fn, $ln); //prenom + nom
            echo "<tr>";
            echo "<td >";
            echo '<a href="personne.php?id=' . urlencode($fn . ';' . $ln . ';' . $num) . '">' . $nom . '</a>';
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</section>

<section id="Details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading" id="detail-title">Détails</h2>
            </div>
        </div>
        <div id="div_1">
            <div class="details-member">
                <h3><?php echo "Pays"; ?></h3>
                <h4><?php extractCoutries($pays) ?></h4>
            </div>
        </div>

        <div id="div_2">
            <div class="details-member">
                <h3><?php echo "Langues"; ?></h3>
                <h4><?php extractLanguages($languages) ?></h4>
            </div>
        </div>

    </div>
</section>

<?php
include "popUpForm.php";
?>

