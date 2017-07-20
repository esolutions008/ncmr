<?php
/*
Template Name: スケルトンページ
*/
?>
<?php get_template_part('layouts/header'); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<main><?php the_content(); ?></main>
<?php endwhile; ?>
<?php endif; ?>
<?php get_template_part('layouts/footer'); ?>
