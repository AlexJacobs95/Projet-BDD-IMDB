<?php

function isFilm($id)
{
    return $id[0] != '"';
}


function isSerie($id)
{
    return $id[0] == '"' and strpos($id, '{') === false;
}

function isEpisode($id)
{
    return $id[0] == '"' and strpos($id, '{') !== false;
}

function getOeuvreType($id) {
    if ($id[0] != '"') return "film";
    elseif ($id[0] == '"' and strpos($id, '{') === false) return "serie";
    elseif ($id[0] == '"' and strpos($id, '{') !== false) return "episode";
}

?>