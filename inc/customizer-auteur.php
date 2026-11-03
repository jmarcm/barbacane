<?php
add_action('customize_register', function ($wp_customize) {

    $wp_customize->add_section('section_auteur', [
        'title'    => 'Bloc auteur – Page d\'accueil',
        'priority' => 30,
    ]);

    $champs = [
        'auteur_nom'         => ['label' => 'Nom', 'defaut' => 'Marc Wurmser', 'type' => 'text', 'sanitize' => 'sanitize_text_field'],
        'auteur_description' => ['label' => 'Description', 'defaut' => '', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field'],
        'auteur_parcours'    => ['label' => 'Parcours (une ligne par étape)', 'defaut' => '', 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field'],
        'auteur_formations'  => ['label' => 'Formations (séparées par des virgules)', 'defaut' => '', 'type' => 'text', 'sanitize' => 'sanitize_text_field'],
        'auteur_email'       => ['label' => 'Email', 'defaut' => '', 'type' => 'text', 'sanitize' => 'sanitize_email'],
    ];

    foreach ($champs as $id => $args) {
        $wp_customize->add_setting($id, [
            'default'           => $args['defaut'],
            'sanitize_callback' => $args['sanitize'],
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control($id, [
            'label'   => $args['label'],
            'section' => 'section_auteur',
            'type'    => $args['type'],
        ]);
    }

    $wp_customize->add_setting('auteur_photo', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'auteur_photo', [
        'label'   => 'Photo de l\'auteur',
        'section' => 'section_auteur',
    ]));
});
