<?php get_template_part('layouts/header'); ?>
<?php get_template_part('layouts/breadcrumb'); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
  <main>
    <div class="container">
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
    </div>
  </main>
<?php endwhile; ?>
<?php endif; ?>
<?php get_template_part('layouts/footer'); ?>
