<?php
require_once 'inc/main.php';

$erreurs = [];
$resultat = null;
$nombre1 = '';
$nombre2 = '';
$operation = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre1 = filter_input(INPUT_POST, 'nombre1', FILTER_VALIDATE_FLOAT);
    $nombre2 = filter_input(INPUT_POST, 'nombre2', FILTER_VALIDATE_FLOAT);
    $operation = filter_input(INPUT_POST, 'operation');

    if ($nombre1 === false || $nombre1 === null) {
        $erreurs['nombre1'] = 'Le nombre 1 doit être un nombre.';
    }
    if ($nombre2 === false || $nombre2 === null) {
        $erreurs['nombre2'] = 'Le nombre 2 doit être un nombre.';
    }
    if ($operation !== '+' && $operation !== '-') {
        $erreurs['operation'] = "L'opération doit être + ou -.";
    }

    if (empty($erreurs)) {
        if ($operation === '+') {
            $resultat = $nombre1 + $nombre2;
        } else {
            $resultat = $nombre1 - $nombre2;
        }
    }
}

afficherPage('calculatrice', function () use ($erreurs, $resultat, $nombre1, $nombre2, $operation) { ?>

    <main>
        <h2>Calculatrice</h2>

        <form method="post">
            <p>
                <label for="nombre1">Nombre 1</label>
                <input type="number" id="nombre1" name="nombre1" step="any" value="<?= htmlspecialchars($nombre1) ?>"
                    required>
                <?php if (isset($erreurs['nombre1'])): ?>
                    <span class="erreur"><?= $erreurs['nombre1'] ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="nombre2">Nombre 2</label>
                <input type="number" id="nombre2" name="nombre2" step="any" value="<?= htmlspecialchars($nombre2) ?>"
                    required>
                <?php if (isset($erreurs['nombre2'])): ?>
                    <span class="erreur"><?= $erreurs['nombre2'] ?></span>
                <?php endif; ?>
            </p>

            <p>
                <label for="operation">Opération</label>
                <select id="operation" name="operation">
                    <option value="+" <?= $operation === '+' ? 'selected' : '' ?>>+</option>
                    <option value="-" <?= $operation === '-' ? 'selected' : '' ?>>-</option>
                </select>
                <?php if (isset($erreurs['operation'])): ?>
                    <span class="erreur"><?= $erreurs['operation'] ?></span>
                <?php endif; ?>
            </p>

            <button type="submit">Calculer</button>
        </form>

        <?php if ($resultat !== null): ?>
            <p class="resultat">
                Résultat :
                <output><?= htmlspecialchars($nombre1) ?>         <?= $operation ?>         <?= htmlspecialchars($nombre2) ?> =
                    <?= $resultat ?></output>
            </p>
        <?php endif; ?>
    </main>

<?php });