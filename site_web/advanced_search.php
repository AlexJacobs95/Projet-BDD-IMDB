<div class="container text-center">

    <div class="col-lg-12 text-center">
        <h2 class="section-heading">Recherche avancée</h2>
    </div>

    <form action="search.php" name="search" id="searchForm" novalidate>

        <div class="form-group text-center">
            <input type="text" class="form-control" placeholder="Entrez le titre d'un film/série" name="film_serie">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Entrer le nom d'un acteur/actrice" name="acteur">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Entrez le nome d'une personne" name="producteur">
        </div>
        <div class="form-group">
            <input type="date" class="form-control" placeholder="Entrez une date entre 2000 et 2010 (jj/mm/yy)" name="date">
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 text-center">
            <div id="success"></div>
            <button type="submit" class="btn btn-xl">Rechercher</button>
        </div>
    </form>

</div>