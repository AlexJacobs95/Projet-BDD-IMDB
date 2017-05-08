<!--
Jacobs Alexandre, Engelman David, Engelman Benjamin.
INFO-H-303 : Bases de données - Projet IMBD.
Page avec menu déroulant pour requetes prédéfinies.
-->

<div class="container text-center">
    <div class="col-lg-12 text-center">
        <h2 class="section-heading">Requêtes Prédéfinies</h2>
    </div>
        <form action="./search_results.php" method = "post">
            <select class="form-control" name ="requete" id="requete">
                <?php
                for ($i=1; $i < 7; $i++) {
                    echo "<option>Requete ".$i."</option>";
                }
                ?>
            </select>
            </br>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</div>

