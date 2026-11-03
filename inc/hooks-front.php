<?php
add_action('kadence_after_header', function () {
    if (is_front_page()) {
        get_template_part('template-parts/bloc-auteur');
    }
});
