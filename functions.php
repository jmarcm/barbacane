<?php
$fichiers = ['enqueue', 'customizer-auteur', 'hooks-front'];

foreach ($fichiers as $f) {
    require_once get_stylesheet_directory() . "/inc/{$f}.php";
}
