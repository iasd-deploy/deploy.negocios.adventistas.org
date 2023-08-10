<?php

function pa_lideres_destaque($lideres_id)
{
	if (!empty($lideres_id)) {
		if (count($lideres_id) == 1) {
			lider($lideres_id[0]);
		} else {
			lideres($lideres_id);
		}
	}
}


function lider($id)
{

	$lider_social = get_field('lider_redes_sociais', $id);
?>

	<div class="pa-lider-geral row row-cols-auto mb-3">
		<div class="col-12 col-xl-4 text-center mb-4">
			<?php 
			$img_id = get_post_thumbnail_id($id);
			$img_url = wp_get_attachment_image_src($img_id, 'lider-thumb');
			
			if ($img_url[0]){ ?>
			<a href="<?= get_permalink($id); ?>">
			<img src="<?= $img_url[0]; ?>" class="pa-lider-thumb rounded-circle mx-auto" alt="" loading="lazy" width="200" height="200"></a>
			<?php } ?>
			<div class="mt-4">
				<ul class="pa-lider-contact list-inline">
					<?php if ($lider_social['lider_facebook']) : ?>
						<li class="list-inline-item mx-2"><a href="<?= $lider_social['lider_facebook']; ?>" rel="noreferrer noopener" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
					<?php endif;
					if ($lider_social['lider_twitter']) :
					?>
						<li class="list-inline-item mx-2"><a href="<?= $lider_social['lider_twitter']; ?>" rel="noreferrer noopener" target="_blank"><i class="fab fa-twitter"></i></a></li>
					<?php endif;
					if ($lider_social['lider_instagram']) :
					?>
						<li class="list-inline-item mx-2"><a href="<?= $lider_social['lider_instagram']; ?>" rel="noreferrer noopener" target="_blank"><i class="fab fa-instagram"></i></a></li>
					<?php endif;
					if ($lider_social['lider_email']) :
					?>
						<li class="list-inline-item mx-2"><a href="mailto:<?= $lider_social['lider_email']; ?>" rel="noreferrer noopener" target="_blank"><i class="fas fa-envelope"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<div class="col col-xl-8">
			<h1 class="h2 fw-bold link"><a href="<?= get_permalink($id); ?>"><?php echo esc_html(get_the_title($id)); ?></a></h1>
			<h5 class="mb-4"><?php the_field('lider_cargo', $id); ?></h5>
			<div class="pa-lider-bio">
				<?php the_field('lider_bibliografia', $id); ?>
			</div>
		</div>
		<hr class="mt-5 w-100">
	</div>
	<?php
}

function lideres($lideres_id)
{
	if ($lideres_id) {
		foreach ($lideres_id as $id) : 
			$img_id = get_post_thumbnail_id($id);
			$img_url = wp_get_attachment_image_src($img_id, 'lider-thumb');
		?>
			<div class="pa-lider-destaque col-6 col-md-3 my-5 text-center">
				<a href="<?= get_permalink($id); ?>">
					<?php if ($img_url[0]){ ?>
					<img src="<?= $img_url[0]; ?>" class="pa-lider-thumb rounded-circle mx-auto" alt="" loading="lazy" width="200" height="200"></a>
					<?php } ?>
					<p class="mt-4 mb-0 fw-bold"><?= get_the_title($id); ?></p>
					<p class="mb-0 font-italic"><?= get_field('lider_cargo', $id); ?></p>
					<p class="pa-link-perfil mb-0 fw-bold invisible"><?php __('View profile', 'iasd'); ?></p>
				</a>
			</div>
	<?php endforeach;
	} ?>
	<div class="col-12">
		<hr class="mb-5">
	</div>
<?php
}
