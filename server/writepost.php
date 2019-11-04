<?php 
include_once "config.php";
include_once "functions.php";


$listcat = getlist($dbo,"category");
if($_POST){
	$arr = array(
	"title" => $_POST['title'],
	"author" => $_POST['author'],
	"cat_id" => $_POST['catid'],
	"feature" => $_POST['feature'],
	"short_intro" => $_POST['shortintro'],
	"content" => $_POST['content'],
	"tags" => $_POST['tags']
	);
	insertdb($dbo,"post",$arr);
	$postid = lastinsertid($dbo);
	
	//Tag handle

    $titletags = preg_replace('/([^\pL\pN\ ]+)/u', '', strip_tags($_POST["title"]));
    $tags = preg_split('/\s+/', $titletags);

    $review = preg_replace('/([^\pL\pN\ ]+)/u', '', strip_tags($_POST["shortintro"]));
    $reviewtags =  preg_split('/\s+/', $review);

    $tagarr = explode(',', $_POST["tags"]);
    $tags = array_unique(array_merge($tags,$reviewtags), SORT_REGULAR);
    $tags = array_unique(array_merge($tags,$tagarr), SORT_REGULAR);

    foreach($tags as $item){
        $item = trim($item);
        $checkitem = get_info($dbo,"tags",array("word" => $item));
        if($checkitem == false){
			$arrtag = array("word" => $item);
			insertdb($dbo,"tags",$arrtag);
            $tagid = lastinsertid($dbo);
        }else{
            $tagid = $checkitem['tag_id'];
        }
		$ptags = array("post_id" => $postid,"tag_id" => $tagid);
		$checkposttag  = get_total_where($dbo,"posttags",$ptags);
        if($checkposttag == 0)
        insertdb($dbo,"posttags",$ptags);
    }
	
	echo "Thêm thành công!";
	
}
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="public/css/bootstrap.min.css">
<link rel="stylesheet" href="public/css/main.css">
<link rel="stylesheet" href="public/css/blue.css">
<script src="public/js/jquery.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>

<div class="body-content outer-top-xs" id="content">
    <div class="container" id="contai">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->

           
<form class="form-horizontal" id="addpost" method="post" action="#" accept-charset="utf-8">
<div class="col-md-9" id="listuser">
	<div class="box wow fadeInUp outer-bottom-xs animated" style="visibility: visible; animation-name: fadeInUp;">
		<h3 class="section-title">Viết bài mới</h3>
		<div class="box-body outer-top-xs">
			<div class="form-group">
				<label for="catname" class="col-sm-2 control-label">Tiêu đề *</label>

				<div class="col-sm-9">
					<input class="form-control" id="title" name="title" placeholder="Tiêu đề bài viết" type="text" value="" required="">

				</div>

			</div>
			<div class="form-group">
				<label for="catname" class="col-sm-2 control-label">Tags *</label>

				<div class="col-sm-6">
					<input class="form-control" id="tags" name="tags" placeholder="từ khoá bài viết" type="text" value="" required="">

				</div>
				<div class="col-sm-4">
					Ngăn cách nhau bởi dấu phẩy
				</div>

			</div>
						<div class="form-group">
				<label for="catname" class="col-sm-2 control-label">Shortintro<br/>(<200 từ)</label>

				<div class="col-sm-10" style="padding-top: 10px">
					<textarea name="shortintro"  rows="8" cols="80"></textarea>

				</div>

			</div>
			<div class="form-group">
				<label for="catname" class="col-sm-2 control-label">Nội dung</label>

				<div class="col-sm-12" style="padding-top: 10px">
					<textarea name="content" id="editor1" rows="20" cols="80"></textarea>

				</div>

			</div>


		</div>
	</div></div>
<div class="col-md-3" id="listuser">
	<div class="box wow fadeInUp outer-bottom-xs animated" style="visibility: visible; animation-name: fadeInUp;">
		<h3 class="section-title">Tuỳ chỉnh</h3>
		<div class="box-body outer-top-xs">
				<div class="form-group">
				<label for="catname" class="col-sm-4 control-label">Tác giả *</label>

				<div class="col-sm-9" style="padding-top: 10px">
					<input class="form-control" id="author" name="author" placeholder="Tác giả bài viết" type="text" value="" required="">

				</div>

			</div>
			<div class="form-group">
				<label for="catname" class="col-sm-6 control-label">Chuyên mục</label>

				<div class="col-sm-9" style="padding-top: 10px">
					<select class="form-control" id="catid" name="catid">
					<?php foreach($listcat as $cat): 
					$total = get_total_where($dbo,"post",array("cat_id" => $cat['cat_id']));
					?>
														<option value="<?= $cat['cat_id'] ?>"><?= $cat['cat_name'] ?> (<?= $total ?>)</option>
														<?php endforeach; ?>
												</select>

				</div>

			</div>

			<div class="form-group">
				<label for="catname" class="col-sm-12 control-label" style="text-align: left">Tin nổi bật</label>

				<div class="col-sm-3" style="padding-top: 10px">
					<span><input type="radio" name="feature" class="" value="0"> Có</span>
				</div>
				<div class="col-sm-3" style="padding-top: 10px">
					<span><input type="radio" name="feature" value="1" checked=""> Không</span>
				</div>

			</div>
			<div class="form-group">
				<div class="col-sm-6 col-md-offset-3" style="padding-top: 10px">
				<button type="submit" class="btn checkout-btn btn-primary" style="color: white">Đăng bài</button>
				</div>
			</div>

			

		</div>
	</div></div>
	</form>
<!-- Trigger the modal with a button -->

<script src="http://cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script>
  <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
</div></div></div>