<?php

function base()
{
    return __DIR__ . '/..';
}

function afficherPage($page, $contenu)
{
    [$titre, $css] = $page();

    try {
        require base() . '/partiel/header.php';
        $contenu();
        require base() . '/partiel/footer.php';
    } catch (Exception $e) {
        require base() . '/500.php';
    }
}