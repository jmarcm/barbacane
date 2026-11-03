<?php
$nom   = get_theme_mod('auteur_nom', 'Marc Wurmser');
$desc  = get_theme_mod('auteur_description', '');
$email = get_theme_mod('auteur_email', '');
$photo = get_theme_mod('auteur_photo', '');
$parcours   = array_filter(array_map('trim', explode("\n", get_theme_mod('auteur_parcours', ''))));
$formations = array_filter(array_map('trim', explode(',', get_theme_mod('auteur_formations', ''))));
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

            <?php if ($parcours) : ?>
                <ul class="author-parcours">
                    <?php foreach ($parcours as $etape) : ?>
                        <li><?php echo esc_html($etape); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if ($formations) : ?>
                <div class="author-tags">
                    <?php foreach ($formations as $formation) : ?>
                        <span><?php echo esc_html($formation); ?></span>
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