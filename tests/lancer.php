<?php
require_once __DIR__ . '/../inc/calcul.php';

function verifier($nom, $obtenu, $attendu)
{
    if ($obtenu === $attendu) {
        echo "OK     : $nom\n";
    } else {
        echo "ECHEC  : $nom (obtenu " . var_export($obtenu, true) . ", attendu " . var_export($attendu, true) . ")\n";
    }
}

foreach (glob(__DIR__ . '/*/test.php') as $fichier) {
    require $fichier;
}