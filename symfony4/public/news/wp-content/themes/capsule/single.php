<?php
   get_header();
   the_post();
?>
   <body>
         <?php get_template_part('templates/nav'); ?>
         <div class="page-wraper">
            <!-- POST IMAGE -->
            <div class="thumbnail-post-single full-wh" style="background-image: url(<?php echo get_first_image(); ?>)">
               <div class="bg-fade">
                 <div class="item-info align-right">
                    <div class="title-div">
                        <h1 class="title cpost-title align-right">
                            <?php the_title(); ?>
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
                    <a href="/news" class="arrow-link back">&larr;</a>
                    <a href="#post-single" class="arrow-link down">&darr;</a>
                    
                 </div>
                </div>
            </div>
            
            <section class="content-page-wrapper">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-8 post-container mb-30">
                        <div id="post-single" class="post-single mb-30 mb-5">
                           <div class="post-box-wraper mb-30 contenido-post">
                              <?php the_content(); ?>
                           </div>
                           <div class="row">
                              <div class="col-md-12 mb-30">
                                 <div class="blog-popular-tag mt-5">
                                    <?php
                                       if(get_the_tag_list()) {
                                           echo get_the_tag_list('<ul class="popular-tag-wrapper"><li>','</li><li>','</li></ul>');
                                       }
                                    ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
<?php get_footer(); ?>

