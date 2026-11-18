<?php

function base()
{
    return __DIR__ . '/..';
}

function afficherPage($page, $contenu, $statut = 200)
{
    [$titre, $css] = $page();

    try {
        ob_start();
        require base() . '/partiel/header.php';
        $contenu();
        require base() . '/partiel/footer.php';
        $html = ob_get_clean();
    } catch (Throwable $e) {
        ob_end_clean();
        error_log($e->getMessage());
        afficherErreur(500);
    }

    http_response_code($statut);
    echo $html;
}