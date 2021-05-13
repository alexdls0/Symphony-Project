<div class="col-md-3 col-sm-11 offset-md-1 small-resp">
   <div class="shop-sidebar search-sidebar">
      <h4 class="sidebar-title">Search</h4>
      <?php get_search_form(); ?>
   </div>
   <div class="shop-sidebar sidebar-blog">
      <h4 class="sidebar-title">Recent entries</h4>
      <ul class="sidebar-content">
         <?php
            $arg = array(
               'posts_per_page' => 4,
               'post_type'=>array('post'),
            );
            $query = new WP_Query($arg);
            if($query->have_posts()){
               while($query->have_posts()){
                  $query->the_post();
                  get_template_part('templates/content','sidebar');
               }
            }
            wp_reset_postdata();
         ?>
      </ul>
   </div>
   <div class="shop-sidebar sidebar-archive">
      <h4 class="sidebar-title">Categories</h4>
      <ul class="sidebar-content">
            <?php
               list_categories();
            ?>
      </ul>
   </div>
   <div class="shop-sidebar sidebar-blog-tag">
      <h4 class="sidebar-title">Popular tags</h4>
      <ul class="sidebar-content">
           <?php
             $args = array(
               'orderby' => 'count',
               'number' => 12,
             );
             $tags = get_tags($args);
             foreach($tags as $tag){
                 $tag_link = get_tag_link($tag->term_id);
                 echo '<li><a href="' . $tag_link . '">' . $tag->name .'</a></li>';
             }
           ?>
       </ul>
   </div>
</div>