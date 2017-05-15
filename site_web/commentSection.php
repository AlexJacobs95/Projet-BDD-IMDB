<?php

session_start();
$id = urldecode($_GET['id']);
$_SESSION['id'] = $id;
$database = new mysqli("localhost", "root", "imdb", "IMDB");
if (!$database) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else {

    $query = "SELECT Auteur, Texte, DateComplete, Etoiles
              FROM Commentaires
              WHERE OID = '$id'
              order by DateComplete desc";

    $res = $database->query($query);

    $rows = array();
    while($row = mysqli_fetch_array($res)) {
        $author = utf8_encode($row["Auteur"]);
        $comment = utf8_encode($row["Texte"]);
        $date = utf8_encode($row["DateComplete"]);
        $stars = $row["Etoiles"];
        array_push($rows, [$author, $comment, $date, $stars]);
    }
}



?>



<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="commentSection.css">

<section id="Comments" class="bg-light-gray">
    <div class="container" style="margin: auto">
        <div class="row" style="margin: auto">
            <div class="col-lg-12 text-center" id=resume_block>
                <h2 class="section-heading" id="resume-title">Commentaires</h2>
                <div class="container">
                    <div class="row" id="comments_container">

                    </div>
                </div>
                <div class="col-lg-12">
                <div class="post-footer">
                    <div class="input-group">
                        <fieldset id="stars" class="rating"
                                  style="background-color: white; border: 1px solid lightgrey;">
                            <input type="radio" id="star5" name="rating" value="5"/><label class="input-elem full"
                                                                                           for="star5"
                                                                                           title="Awesome - 5 stars"></label>
                            <input type="radio" id="star4half" name="rating" value="4 and a half"/><label
                                    class="input-elem half" for="star4half" title="Pretty good - 4.5 stars"></label>
                            <input type="radio" id="star4" name="rating" value="4"/><label class="input-elem full"
                                                                                           for="star4"
                                                                                           title="Pretty good - 4 stars"></label>
                            <input type="radio" id="star3half" name="rating" value="3 and a half"/><label
                                    class="input-elem half" for="star3half" title="Meh - 3.5 stars"></label>
                            <input type="radio" id="star3" name="rating" value="3"/><label class="input-elem full"
                                                                                           for="star3"
                                                                                           title="Meh - 3 stars"></label>
                            <input type="radio" id="star2half" name="rating" value="2 and a half"/><label
                                    class="input-elem half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                            <input type="radio" id="star2" name="rating" value="2"/><label class="input-elem full"
                                                                                           for="star2"
                                                                                           title="Kinda bad - 2 stars"></label>
                            <input type="radio" id="star1half" name="rating" value="1 and a half"/><label
                                    class="input-elem half" for="star1half" title="Meh - 1.5 stars"></label>
                            <input type="radio" id="star1" name="rating" value="1"/><label class="input-elem full"
                                                                                           for="star1"
                                                                                           title="Sucks big time - 1 star"></label>
                            <input type="radio" id="starhalf" name="rating" value="half"/><label class="input-elem half"
                                                                                                 for="starhalf"
                                                                                                 title="Sucks big time - 0.5 stars"></label>
                        </fieldset>
                        <input class="form-control input_comments" placeholder="Pseudo" type="text_" id="new_comm_pseudo">
                        <input class="form-control input_comments" placeholder="Ajouter un commentaire...." type="text_" id="new_comm_text">
                        <span class="input-group-addon">
                        <a href="javascript:send_comment()"><i class="fa fa-edit"></i></a>
                    </span>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="vendor/jquery/jquery.min.js"></script>


<script>
    i = 0;
    $(document).ready(function () {
        var comments = <?php echo json_encode($rows); ?>;

        comments.forEach(function (entry) {
            const stars = (entry[3] / 5) * 100;
            const author = entry[0];
            const comment = entry[1];
            const time = entry[2];
            addCommentInList(author, comment, time, stars);
        })

    });

    function send_comment() {
        const pseudo = $('#new_comm_pseudo').val();
        const text = $('#new_comm_text').val();
        const stars = getRating();
        const ratingInPercentage = (stars / 5) * 100;
        console.log(pseudo, text, stars);
        $.ajax({
            url: "send_comment.php?type=add_comment",
            type: "POST",
            dataType: 'json', // add json datatype to get json
            data: ({pseudo: pseudo, text: text, rating: stars}),
            error: function (xhr, status) {
                alert(status);

            },
            success: function (res) {
                console.log(res)
                if (res) {
                    addCommentInList(pseudo, text, "A l'instant", ratingInPercentage)
                }
            },
            fail: function () {
                alert("Une erreur est survenue")

            },
            always: function () {
                $('#load_spinner').hide()

            }
        });

    }

    function addCommentInList(author, comment, time, rating) {
        console.log("rating : ", rating);
        var id = "comment"+i;
        $('#comments_container').append(
            $('<div class="col-lg-12"></div>').append(
                $('<div class="panel panel-white post panel-shadow" id='+i+'></div>').append(
                    $('<div class="post-heading"></div>').append(
                        $('<div class="title h5"></div>').append(
                            $('<a style="margin-bottom: 5px;display: block;" href="#"><b>' + author + '</b></a>'),
                            $('<div class="star-ratings-sprite"><span style=width:' + rating + '% class="star-ratings-sprite-rating"></span></div>')
                        )
                    )
                )
            )
        );


        $('#'+i).append(
            $('<div class="post-description"></div>').append([
                '<p style="display: block;padding-top: 20px;">' + comment + '</p>',
                '<div class="stats">',
                '<h6 class="text-muted time">' + time + '</h6>',
                '</div>'
            ].join(' '))
        );

        i++;
    }

    function getRating() {

        var i = 0;
        for (let obj of $("#stars").children()) {
            if ($(obj).is(":checked")) {
                break
            }
            i++;
        }
        return (10 - i / 2) / 2;
    }

</script>
