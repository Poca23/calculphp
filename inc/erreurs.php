<?php

function afficherErreur($code)
{
    $codesConnus = [404, 500];

    if (!in_array($code, $codesConnus, true)) {
        $code = 500;
    }

    http_response_code($code);
    require base() . '/' . $code . '.php';
    exit;
}