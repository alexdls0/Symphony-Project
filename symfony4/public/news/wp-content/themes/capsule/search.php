<?php 
	get_header();
?>
   <body class="search-page">
   	<?php get_template_part('templates/nav','search'); ?>
      <div class="wraper">
         <div class="page-wraper">
            <section class="content-page-wrapper content-blog-page ">
               <div class="container-fluid">
                  <h1 class="section-title">Search</h1>
                  <div class="row">
                     <div class="col-sm-9" style="margin: 0 auto;">
                        <div class="cart-page">
                           <div class="section-heading text-center">
                           	<?php
                           		$total_busqueda = $wp_the_query->found_posts;
         							    switch($total_busqueda){
         							        case 0:
         							            echo "<h3>".'No results for : '. $_GET["s"] . "</h3>";
         							            break;
         							        case 1:
         							            echo "<h3>".'One result for : '. $_GET["s"] . "</h3>";
         							            break;
         							        default:
         							            echo "<h3>".'There are '. $total_busqueda .' results for: ' . $_GET["s"] . "</h3>";
         							            break;
         							    }
         							   ?>
         							   <?php get_search_form(); ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div class="row search-table-container">
                     <div class="col-md-12">
                        <?php if($total_busqueda>=1){ ?>
                           <div class="cart-page-table-wrapper responsive-table">
                              <table class="search-table">
                                 <thead>
                                 </thead>
                                 <tbody>
                                 	<?php
                                    	if(have_posts()): while(have_posts()) : the_post();
                                    			get_template_part('templates/content','list');
                                    	endwhile;
                                    	endif;
                                 	?>
                                 </tbody>
                              </table>
                           </div>
                        <?php } ?>
                     </div>
                  </div>
                  
                  <div class="row">
              		  <div class="col-md-12 ">
              			   <div class="pagination">
                           <p> </p>
                           <div class="pagination-number">
                              <?php
                              $pages = get_the_posts_pagination( array(
                                'mid_size' => 2,
                                'prev_text' =>  '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                                'next_text' =>  '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                                'screen_reader_text' => 'a'
                              ) ); 
                              $pages = str_replace('<h2 class="screen-reader-text">a</h2>', '', $pages);
                              echo $pages;
                              ?>
                           </div>
                        </div>
              			</div>
              		</div>
              		
               </div>
            </section>
         </div>
<?php
get_footer();
?>