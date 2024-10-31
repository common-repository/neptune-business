<?php

$content = get_field('cta_content');
$btn = get_field('cta_link');
$bg = get_field('cta_bg');
$toggle = get_field('cta_toggle');
if($toggle == 'On'):
?>
<div class="section cta" style="background-image:url('<?php echo $bg; ?>');background-size:cover;">
	<div class="overlay"></div>
	<div class="grid">

	<div class="content-area cta">
		<h2><?php echo $content; ?></h2>

		<?php if( $btn ): ?>
			
			<a class="button" href="<?php echo $btn['url']; ?>" target="<?php echo $btn['target']; ?>">
				<?php echo $btn['title']; ?>
			</a>

		<?php endif; ?>
	</div>
</div>
</div>
<?php endif;