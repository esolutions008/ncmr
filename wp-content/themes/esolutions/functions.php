<?php


// -----------------------------------
// 公開画面の設定
// -----------------------------------


// 不要なプラグインのCSS読込を削除
// -----
  add_action( 'wp_enqueue_scripts', 'deregister_plugin_files' );
  function deregister_plugin_files() {
    wp_deregister_script('jquery');
    wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-2.2.4.min.js' );
    wp_enqueue_script( 'tether', get_template_directory_uri() . '/assets/libraries/tether/dist/js/tether.min.js' );
    wp_enqueue_script( 'owlcarousel2', get_template_directory_uri() . '/assets/libraries/owlcarousel2/assets/javascripts/owl.carousel.min.js' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/libraries/bootstrap/bootstrap.min.js' );
    wp_enqueue_script( 'sidr', get_template_directory_uri() . '/assets/libraries/sidr/dist/jquery.sidr.min.js' );
    wp_enqueue_script( 'app', get_template_directory_uri() . '/assets/javascripts/app.js' );
    wp_enqueue_style( 'app', get_template_directory_uri() . '/assets/stylesheets/app.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
    wp_dequeue_style( 'contact-form-7' );
    wp_dequeue_style( 'se-link-styles' );
  }

// ページネーション
function wp_bs_pagination($pages = '', $range = 1) {
  $showitems = ($range * 2) + 2;
  global $paged;
  if (empty($paged)) $paged = 1;
  if ($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if (!$pages) {
      $pages = 1;
    }
  }
  if (1 != $pages) {
    echo '<nav class="text-xs-center"><ul class="pagination">';
    if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) echo "<li class='page-item'><a class='page-link' href='" . get_pagenum_link(1) . "' aria-label='First'>&laquo;<span class='hidden-xs'> 最初へ</span></a></li>";
    if ($paged > 1 && $showitems < $pages) echo "<li class='page-item'><a class='page-link' href='" . get_pagenum_link($paged - 1) . "' aria-label='Previous'>&lsaquo;<span class='hidden-xs'> 前へ</span></a></li>";
    for ($i = 1; $i <= $pages; $i++) {
      if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
        echo ($paged == $i) ? "<li class=\"page-item active\"><span class='page-link'>" . $i . " <span class=\"sr-only\">(current)</span></span></li>" : "<li class='page-item'><a class='page-link' href='" . get_pagenum_link($i) . "'>" . $i . "</a></li>";
      }
    }
    if ($paged < $pages && $showitems < $pages) echo "<li class='page-item'><a class='page-link' href=\"" . get_pagenum_link($paged + 1) . "\"  aria-label='Next'><span class='hidden-xs'>次へ </span>&rsaquo;</a></li>";
    //if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) echo "<li class='page-item'><a class='page-link' href='" . get_pagenum_link($pages) . "' aria-label='Last'><span class='hidden-xs'>最後へ </span>&raquo;</a></li>";
    echo "</ul>";
  }
}

// 新着アイコン
// -----

function new_icon() {
  $hours = 24 * 7; //Newを表示させたい期間の時間
  $today = date_i18n('U');
  $entry = get_the_time('U');
  $article = date('U',($today - $entry)) / 3600 ;
  if( $hours > $article ){ echo '<span class="label label-new">NEW!</span>'; }
}

// 英語
// -----

// 親スラッグを取得
function is_parent_slug() {
  global $post;
  if ($post->post_parent) {
    $post_data = get_post($post->post_parent);
    return $post_data->post_name;
  }
}
function is_english() {
  global $post;
  if (is_page("en") || is_parent_slug() == "en" || is_tax("projects-tag", "english") || is_object_in_term($post->ID, 'projects-tag','english') && is_single() ){
    return true;
  } else {
    return false;
  };
};

// -----------------------------------
// 管理画面の設定
// -----------------------------------


// カスタム投稿
// -----

// カスタム投稿: プロジェクト
add_action('init', 'projects');
function projects() {
  $labels = array(
    'name' => 'プロジェクト',
    'add_new_item' => 'プロジェクトを追加',
    'not_found' =>  __('プロジェクトは見つかりませんでした'),
    'new_item' => __('新しいプロジェクトを追加'),
    'view_item' => __('プロジェクトを表示')
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'rewrite' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'supports' => array('title','editor','thumbnail')
);
  register_post_type('projects',$args);
}
register_taxonomy(
  'projects-category', array('projects'),array(
  'label' => 'カテゴリー',
  'singular_label' => 'カテゴリー',
  'hierarchical' => true,
  'show_ui' => true,
  'query_var' => true,
  'public' => true,
  'show_ui' => true
));
register_taxonomy(
  'projects-tag', array('projects'),array(
  'label' => 'タグ',
  'singular_label' => 'タグ',
  'hierarchical' => false,
  'show_ui' => true,
  'query_var' => true,
  'public' => true,
  'show_ui' => true
));

// 管理者権限の設定
// -----

  // 管理者以外にアップデートのお知らせ非表示
  if (!current_user_can('edit_users')) {
    function wphidenag() { remove_action( 'admin_notices', 'update_nag'); }
    add_action('admin_menu','wphidenag');
  }
  // サイドバーメニューの調整
  function remove_menus () {
    // 管理者以外に非表示の項目
    if (!current_user_can('level_10')) {
      remove_menu_page('wpcf7');
      global $menu;
      unset($menu[2]); //ダッシュボード
      unset($menu[4]); //メニューの線1
      unset($menu[10]); //メディア
      unset($menu[15]); //リンク
      unset($menu[20]); //ページ
      unset($menu[25]); //コメント
      unset($menu[59]); //メニューの線2
      unset($menu[60]); //テーマ
      unset($menu[65]); //プラグイン
      unset($menu[75]); //ツール
      unset($menu[80]); //設定
      unset($menu[90]); //メニューの線3
    }
  }
  add_action('admin_menu', 'remove_menus');

// IMEのカスタマイズ
// -----

  // TinyMCE Advancedでなぜか2列目が表示されるので非表示に
  // function my_admin_style() {
  //   echo '<style>.mce-stack-layout-item.mce-last { display:none!important; }</style>'.PHP_EOL;
  // }
  // add_action('admin_print_styles', 'my_admin_style');

  // ショートコードをpタグで挟まない
  function shortcode_empty_paragraph_fix($content) {
    $array = array ('<p>[' => '[',']</p>' => ']',']<br />' => ']');
    $content = strtr($content, $array);
    return $content;
  }
  add_filter('the_content', 'shortcode_empty_paragraph_fix');

  // pタグが勝手に入るのを防ぐ
  add_action('init', function() { remove_filter('the_excerpt', 'wpautop'); remove_filter('the_content', 'wpautop'); });
  add_filter('tiny_mce_before_init', function($init) {
    $init['wpautop'] = false;
    $init['apply_source_formatting'] = ture;
    return $init;
  });

  // 絵文字を削除
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );

  // ビジュアルエディタ
  add_editor_style('editor-style.css');
  function custom_editor_settings( $initArray ){
    $initArray['body_class'] = 'section-article-content';
    $initArray['block_formats'] = "段落=p; 大見出し=h2; 中見出し=h3; 小見出し=h4; 極小見出し=h5; 引用=blockquote;";
    //スタイリング用クラス
    $style_formats = array(
      //array('title' => '段落','block' => 'p','classes' => ''),
      array('title' => '段落','block' => 'p'),
      array('title' => '大見出し','block' => 'h2'),
      array('title' => '中見出し','block' => 'h3'),
      array('title' => '小見出し','block' => 'h4'),
      array('title' => '極小見出し','block' => 'h5'),
    );
    $initArray['style_formats'] = json_encode($style_formats);
    return $initArray;
  }
  add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );

// アイキャッチ
// -----

// アイキャッチ
add_theme_support('post-thumbnails');
add_filter( 'post_thumbnail_html', 'custom_attribute' );
function custom_attribute( $html ){
  $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
  return $html;
}
function remove_img_attr($html) {
  $html = preg_replace('/ (width|height)."\d*"/', '', $html);
  $html = preg_replace('/ class=".+"/', '', $html);
  return $html;
}
add_filter('get_image_tag', 'remove_img_attr');
add_image_size('small',375,260,true);

// ウィジェットのカスタマイズ
// -----

// デフォルトウィジェットの削除とアクティベーション
function unregister_default_widget() {
  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Archives');
  unregister_widget('WP_Widget_Meta');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Text');
  unregister_widget('WP_Widget_Categories');
  unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Nav_Menu_Widget');
  unregister_widget('Akismet_Widget');
}
add_action( 'widgets_init', 'unregister_default_widget' );

// タイトル
add_theme_support( 'title-tag' );
