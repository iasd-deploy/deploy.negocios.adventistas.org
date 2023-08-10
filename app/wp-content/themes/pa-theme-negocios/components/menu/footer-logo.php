<?php if(!empty($logo = get_theme_mod('footer_logo', 0))): ?>
  <div class="pa-brand">
    <a href="/" class="d-lg-flex d-none flex-column justify-content-center">
      <?= wp_get_attachment_image($logo, 'full') ?>  
    </a>

        <?php if (!empty($footerLogoMobile = get_theme_mod('footer_logo_mobile', 0))): ?>
      <a href="/" class="d-flex d-lg-none flex-column justify-content-center">
          <?= wp_get_attachment_image($footerLogoMobile, 'full') ?>
      </a>

      <?php endif; ?>
  </div>

  <hr class="mt-4 mb-4">
<?php endif; ?>