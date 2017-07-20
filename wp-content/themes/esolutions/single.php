<?php get_template_part('layouts/header'); ?>
<?php get_template_part('layouts/breadcrumb'); ?>
<main>
  <div class="container">
    <?php if(is_category('news')) : ?>
    <h1>NEWS<small>ニュース</small></h1>
    <?php elseif(is_category('seminar')): ?>
    <h1>SEMINAR<small>講演実績</small></h1>
    <?php endif; ?>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <dl class="card-block">
            <dt><span><?php the_time('Y年n月j日'); ?></span><h3><?php the_title(); ?></h3></dt>
            <dd><?php the_content(); ?></dd>
          </dl>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
  </div>
</main>
<?php get_template_part('layouts/footer'); ?>
