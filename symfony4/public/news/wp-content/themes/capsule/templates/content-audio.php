<?php
    $categorias = get_the_category();
?>
<div class="col-md-12 mb-5 mt-5">
	<div>
	    <div class="c-content">
            <h3 class="mb-3 pt-4">
                <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/headphones.png" class="icon-type-post"/>
                    <?php the_title();?>
                </a>
            </h3>
            <div class="mt-5 mb-5">
                <h1 class="text-center"><?php the_content(); ?></h1>
            </div>
            <h5>
        	    <i class="fa fa-calendar-o ml-3"></i> <span class="text-muted"> <?php echo " "; the_time('j M Y');?></span><span class="post-comment">
                </span>
                <i class="fa fa-tag ml-3"></i><span><a href="<?php echo get_category_link($categorias[0]->cat_ID) ?>"><?php echo ' ' . $categorias[0]->cat_name; ?></a></span>
            </h5>
        </div>
	</div>
</div>