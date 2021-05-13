<?php
    $categorias = get_the_category();
?>
<div class="col-md-12 no-padding">
    <div class="mb-2 mt-2">
		<a href="<?php the_permalink(); ?>"><img src="<?php echo get_first_image(); ?>" class="img-fluid todo-ancho"/></a>
	</div>
	<div class="c-content">
        <h3 class="pt-4 pb-3">
            <a href="<?php the_permalink(); ?>">
                <?php the_title();?>
            </a>
        </h3>
    	<h5>
    	    <i class="fa fa-calendar-o ml-3"></i> <span class="text-muted"> <?php echo " "; the_time('j M Y');?></span><span class="post-comment">
            </span>
            <i class="fa fa-tag ml-3"></i><span><a href="<?php echo get_category_link($categorias[0]->cat_ID) ?>"><?php echo ' ' . $categorias[0]->cat_name; ?></a></span>
        </h5>
	</div>
</div>