<li>
    <a class="blog-img" href="#">
    <img src="<?php echo get_first_image(); ?>" alt="" class="miniatura">
    </a>
    <div class="blog-content">
        <a class="blog-title" href="<?php the_permalink();?>"><?php the_title(); ?></a>                                  
        <p class="" style="text-transform:capitalize"><?php the_time('F j, Y');?></p>
    </div>
</li>