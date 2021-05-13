<?php
   get_header(); 
?>
   <body class="body-index">
		<div class="loader">
			<div class="spinner">
				<div class="double-bounce1"></div>
				<div class="double-bounce2"></div>
			</div>
		</div>
		 <?php get_template_part('templates/nav'); ?>
		 <div class="page-wraper">
			<section class="content-page-wrapper content-blog-page small-resp">
				<h1 class="section-title">NEWS</h1>
			   <div class="container-fluid">
				  <div class="row">
					 <div class="col-md-6 offset-md-1">
						<?php
						   
						   $paged = get_query_var('paged') > 1 ? get_query_var('paged') : 1;
						   $arg = array(
								 'paged' => $paged,
								 'posts_per_page' => 4,
								 'post_type'=>array('post','upcoming'),
						   );
						   $query = new WP_Query($arg);
						   if($query->have_posts()){
							  while($query->have_posts()){
								 $query->the_post();
								 echo '<div class="index-post-container">';
								 get_template_part('templates/content', get_post_format());
								 echo '</div>';
							  }
						   }
						   wp_reset_postdata();
						   
						?>
						<div class="pagination">
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
					 <?php get_template_part( 'templates/sidebar', 'index' ); ?>
				  </div>
			   </div>
			</section>
		 </div>
<?= get_footer(); ?>