<?php

	$color = get_option( 'jvgm_option_box' );

?>
<style type="text/css">
<?php  ?>
	#filters .button {
		background: <?php echo $color['cores']; ?> !important;
		color: <?php echo $color['cores_fonte']; ?> !important;
	}

	#filters .button:hover {
		background: <?php echo $color['cores_hover']; ?> !important;
		color: <?php echo $color['cores_fonte_hover']; ?> !important;
	}

	.element-item:hover .card__container--closed .card__caption {
		background: <?php echo $color['cores_thumbs_hover_img']; ?> !important;
		
	}
	.card__container--closed .card__subtitle,
	.card__container--closed .card__title {
		color: <?php echo $color['cores_thumbs_hover_fonte']; ?> !important;
	}

	#load-more {
		background: <?php echo $color['cores_more_button']; ?> !important;
		color: <?php echo $color['cores_more_font']; ?> !important;
	}
<?php ?>
</style>