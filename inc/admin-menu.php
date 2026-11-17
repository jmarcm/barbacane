<?php
add_action('admin_menu', function () {
    add_theme_page(
        'Bloc auteur',
        'Bloc auteur',
        'edit_theme_options',
        admin_url('customize.php?autofocus[section]=section_auteur')
    );
});
