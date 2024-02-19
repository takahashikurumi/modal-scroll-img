<!-- /martina/wp-content/plugins/modal-scroll-img/inc-modal.php
最初は単体テストする URLも直に開くためのもの -->

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Button trigger modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
  <!--
  WPが入っているディレクトリを取得しなければなりません
  パスを直書きだと別の環境では画像が映らない
  uploadsまでのURL  wp_upload_dir()
  -->
        <a href="<?=$url?>">
        <!--アマゾンのURL とりあえず直書きで-->  
          <img src="<?=$upload_url?>/<?=$img?>" alt="">
        </a>
      </div>
      <div class="modal-footer">
        <button type="button" class="close btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal ボタンを押さなくても最初から出てる状態-->


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    jQuery(function ($) {
      let notYet = true ;  // もう出た､出てないの変数｡ 初回は映る
      // ロード時
      modalShow();

      // スクロール時
      $(window).on("scroll", function() {
        modalShow();
      });

      function modalShow(){
        let y = $(window).scrollTop();
        let top = '<?=$top?>' ;

        console.log(y ,top);
        if(y >= top && notYet ){
          //modalをコードで出す ver4で
          $('#exampleModal').modal(); 
          notYet = false; // グローバルをfalseを代入
          // $('#exampleModal').remove(); モーダルが消えなくなる
          // $('#exampleModal').addClass('show'); モーダルを閉じると一緒になくなる

        }
      }

    });
  })

</script>