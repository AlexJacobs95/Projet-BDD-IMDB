\! echo "Indexing...\n";
CREATE fulltext index titreIndex on Oeuvre(Titre);
CREATE fulltext index nomIndex on Personne(Prenom,Nom );
