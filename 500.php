<?php
[$titre, $css] = ['Erreur serveur', ['global.css']];
require base() . '/partiel/header.php';
?>

<main>
    <h2>Erreur 500</h2>
    <p>Une erreur est survenue. Réessayez plus tard.</p>
    <p><a href="/calculatrice.php">Retour à la calculatrice</a></p>
</main>

<?php require base() . '/partiel/footer.php'; ?>