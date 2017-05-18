\! echo "Indexing...\n";
CREATE fulltext index titreIndex on Oeuvre(Titre);
CREATE fulltext index nomIndex on Personne(Prenom,Nom);
CREATE index ontitre On Oeuvre(Titre);
CREATE index fullnameIndex On Personne(fullname);
CREATE index langue_index on Langue(Langue);
CREATE index index_genre on Genre(Genre);
CREATE index pays_index on Pays(Pays);

CREATE fulltext index nomRoleIndex on Role(Prenom,Nom);
CREATE fulltext index nomEcritParIndex on EcritPar(Prenom,Nom);
CREATE fulltext index nomDirigeParIndex on DirigePar(Prenom,Nom);
