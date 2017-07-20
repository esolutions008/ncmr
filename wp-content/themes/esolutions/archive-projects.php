<?php get_template_part('layouts/header'); ?>
<?php get_template_part('layouts/breadcrumb'); ?>
  <main>
    <div class="container">
      <h1>PROJECTS<br /><small>事業プロデュース事例をご紹介します</small></h1>
      <?php $terms = get_terms( 'projects-category','orderby=id&order=DESC'); ?>
      <div class="row row-eq-height">
        <?php foreach ( $terms as $term ) : ?>
        <div class="col-md-4 col-sm-6">
          <div class="card">
            <a href="<?php echo get_term_link($term->slug, 'projects-category');?>">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/eyecatch-term-<?php echo $term->slug;?>.jpg" />
            </a>
            <div class="card-block text-xs-center">
              <h4 class="card-title "><a href="<?php echo get_term_link($term->slug, 'projects-category');?>"><?php echo $term->name;?></a></h4></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </main>

<?php get_template_part('layouts/footer'); ?>
