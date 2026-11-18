<?php

function calculer($nombre1, $nombre2, $operation)
{
    $nombre1 = (float) $nombre1;
    $nombre2 = (float) $nombre2;

    switch ($operation) {
        case '+':
            return $nombre1 + $nombre2;
        case '-':
            return $nombre1 - $nombre2;
        case '*':
            return $nombre1 * $nombre2;
        case '/':
            if ($nombre2 == 0) {
                return null;
            }
            return $nombre1 / $nombre2;
        default:
            return null;
    }
}