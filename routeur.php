<?php
require_once __DIR__ . '/inc/main.php';

$chemin = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($chemin === '/') {
    header('Location: /calculatrice.php');
    exit;
}

// Chrome DevTools demande ce fichier : 404 sans page
if (str_starts_with($chemin, '/.well-known/')) {
    envoyerStatut(404);
    exit;
}

if (is_file(__DIR__ . $chemin)) {
    return false;
}

afficherErreur(404);