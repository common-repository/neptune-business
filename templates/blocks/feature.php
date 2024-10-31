<?php
$title = get_field('feature_title');
$sub = get_field('feature_sub_title');
$content = get_field('content');
$btn = get_field('button');
$bg = get_field('featured_image');
$bgcolor = get_field('background_color');
$toggle = get_field('feature_toggle');
if($toggle == 'On'):
?>
<div class="section featured-block" style="background-color:<?php echo $bgcolor; ?>">

	
	<div class="grid-wide">

		<div class="col-6-12 feature">
			<header>
				<?php
				echo '<h2>'. $title .'</h2>';
				echo '<h4>'. $sub .'</h4>';
				?>
			</header>
		

			<div class="content-area">
				<p><?php echo $content; ?></p>

				<?php if( $btn ): ?>
					
					<a class="button" href="<?php echo $btn['url']; ?>" target="<?php echo $btn['target']; ?>">
						<?php echo $btn['title']; ?>
					</a>

				<?php endif; ?>
			</div>
		</div>

		<div class="col-6-12" style="background-image:url('');background-size:cover;">
			<img src="<?php echo $bg; ?>">
		</div>
</div>
</div>
<?php endif; //end toggle check
