<!-- 他のメニュー画面に影響を与えないため -->
<link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<h2>オリジナルメニューページ</h2>
ここに自由にメニューを作成できます。

<form action="admin.php?page=custompage-post" method="post">
  <div class="container w-50">
    
    <div class="input-group">
      <div class="input-group-text">/wp-content/uploads/</div>
      <input type="text" class="form-control" placeholder="2023/08/abc.jpg" name="image_path">
    </div>

    <div class="input-group mt-5 px-5">
      <label>カテゴリ選択(複数可)</label>
      <select class="form-select mx-5" multiple aria-label="Default select example" name="cat_ID[]">
        <?php
        $categories = get_categories();
        foreach($categories as $category){
          echo "<option value='$category->cat_ID'>$category->name</option>";
        }
        ?>
      </select>
    </div>

    <div class="input-group mt-5 px-5">
      <label>表示位置(TOPからのpx指定)</label>
      <input type="text" class="form-control mx-5" value="900" name="top">px
    </div>

    <div class="input-group mt-5">
      <div class="input-group-text">URL</div>
      <input type="url" class="form-control" placeholder="https://abcd.efg?p=123"
    name="url">
    </div>

    <button type="submit" class="btn btn-primary mt-5">Submit</button>
  </div>
</form>  