<!--
<div class="capsule-col thumbnail-post-single" style="background-image: url(<?php //echo get_first_image(); ?>)">
    <div class="bg-fade">
        <h1><?php //the_title(); ?></h1>
    </div>
</div>
-->

<div class="thumbnail-post-single full-wh" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
   <div class="bg-fade">
     <div class="item-info align-right">
        <div class="title-div">
            <h1 class="title cpost-title align-right">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h1>
        </div>
        <p class="align-right">
            <?php echo get_excerpt(200); ?>
            <br><br><br>
            <i class="far fa-clock"></i> <?php the_time('j, M Y');?>
            <br>
            <i class="fas fa-eye"></i> <?php echo get_num_visits($post->ID); ?>
        </p>
        <p class="align-right"></p>
        <p class="align-right"></p>
        <a href="#post-single" class="arrow-link down">&darr;</a>
     </div>
    </div>
</div>