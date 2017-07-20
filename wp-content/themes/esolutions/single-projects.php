<?php get_template_part('layouts/header'); ?>
<?php get_template_part('layouts/breadcrumb'); ?>
<main>
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <h1><?php the_title(); ?><br /><small class="child-m-r-h"><?php echo get_the_term_list( $post->ID, 'projects-category' ); ?></small></h1></div>
      </div>
    </div>
    <div class="bg-gray p-y-3">
      <div class="container">
        <h2 class="text-xs-center m-b-3"><?php if(is_english()): ?>PROJECT<?php else: ?>プロジェクト概要<?php endif; ?></h2>
        <div class="row">
          <?php if(has_post_thumbnail()) : ?>
            <div class="col-md-4">
            <?php the_post_thumbnail('large'); ?>
            </div>
            <div class="col-md-8">
             <?php the_content(); ?>
            </div>
          <?php else: ?>
            <div class="col-md-12">
             <?php the_content(); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php if($cfs->get('presentation')):?>
    <div class="bg-black text-xs-center m-b-3">
      <iframe class="slideshare" src="https://www.slideshare.net/slideshow/embed_code/key/<?php echo CFS()->get('presentation'); ?>" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen></iframe>
    </div>
    <?php endif; ?>
  <?php endwhile; ?>
  <?php endif; ?>

  <?php
    $terms_tag = get_the_terms($post->ID,'projects-tag');
    $terms_cat = get_the_terms($post->ID,'projects-category');
    if(empty($terms_tag)) {
     $args = array(
       'numberposts' => 3,
       'post_type' => 'projects',
       'tax_query' => array(
         'relation' => 'AND',
           array(
             'taxonomy' => 'projects-tag', /* 指定したい投稿タイプが持つカスタム分類を指定 */
             'field' => 'slug',
             'terms' => 'english',
             'operator'  => 'NOT IN'
           ),
           array(
             'taxonomy' => 'projects-category', /* 指定したい投稿タイプが持つカスタム分類を指定 */
             'field' => 'slug',
             'terms' => $terms_cat[0]->slug,
           ),
         ),
       'orderby' => 'id',
       'order' => 'DESC',
       'post__not_in' => array($post->ID)
     );
    } elseif($terms_tag[0]->slug === 'english') {
     $args = array(
      'numberposts' => 3,
      'post_type' => 'projects',
      'taxonomy' => 'projects-tag',
      'term' => 'english',
      'orderby' => 'id',
      'order' => 'DESC',
      'post__not_in' => array($post->ID)
     );
    }
    $the_query = new WP_Query($args);
    if($the_query->have_posts()):
  ?>
  <div class="container m-t-2">
    <h2 class="text-xs-center m-b-3"><?php if(is_english()): ?>OTHER PROJECTS<?php else: ?>その他のプロジェクト<?php endif; ?></h2>
    <div class="row row-eq-height">
       <?php while($the_query->have_posts()):$the_query->the_post(); ?>
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
  </div>
  <?php endif; ?>
</main>
<?php get_template_part('layouts/footer'); ?>
