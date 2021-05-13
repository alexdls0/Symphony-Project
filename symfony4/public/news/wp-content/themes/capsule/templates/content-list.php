<tr class="capsule-row" data-bg="<?php echo get_first_image(); ?>">
  <td class="product-name">
     <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
  </td>
  <td class="product-price right-search-td">
     <?php the_time('j M, Y');?>
  </td>
</tr>