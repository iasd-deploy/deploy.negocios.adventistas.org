<?php $campo = $args['campo']; ?>

<?php if(!empty($campo) && !is_wp_error($campo)): ?>
  <div class="pa-brand">
    <a href="/" title="<?= !empty($campo->name) ? $campo->name : '' ?>" class="d-flex flex-column justify-content-center"><img src="<?= get_template_directory_uri() . "/assets/sedes/" . LANG . "/logo-iasd-vertical.svg" ?>" alt="<?= $campo->name ?>" title="<?= $campo->name ?>" class="img-fluid"></a>
    <span class="d-block mt-4"><?= !empty($campo->name) ? $campo->name : '' ?></span>
  </div>
  <hr class="mt-4 mb-4">
<?php endif; ?>
