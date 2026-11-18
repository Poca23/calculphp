# calculphp

# CalcuPHP

Auteure : Claire Naudin, formation CDA 2026-2027

## Objectif

Une mini-calculatrice web en PHP : deux nombres, une opération
(`+`, `-`, `*`, `/`), un résultat affiché dans la page.

Points travaillés : formulaire HTML sémantique, validation avec
`filter_input` et des `if`, messages d'erreur sous les champs,
statuts HTTP, tests automatiques.

## Structure

```
.
├── calculatrice.php
├── 404.php
├── 500.php
├── routeur.php
├── css/
│   ├── global.css
│   └── calculatrice.css
├── inc/
│   ├── main.php
│   ├── pages.php
│   ├── vues.php
│   ├── erreurs.php
│   └── calcul.php
├── partiel/
│   ├── header.php
│   └── footer.php
└── tests/
    ├── lancer.php
    ├── addition/test.php
    ├── soustraction/test.php
    ├── multiplication/test.php
    ├── division/test.php
    └── erreurs/test.php
```

## Rôle des fichiers

| Fichier           | Rôle                                      |
| ----------------- | ----------------------------------------- |
| `inc/main.php`    | importe tous les fichiers de `inc/`       |
| `inc/pages.php`   | titre et CSS de chaque page               |
| `inc/vues.php`    | `base()` et `afficherPage()`              |
| `inc/erreurs.php` | `afficherErreur()` : page 404 ou 500      |
| `inc/calcul.php`  | `calculer()` : le calcul seul, sans HTML  |
| `routeur.php`     | renvoie la page 404 pour une URL inconnue |

## Lancer le projet

```bash
php -S localhost:8000 routeur.php
```

Ouvrir `http://localhost:8000/calculatrice.php`.

Le `routeur.php` est obligatoire : sans lui, les URL inconnues
ne passent pas par la page 404.

## Tester

Tests automatiques (un dossier par opération) :

```bash
php tests/lancer.php
```

Résultat attendu : 18 lignes `OK`.

Statuts HTTP :

```bash
curl -i http://localhost:8000/calculatrice.php
curl -i http://localhost:8000/nimporte-quoi
curl -i -X POST -d "nombre1=5&nombre2=0&operation=/" http://localhost:8000/calculatrice.php
```

## Statuts HTTP

| Statut | Cas                             | Vérifié |
| ------ | ------------------------------- | ------- |
| 200    | page affichée ou calcul réussi  | oui     |
| 422    | données du formulaire invalides | oui     |
| 404    | page introuvable                | oui     |
| 500    | erreur interne du code          | oui     |

Le « Unknown Status Code » affiché à côté du 422 par `curl -i` vient
du serveur PHP intégré. Le statut envoyé reste bien 422.

## Validation

| Champ                | Règle                                    | Message                          |
| -------------------- | ---------------------------------------- | -------------------------------- |
| `nombre1`, `nombre2` | `FILTER_VALIDATE_FLOAT`                  | « doit être un nombre »          |
| `operation`          | `+`, `-`, `*` ou `/` (`in_array` strict) | « doit être + - \* ou / »        |
| `nombre2` avec `/`   | différent de 0                           | « Division par zéro impossible » |

`0` est un nombre valide : on teste `=== false` et `=== null`,
jamais `!$nombre`.

## Méthode : TDD

Pour chaque opération : écrire le test, le lancer (il échoue),
écrire le code, relancer (il réussit).

## Erreurs rencontrées

| Erreur                                       | Cause / correction                                      |
| -------------------------------------------- | ------------------------------------------------------- |
| `Call to undefined function calculer()`      | `inc/calcul.php` pas encore créé : échec attendu en TDD |
| Page 500 affichée avec le statut 200         | ajout de `http_response_code()` via `afficherErreur()`  |
| Page 500 affichée à moitié                   | `ob_start()` garde la page en mémoire jusqu'à la fin    |
| 404 jamais déclenché                         | serveur lancé sans `routeur.php`                        |
| Warnings `Unknown word` dans VS Code         | correcteur orthographique, pas une erreur PHP           |
| Requêtes `/.well-known/...` dans le terminal | Chrome DevTools, sans conséquence                       |

## Ce que j'ai appris

- Séparer le calcul (`calculer()`) de l'affichage permet de le tester simplement.
- `ob_start()` retarde l'envoi de la page : on peut changer le statut HTTP en cas d'erreur.
- `catch (Throwable $e)` attrape aussi les erreurs fatales, pas seulement les `Exception`.
- Un tableau `$operations` sert à la fois à valider et à générer les `<option>`.
- `curl -i` permet de vérifier un statut HTTP sans navigateur.

## Statut

Exercice terminé et validé.
