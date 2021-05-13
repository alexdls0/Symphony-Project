<?php 
	get_header();
	$total_busqueda = $wp_the_query->found_posts;
    if(is_category()){
        $archive_title = 'Archives for the category: '.single_cat_title('',false);
    } elseif(is_tag){
        $archive_title = 'Archives for the tag: '. single_cat_title('',false);
    } elseif(is_day){
        $archive_title = 'Archives of the day: '. get_the_date();
    } elseif(is_month){
        $archive_title = 'Archives of the month: '. get_the_date('F Y');
    } elseif(is_year){
        $archive_title = 'Archives of the year: '. get_the_date('Y');
    } else {
        $archive_title = 'Archives: ';
    }
?>
   <body class="search-page">
   	<?php get_template_part('templates/nav','search'); ?>
      <div class="wraper">
         <div class="page-wraper">
            <section class="content-page-wrapper content-blog-page ">
               <div class="container-fluid">
                  <h1 class="section-title">Archive</h1>
                  <div class="row">
                     <div class="col-sm-9" style="margin: 0 auto;">
                           <div class="cart-page">
                              <div class="section-heading text-center">
               						<h3><?php echo $archive_title; ?></h3>
               						<?php
               						switch($total_busqueda){
       							        case 0:
       							            echo "<p> No results </p>";
       							            break;
       							        case 1:
       							            echo "<p> One result</p>";
       							            break;
       							        default:
       							            echo "<p>". 'There are '. $total_busqueda . ' results'."</p>";
       							            break;
       							      }
       							      ?>
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
                        <div class="col-sm-12">
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
               </div>
            </div>
         </section>
      </div>
   <?php
   get_footer();
   ?>