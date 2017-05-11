<?php

$close = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAACzUlEQVRYhaXXS2tVVxQH8F8SxUdicKSTlhbrq45E8QPopKXORE189sOIpS8fnVTUtlJEqB9CRCotSkUsQjsQX+2gGnTWaEzS28G+F0/W2fvk3JsFCy57/9f6r/36n3Vpb+M4gou4jSnMdP05buE8JrGmj7yL2lb8gNfotPTpbqGbl0I8irOY64M4+iy+xqp+ybfijyUQR7+PTW3Jd+FFIdEDnMBurMNI19djD07iYSF2CjsXI/+wQP4A+zDcYgEjOIhHhSKK92IUf2aCLmF1C+JoY7icyXe/lO+bDPgzDA1A3rMhfJXJeyoCt6nf9ksZ8jZHEDFDuBJyz2JLFfSj+pnHbRrHzzjUQH4UN9SFaAyPA8f3vcm1kppVJ/dlyH/tzs0XijjanevgZqaIycDxqpvXcfXVV7dxWFp5FTOPwwXynl+38AhH1F/GIZLMVgdPZFY3mSGYl74NOfI5HMjk+TzgLsCdMLg7E9hURFty+Chgb8PLMLiuEFwqoi05vBPwU9Sf30hDgqYiFiOHFSHmzSAFfIr/MgX07kSTrQwxM9S1f/0A5KXXEe1dmSP4LQzuKQQfz5DPqe9gUxEfB+wt+C4MnswEHiuQH5C+fLkicmL1ZcCdJ51bdfChhfdgWJLXpgs3kSnimoVCtAxPAmaCJIex3zsYKl8jyWvTbZ/w9nXckPS/anGh01VMVMNHUn8Qi7heIK8WcS1DPo6/AseFKmCL+hZeVv8ct+kNcjE/hdxvsDEGng6gjtRMLKUhGcaZTN4vcuDVUrsUwVcM9kdjHFcz+e5JgpS1zZI4xKAn0iVa1oJ4uaQZ8cw7eIYPFkuwo1BEB0+lY/kE70m7Nor3sVfq9f4uxD7D9hYLQPoT8Xsh0SB+FxvakvdslaRcs0sgnpE66xX9kldto/Rmp/sg/hfnDLDqJhuTFPKc1KD+IzWW093fv+Bb7FcXsaL9D07tzpr6+r4oAAAAAElFTkSuQmCC" ?>

<div class="formContainer" id="formContainerActor">
    <!-- Popup Div Starts Here -->
    <div class="popupAdd" id="actor_form_popup">
        <!-- Contact Us Form -->
        <form class="form_popup" action="" id="formActor" method="post" name="form">
            <img class="close" src= <?php echo $close; ?> onclick ="div_hide('formContainerActor')">
            <h2 class="h2popup">Ajouter un acteur </h2>
            <hr class="hrpopup">
            <input id="actor_name" name="name" placeholder="Nom"  type="text3" required>
            <input id="actor_fn" name="fn" placeholder="Prénom"  type="text3" required>
            <input id="actor_role" name="role" placeholder="Role"  type="text3" required>

            <select class="form-control" id="actor_genre" style="margin-top: 30px; height: 50px; width: 400px; border: 2px solid #fed136;";>
                <option>Homme</option>
                <option>Femme</option>
            </select>
            <button type='button' class="submit_form" onclick="edit_actors()" id="submitActor">Send</button>
            <img src="squares.gif" id="load_spinner" style="display: none">
        </form>
    </div>
    <!-- Popup Div Ends Here -->
</div>


<div class="formContainer" id="formContainerDirector" style="display: none">
    <!-- Popup Div Starts Here -->
    <div class="popupAdd" id="director_form_popup">
        <!-- Contact Us Form -->
        <form class="form_popup" action="#" id="formDirector" method="post" name="form">
            <img class="close" src=<?php echo $close; ?> onclick ="div_hide('formContainerDirector')">
            <h2 class="h2popup">Ajouter un directeur </h2>
            <hr class="hrpopup">
            <input id="director_name" name="name" placeholder="Nom" type="text3">
            <input id="director_fn" name="fn" placeholder="Prénom" type="text3">
            <select class="form-control" id="director_genre" style="margin-top: 30px; height: 50px; width: 400px; border: 2px solid #fed136;";>
                <option>Homme</option>
                <option>Femme</option>
            </select>
            <button type='button' class="submit_form" onclick="edit_directors()" id="submitDirector">Send</button>
        </form>
    </div>
    <!-- Popup Div Ends Here -->
</div>

<div class="formContainer" id="formContainerWriter" style="display: none">
    <!-- Popup Div Starts Here -->
    <div class="popupAdd" id="writer_form_popup">
        <!-- Contact Us Form -->
        <form class="form_popup" action="#" id="formWriter" method="post" name="form">
            <img class="close" src=<?php echo $close; ?> onclick ="div_hide('formContainerWriter')">
            <h2 class="h2popup">Ajouter un auteur </h2>
            <hr class="hrpopup">
            <input id="writer_name" name="name" placeholder="Nom" type="text3">
            <input id="writer_fn" name="fn" placeholder="Prénom" type="text3">
            <select class="form-control" id="writer_genre" style="margin-top: 30px; height: 50px; width: 400px; border: 2px solid #fed136;";>
                <option>Homme</option>
                <option>Femme</option>
            </select>
            <button type='button' class="submit_form" onclick="edit_writers()" id="submitWriter">Send</button>
        </form>
    </div>
    <!-- Popup Div Ends Here -->
</div>

<div class="formContainer" id="formContainerDetails" style="display: none">
    <!-- Popup Div Starts Here -->
    <div class="popupAdd" id="details_form_popup">
        <!-- Contact Us Form -->
        <form class="form_popup" action="#" id="formDetails" method="post" name="form">
            <img class="close" src= <?php echo $close; ?> onclick ="div_hide('formContainerDetails')">
            <h2 class="h2popup">Ajouter des details </h2>
            <hr class="hrpopup">
            <input id="genre" name="genre" placeholder="Genre" type="text3">
            <input id="language" name="language" placeholder="Langue" type="text3">
            <input id="country" name="country" placeholder="Pays" type="text3">
            <button type="button" class="submit_form" onclick="edit_details()" id="submitDetails">Send</button>
        </form>
    </div>
    <!-- Popup Div Ends Here -->
</div>


<div class="formContainer" id="formContainerResume" style="display: none">
    <!-- Popup Div Starts Here -->
    <div class="popupAdd" id="resume_form_popup">
        <!-- Contact Us Form -->
        <form class="form_popup" action="#" id="formResume" method="post" name="form">
            <img class="close" src= <?php echo $close; ?> onclick ="div_hide('formContainerResume')">
            <h2 class="h2popup">Ajouter des details </h2>
            <hr class="hrpopup">
            <textarea class="textarea-resume" id="resume" name="resume"></textarea>
            <button type='button' class="submit_form" onclick="edit_plot(<?php echo $havePlot; ?>)" id="submitResume">
                Send
            </button>
            <img src="squares.gif" id="load_spinner" style="display: none">
        </form>
    </div>
    <!-- Popup Div Ends Here -->
</div>

