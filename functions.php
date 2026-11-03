<?php
// ── Chargement du thème parent ─────────────────────────────────────────
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
});


// ── 1. Enregistrement des options dans le Customizer ──────────────────
function mon_auteur_customizer($wp_customize) {

    $wp_customize->add_section('section_auteur', [
        'title'    => 'Bloc auteur – Page d\'accueil',
        'priority' => 30,
    ]);

    $champs = [
        'auteur_nom'         => ['label' => 'Nom', 'defaut' => 'Marc Wurmser'],
        'auteur_description' => ['label' => 'Description', 'defaut' => ''],
        'auteur_email'       => ['label' => 'Email', 'defaut' => ''],
        'auteur_tags'        => ['label' => 'Affiliations (séparées par des virgules)', 'defaut' => ''],
    ];

    foreach ($champs as $id => $args) {
        $wp_customize->add_setting($id, [
            'default'           => $args['defaut'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control($id, [
            'label'   => $args['label'],
            'section' => 'section_auteur',
            'type'    => 'text',
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
}
add_action('customize_register', 'mon_auteur_customizer');


// ── 2. Affichage du bloc sur la page d'accueil ────────────────────────
function mon_bloc_auteur_accueil() {
    if (! is_front_page()) return;

    $nom   = get_theme_mod('auteur_nom', 'Marc Wurmser');
    $desc  = get_theme_mod('auteur_description', '');
    $email = get_theme_mod('auteur_email', '');
    $photo = get_theme_mod('auteur_photo', '');
    $tags  = array_map('trim', explode(',', get_theme_mod('auteur_tags', '')));
?>
    <div class="author-bio-block">
        <div class="author-bio-inner">
            <?php if ($photo) : ?>
                <div class="author-photo">
                    <img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr($nom); ?>">
                </div>
            <?php endif; ?>
            <div class="author-info">
                <span class="author-label">L'AUTEUR</span>
                <h2 class="author-name"><?php echo esc_html($nom); ?></h2>
                <p class="author-desc"><?php echo esc_html($desc); ?></p>
                <?php if ($tags[0] !== '') : ?>
                    <div class="author-tags">
                        <?php foreach ($tags as $tag) : ?>
                            <span><?php echo esc_html($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if ($email) : ?>
                    <a href="mailto:<?php echo esc_attr($email); ?>" class="author-email">
                        ✉ <?php echo esc_html($email); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php
}
add_action('kadence_after_header', 'mon_bloc_auteur_accueil');
