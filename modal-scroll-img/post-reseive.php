<?php

//$_POSTは元々配列なのでこれでOK
$serialzie = serialize($_POST);
$res = false ;

//画像ファイルが存在するか
//["image_path"]=> string(12) "asfd/asf.jpg"
$upload_path = wp_upload_dir()["basedir"];
//var_dump($upload_path . '/' . $_POST['image_path'],file_exists($upload_path . '/' . $_POST['image_path']));

if(!empty($_POST['image_path'])
&& file_exists($upload_path . '/' . $_POST['image_path'])){
  //↓これでoptionsテーブルに入る、無ければ追加になる
  $res = update_option('modal_scroll_geoge',$serialzie);
}

if($res){
  echo "追加しました";
}else{
  echo "追加できませんでした";
}