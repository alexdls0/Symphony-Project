<?php 
	get_header();
	
      $args = array(
      'posts_per_page' => 4,
      'post_type' => array('upcoming'),
      // Excluir todos los tipos de formato de post siguientes para que no salgan en el post destacado
      'tax_query' => array( 
         array(
             'taxonomy' => 'post_format',
             'field' => 'slug',
             'terms' => array(
                 'post-format-gallery', 
                 'post-format-link', 
                 'post-format-image', 
                 'post-format-quote', 
                 'post-format-audio', 
                 'post-format-video'
             ),
             'operator' => 'NOT IN'
         ) 
      )
      );
           
   $wp_the_query = new WP_Query($args);
	
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
   <body>
   		<?php get_template_part('templates/nav','search'); ?>
      <div class="wraper">
         <div class="page-wraper">
            <section class="breadcrumb">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <ul class="breadcrumb-link">
                           <?php custom_breadcrumbs(); ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </section>
            <section class="content-page-wrapper content-cart-page">
               <div class="container">
                  <div class="row">
                     <div class="col-sm-8">
                        <div class="col-sm-12">
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
                              <?php if($total_busqueda>=1){ ?>
                                 <div class="cart-page-table-wrapper responsive-table">
                                    <table>
                                       <thead>
                                          <tr>
                                             <th class="product-name" style="text-align:left">Title</th>
                                             <th class="product-name">Publication date</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                       	<?php
                                       	if(have_posts()){
                                       		while(have_posts()){
                                       			the_post();
                                       			get_template_part('templates/content','list');
                                       		}
                                       	}
                                       	?>
                                       </tbody>
                                    </table>
                                 </div>
                              <?php } ?>
                           </div>
                        </div>
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
                     <?php
                        get_template_part('templates/sidebar');
                     ?>
                  </div>
               </div>
            </section>
         </div>
<?php
   get_footer();
?>