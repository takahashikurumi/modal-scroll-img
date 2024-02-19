<?php
/*
Plugin Name: modal scroll tmp
Description: test スクロール画像がモーダル表示
*/ 

// 管理画面にオリジナルメニューを追加する
add_action('admin_menu','register_my_custom_menu_page');

function register_my_custom_menu_page(){
  add_menu_page('モーダル画像1',
  'モーダル画像',
  'level_0',
  'custompage',
  'my_custom_menu_page',
  plugins_url('/img/icon-modal.png',__FILE__),
  99 );

  //非表示のメニュー  画像の追加時に実行
  add_menu_page('モーダルポスト1',
  'モーダルポスト',
  'level_0',
  'custompage-post',
  'post_reseive' //←この関数呼び出し
  );
}

add_action('admin_print_styles',function(){
  echo '<style>
    #toplevel_page_custompage-post{display: none;}
  </style>';
});

//プラグインのURL
$sturl = plugins_url('/modal-scroll-img');
//プラグインまでのパス↓
const STPATH = WP_PLUGIN_DIR .'/modal-scroll-img';
//wp-content/uploadsまでのURLを取得する
$upload_url = wp_upload_dir()['baseurl'];

//非表示のメニュー で呼び出される関数
function post_reseive(){
  global $upload_url;
  include STPATH .'/update-meta.php';//←ポストされたらこれにやりたいことを書く
}

function my_custom_menu_page(){
  require_once 'admin-setting.php';
}

//記事本文をカスタマイズする用のフィルターフック「the_content」は、引数として記事本文のHTMLを引数として受け取ることができます。
add_filter('the_content','the_content_sample');

function the_content_sample($content){
  global $upload_url;
  //option Tableから画像データを取り出す
  $modal_data = get_option('modal_scroll_geoge');
  //この値をアンシリアライズして配列にします
  $modal_data = unserialize($modal_data);
  $img = $modal_data['image_path'];//画像ファイル名
  //var_dump($img); //←DBに入ってる値
  //1つ目のカテゴリID ホントはループして取り出す
  $cat_ID = $modal_data['cat_ID'][0];
  $top = $modal_data['top'];
  $url = $modal_data['url'];

  ob_start();
  include STPATH .'/inc-modal.php';
  $modal = ob_get_contents();//出力バッファの内容を返す
  ob_end_clean();//出力バッファをクリア(消去)し、出力バッOFF
  //ここでカテゴリを取得(ループ外)して分岐します
  $category = get_the_category();
  $cat_id = $category[0]->cat_ID;

  if(is_single() && $cat_ID == $cat_id){
    //投稿ページなら && DBから取り出したカテゴリと一致する
    return $content . $modal;
  }else{
    //一致しない場合は記事のみを返す
    return $content;
  }
}

add_shortcode('short_code_hellow_world_test','hello_world_test');
//[short_code_hello_world_test]←記事内に書く
function hello_world_test(){
  global $upload_url;
  //option Tableから画像データを取り出す
  $modal_data = get_option('modal_scroll_geoge');
  //この値をアンシリアライズして配列にします
  $modal_data = unserialize($modal_data);
  $img = $modal_data['image_path'];//画像ファイル名
  //var_dump($img); //←DBに入ってる値
  //1つ目のカテゴリIDは ホントはループして取り出す
  $cat_ID = $modal_data['cat_ID'][0];
  $top = $modal_data['top'];
  $url = $modal_data['url'];

  include STPATH .'/inc-modal.php';
}