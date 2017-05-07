\! echo "Indexing...\n";
CREATE fulltext index titreIndex on Oeuvre(Titre);
CREATE fulltext index nomIndex on Personne(Prenom,Nom);
CREATE index ontitre On Oeuvre(Titre);
CREATE index fullnameIndex On Personne(fullname);
