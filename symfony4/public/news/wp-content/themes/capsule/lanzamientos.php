<?php 
/**
 * Template Name: Lanzamientos
 * 
 * Source of the pagination issue fix:
 * @link https://discourse.roots.io/t/pagination-not-working-on-custom-post-format-query-on-page/4901/2
 * 
 */
get_header(); 
?>
   <body class="body-index">
        <div class="loader" data-delay="2">
			<div class="spinner">
				<div class="double-bounce1"></div>
				<div class="double-bounce2"></div>
			</div>
		</div>
		
        <?php get_template_part( 'templates/nav' ); ?>
        
        <?php
			
			$arg = array(
			     'posts_per_page' => 1,
			     'post_type'=>array( 'upcoming' ),
			);
			$query = new WP_Query( $arg );
			
			if($query->have_posts()){
				
           		//echo '<div class="first-screen upcomings full-wh">';
				while($query->have_posts()){
					
					$query->the_post();
					$id_destacado[] = get_the_ID();
					// get_template_part ('templates/col-item' );
					echo get_video_background( $post );
					
				}
				//echo '</div>';
				
			}
			wp_reset_postdata();
			
		?>
        <div class="page-wraper">
            <section class="content-page-wrapper content-blog-page small-resp" id="post-single">
            	<h1 class="section-title">UPCOMINGS</h1>
                <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-6 offset-md-1">
                        <?php
	                       
	                       $paged = get_query_var('paged') > 1 ? get_query_var('paged') : 1;
	                       $arg = array(
	                             'paged' => $paged,
	                             'posts_per_page' => 4,
	                             'post_type'=>array('upcoming'),
	                       );
	                       $query = new WP_Query($arg);
	                       
	                       $temp_query = $query;
	                       $wp_query   = NULL;
	                       $wp_query   = $query;
	                       
	                       
	                       if($query->have_posts()){
	                          while($query->have_posts()){
	                          	
	                             $query->the_post();
	                             echo '<div class="index-post-container">';
	                             get_template_part('templates/content', get_post_format());
	                             echo '</div>';
	         
	                          }
	                       } else {
	                    		echo '<p>Nothing new yet</p>';
	                       }
	                       wp_reset_postdata();
	                       
	                       $wp_query = NULL;
	                       $wp_query = $temp_query;
                        ?>
                        <div class="pagination">
                           <p> </p>
                           <div class="pagination-number">
                              <?php
                              $pages = get_the_posts_pagination( array(
                                'mid_size' => 2,
                                'prev_text' =>  '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                                'next_text' =>  '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                                'screen_reader_text' => 'a',
                              ) ); 
                              $pages = str_replace('<h2 class="screen-reader-text">a</h2>', '', $pages);
                              echo $pages;
                              ?>
                              
                           </div>
                        </div>
                     </div>
                     <?php get_template_part('templates/sidebar'); ?>
                  </div>
               </div>
            </section>
         </div>
<?= get_footer(); ?>