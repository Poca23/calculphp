<?php
[$titre, $css] = ['Page introuvable', ['global.css']];
require base() . '/partiel/header.php';
?>

<main>
    <h2>Erreur 404</h2>
    <p>Cette page n'existe pas.</p>
    <p><a href="/calculatrice.php">Retour à la calculatrice</a></p>
</main>

<?php require base() . '/partiel/footer.php'; ?>