<?php
   get_header();
   the_post();
?>
   <body>
      <?php get_template_part('templates/nav'); ?>
      <div class="page-wraper">
         <!-- POST IMAGE -->
         <div class="thumbnail-post-single full-wh" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)">
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
                  <div class="col-md-8 post-container my-paroller mb-30"
                        data-paroller-factor="0.2" data-paroller-type="foreground">
                     <div id="post-single" class="post-single mb-30 mb-5 upcoming-post">
                        <?php
                           
                           // Obtainning meta
                           $fecha = get_post_meta( $post->ID, 'fecha', true );
                           $director = get_post_meta( $post->ID, 'director', true );
                           $productor = get_post_meta( $post->ID, 'productor', true );
                           $sinopsis = get_post_meta( $post->ID, 'sinopsis')[0];
                           $infoadicional = get_post_meta( $post->ID, 'infoadicional', true );
                           $trailerlink = get_post_meta( $post->ID, 'trailerlink', true );
                           
                        ?>
                        
                        <div class="post-box-wraper row contenido-post">
                           <?php if ( $fecha !== '' ) : ?>
                              <div class="col-md-12 mb-10 meta-inf">
                                 <h6 class="mb-1">Release date</h6>
                                 <p><?php echo $fecha; ?></p>
                              </div>
                           <?php endif; ?>
                           
                           <?php if ( $director !== '' ) : ?>
                           <div class="col-md-12 mb-10 meta-inf">
                              <h6 class=" mb-1">Director</h6>
                              <p><?php echo $director; ?></p>
                           </div>
                           <?php endif; ?>
                           
                           <?php if ( $productor !== '' ) : ?>
                           <div class="col-md-12 mb-10 meta-inf">
                              <h6 class="mb-1">Producer</h6>
                              <p><?php echo $productor; ?></p>
                           </div>
                           <?php endif; ?>
                           
                           <?php if(strlen( $sinopsis ) >0) : ?>
                           <div class="col-md-12 mb-30 meta-inf">
                              <h6 class="mb-1">Synopsis</h6>
                              <p><?php echo $sinopsis; ?></p>
                           </div>
                           <?php endif; ?>
                           
                           <?php if(strlen( $infoadicional ) >0) : ?>
                           <div class="col-md-12 mb-10 meta-inf">
                              <h6 class="mb-1">Information</h6>
                              <p><?php echo $infoadicional; ?></p>
                           </div>
                           <?php endif; ?>
                           
                           <div class="col-md-12 mb-10">
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
                  </div> <!-- end post container -->
                  
                  <?php
                     if ( $trailerlink !== '' && strlen( $trailerlink ) > 0) :
                  ?>
                     
                     <div class="video-container-upcoming">
                        <div id="videoPlayer" 
                           style="background-image: url(<?php echo get_first_image(); ?>);"
                           data-property="{
                              videoURL: '<?php echo $trailerlink; ?>',
                              containment: 'self',
                              autoPlay:true, 
                              mute:true, 
                              startAt:0, 
                              opacity:1,
                              showControls: true,
                              useOnMobile: true,
                              highres: 'highres',
                              optimizeDisplay: true,
                           }">
                           
                        </div>
                     </div>
                     
                  <?php endif; ?>
                  
               </div>
            </div>
         </section>
      </div>
<?php get_footer(); ?>

