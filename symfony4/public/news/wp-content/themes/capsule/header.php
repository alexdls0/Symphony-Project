<!DOCTYPE html>
<html lang="en">
   
<head>
      <meta charset="utf-8">
      <title><?php my_title(); ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      
      <link rel="shortcut icon" type="image/x-icon" href="<?= get_template_directory_uri(); ?>/images/favicon.png">
      <link rel="icon" type="img/png" href="<?= get_template_directory_uri(); ?>/images/logo-bg.png">
      <link rel="apple-touch-icon" href="<?= get_template_directory_uri(); ?>/images/logo-bg.png">
      <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
      
      <link href="<?=get_stylesheet_uri()?>" rel="stylesheet">
      <?php wp_head(); ?>
</head>
   