<?php get_template_part('layouts/header'); ?>
<?php get_template_part('layouts/breadcrumb'); ?>
  <main>
    <div class="container">
      <h1>PROJECTS<br /><small>事業プロデュース事例をご紹介します。</small></h1>
      <h2 class="text-xs-center m-b-3"><?php single_cat_title(); ?></h2>
      <?php if(have_posts()): ?>
        <div class="row row-eq-height">
          <?php while(have_posts()):the_post(); ?>
              <div class="col-md-4 col-sm-6">
                <div class="card">
                  <a href="<?php the_permalink(); ?>">
                    <?php if(has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail('large'); ?>
                    <?php else: ?>
                      <img src="http://placehold.it/600x400/eee/eee">
                    <?php endif; ?>
                  </a>
                  <div class="card-block">
                    <p class="m-b-q text-primary child-m-r-h"><?php echo get_the_term_list( $post->ID, 'projects-category' ); ?></p>
                    <h4 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4></div>
                </div>
              </div>
          <?php endwhile; ?>
        </div>
        <?php if (function_exists("wp_bs_pagination")) { wp_bs_pagination(); } ?>
      <?php else: ?>
        <div class="alert alert-warning m-b-lg"><p>登録されている投稿はありません。</p></div>
      <?php endif; wp_reset_postdata(); ?>
    </div>
  </main>
<?php get_template_part('layouts/footer'); ?>
