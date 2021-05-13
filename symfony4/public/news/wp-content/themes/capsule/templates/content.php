<?php
    $categorias = get_the_category();
?>
<div class="col-md-12 no-padding" style="">
	<div class="image-index-container mb-3">
		<a href="<?php the_permalink(); ?>"><img src="<?php echo get_first_image(); ?>" class="img-fluid todo-ancho"/></a>
	</div>
	<div class="c-content">
		<h3 class="mb-3"><a href="<?php the_permalink(); ?>">
		<?php 
			if ( 'upcoming' == get_post_type() ){
				if(get_post_meta($post->ID, 'fecha', true) >= date('Y-m-d')){
					echo '<img src="'. get_template_directory_uri().'/images/clock-dark.png" class="icon-type-post"/>';
				}else{
					echo '<img src="'. get_template_directory_uri().'/images/success.png" class="icon-type-post"/>';
					echo '';
				}
			}
		
		?>    
		<?php the_title();?></a></h3>
		<p>
		    <span class="text-muted"><?php echo " "; the_time('j M Y');?></span>
	    </p>
	    <p class="c-excerpt"><?php echo get_excerpt(200); ?></p>
		<a class="btn-capsule" href="<?php the_permalink(); ?>">Read more</a>
	</div>
</div>