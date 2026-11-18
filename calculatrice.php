<?php
require_once 'inc/main.php';

$operations = ['+', '-', '*', '/'];
$erreurs = [];
$resultat = null;
$nombre1 = '';
$nombre2 = '';
$operation = '';
$statut = 200;

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
    if (!in_array($operation, $operations, true)) {
        $erreurs['operation'] = "L'opération doit être + - * ou /.";
    }
    if (is_infinite((float) $nombre1) || is_infinite((float) $nombre2)) {
        $erreurs['nombre1'] = 'Les nombres sont trop grands.';
    }
    if ($operation === '/' && $nombre2 === 0.0) {
        $erreurs['nombre2'] = 'Division par zéro impossible.';
    }

    if (empty($erreurs)) {
        $resultat = calculer($nombre1, $nombre2, $operation);
    } else {
        $statut = 422;
    }
}

afficherPage('calculatrice', function () use ($operations, $erreurs, $resultat, $nombre1, $nombre2, $operation) { ?>

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
                    <?php foreach ($operations as $op): ?>
                        <option value="<?= $op ?>" <?= $operation === $op ? 'selected' : '' ?>><?= $op ?></option>
                    <?php endforeach; ?>
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

<?php }, $statut);