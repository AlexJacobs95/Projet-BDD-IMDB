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

    $query = "SELECT Auteur, Texte, DateComplete
              FROM Commentaires
              WHERE OID = '$id'
              order by DateComplete desc";

    $res = $database->query($query);

    $rows = array();
    while($row = mysqli_fetch_array($res)) {
        $author = utf8_encode($row["Auteur"]);
        $comment = utf8_encode($row["Texte"]);
        $date = utf8_encode($row["DateComplete"]);
        array_push($rows, [$author, $comment, $date]);
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
                        <input class="form-control" placeholder="Pseudo" type="text" id="new_comm_pseudo">
                        <input class="form-control" placeholder="Ajouter un commentaire...." type="text" id="new_comm_text">
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
            const author = entry[0];
            const comment = entry[1];
            const time = entry[2];
            addCommentInList(author, comment, time);
        })

    });

    function send_comment() {
        const pseudo = $('#new_comm_pseudo').val();
        const text = $('#new_comm_text').val();
        console.log(pseudo, text);
        $.ajax({
            url: "send_comment.php?type=add_comment",
            type: "POST",
            dataType: 'json', // add json datatype to get json
            data: ({pseudo: pseudo, text: text}),
            error: function (xhr, status) {
                alert(status);

            },
            success: function (res) {
                console.log(res)
                if (res) {
                    console.log("q")
                    addCommentInList(pseudo, text, "A l'instant")
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

    function addCommentInList(author, comment, time) {
        var id = "comment"+i;
        $('#comments_container').append(
            $('<div class="col-lg-12"></div>').append(
                $('<div class="panel panel-white post panel-shadow" id='+i+'></div>').append(
                    $('<div class="post-heading"></div>').append(
                        $('<div class="title h5"></div>').append(
                            $('<a href="#"><b>'+author+'</b></a>')
                        )
                    )
                )
            )
        );
        $('#'+i).append(
            $('<div class="post-description"></div>').append([
                '<p>'+comment+'</p>',
                '<div class="stats">',
                '   <h6 class="text-muted time">'+time+'</h6>',
                '</div>'
            ].join(' '))
        );

        i++;
    }

</script>
