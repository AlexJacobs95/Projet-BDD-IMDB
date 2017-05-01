<?php

function isFilm($id)
{
    return $id[0] != '"';
}


function isSerie($id)
{
    return $id[0] == '"' and strpos($id, '{') == false;
}

function isEpisode($id)
{
    return $id[0] == '"' and strpos($id, '{') == true;
}

?>