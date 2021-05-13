{"changed":true,"filter":false,"title":"index.php","tooltip":"/symfony4/public/news/wp-content/themes/Diso/index.php","value":"<?= get_header(); ?>\n   <body>\n         <?php get_template_part('templates/nav'); ?>\n         <div class=\"page-wraper\">\n            <section class=\"content-page-wrapper content-blog-page\">\n               <div class=\"container\">\n                  <div class=\"row\">\n                     <div class=\"col-md-8\">\n                        <?php\n                           $paged = get_query_var('paged') > 1 ? get_query_var('paged') : 1;\n                           $arg = array(\n                                 'paged' => $paged,\n                                 'posts_per_page' => 4,\n                                 'post_type'=>array('post','upcoming'),\n                           );\n                           $query = new WP_Query($arg);\n                           if($query->have_posts()){\n                              while($query->have_posts()){\n                                 $query->the_post();\n                                 get_template_part('templates/content', get_post_format());\n                              }\n                           }\n                           wp_reset_postdata();\n                        ?>\n                        <div class=\"pagination\">\n                           <p> </p>\n                           <div class=\"pagination-number\">\n                              <?php\n                              $pages = get_the_posts_pagination( array(\n                                'mid_size' => 2,\n                                'prev_text' =>  '<i class=\"fa fa-angle-double-left\" aria-hidden=\"true\"></i>',\n                                'next_text' =>  '<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>',\n                                'screen_reader_text' => 'a'\n                              ) ); \n                              $pages = str_replace('<h2 class=\"screen-reader-text\">a</h2>', '', $pages);\n                              echo $pages;\n                              ?>\n                              \n                           </div>\n                        </div>\n                     </div>\n                     <?php get_template_part('templates/sidebar'); ?>\n                  </div>\n               </div>\n            </section>\n         </div>\n<?= get_footer(); ?>","undoManager":{"mark":3,"position":-1,"stack":[[{"start":{"row":30,"column":32},"end":{"row":30,"column":63},"action":"insert","lines":["'post_type'=>array('upcoming'),"],"id":8}],[{"start":{"row":29,"column":48},"end":{"row":30,"column":0},"action":"insert","lines":["",""],"id":8},{"start":{"row":30,"column":0},"end":{"row":30,"column":32},"action":"insert","lines":["                                "]}],[{"start":{"row":13,"column":52},"end":{"row":13,"column":53},"action":"remove","lines":[","],"id":9}],[{"start":{"row":13,"column":53},"end":{"row":13,"column":57},"action":"remove","lines":["post"],"id":10},{"start":{"row":13,"column":52},"end":{"row":13,"column":54},"action":"remove","lines":["''"]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":25,"column":35},"end":{"row":25,"column":35},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1558535474524}