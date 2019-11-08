<?php
require_once "database.php";

$sql = "select * from post where post_id =".$_GET["update"];
$stmt = $dbo->prepare($sql);
$stmt->execute();

$post = $stmt->fetch();
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="../server/public/css/bootstrap.min.css">
<link rel="stylesheet" href="../server/public/css/main.css">
<link rel="stylesheet" href="../server/public/css/blue.css">
<script src="../server/public/js/jquery.min.js"></script>
<script src="../server/public/js/bootstrap.min.js"></script>

<div class="body-content outer-top-xs" id="content">
    <div class="container" id="contai">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->


            <form class="form-horizontal" id="addpost" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>" accept-charset="utf-8">
                <div class="col-md-9" id="listuser">
                    <div class="box wow fadeInUp outer-bottom-xs animated" style="visibility: visible; animation-name: fadeInUp;">
                        <h3 class="section-title">Viết bài mới</h3>
                        <div class="box-body outer-top-xs">
                            <div class="form-group">
                                <input type="hidden" name="id" id="postid" value="<?= $post["cat_id"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="catname" class="col-sm-2 control-label">Tiêu đề *</label>

                                <div class="col-sm-9">
                                    <input class="form-control" id="title" name="title" placeholder="Tiêu đề bài viết" type="text" value="<?= $post["title"]?>" required="">

                                </div>

                            </div>
                            <div class="form-group">
                                <label for="catname" class="col-sm-2 control-label">Tags *</label>

                                <div class="col-sm-6">
                                    <input class="form-control" id="tags" name="tags" placeholder="từ khoá bài viết" type="text" value="<?= $post["tags"] ?>" required="">

                                </div>
                                <div class="col-sm-4">
                                    Ngăn cách nhau bởi dấu phẩy
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="catname" class="col-sm-2 control-label">Shortintro<br/>(<200 từ)</label>

                                <div class="col-sm-10" style="padding-top: 10px">
                                    <textarea name="shortintro"  rows="8" cols="80"><?= $post["short_intro"] ?></textarea>

                                </div>

                            </div>
                            <div class="form-group">
                                <label for="catname" class="col-sm-2 control-label">Nội dung</label>

                                <div class="col-sm-12" style="padding-top: 10px">
                                    <textarea name="content" id="editor1" rows="20" cols="80"><?= $post["content"] ?></textarea>

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
                                    <input class="form-control" id="author" name="author" placeholder="Tác giả bài viết" type="text" value="<?=$post["author"] ?>" required="">

                                </div>

                            </div>
                            <div class="form-group">
                                <label for="catname" class="col-sm-6 control-label">Chuyên mục</label>

                                <div class="col-sm-9" style="padding-top: 10px">
                                    <select class="form-control" id="catid" name="catid">
                                        <?php
                                        $category_sql="select * from category";
                                        $data = $dbo->query($category_sql)->fetchAll();
                                        foreach ($data as $cat){
                                            if($cat["cat_id"] == $post["cat_id"] ){
                                                ?>
                                                <option selected="selected" value="<?= $cat['cat_id'] ?>" id="<?= $cat['cat_id'] ?>"><?= $cat['cat_name'] ?></option>
                                                <?php
                                            }
                                            else

                                        ?>
                                            <option value="<?= $cat['cat_id'] ?>" id="<?= $cat['cat_id'] ?>"><?= $cat['cat_name'] ?></option>
                                        <?php } ?>
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
                                    <button name="submit" type="submit" class="btn checkout-btn btn-primary" style="color: white">Đăng bài</button>
                                </div>
                            </div>

                            <a href="/client/index.php" style="margin-left: 70px;">Home Page</a>



                        </div>
                    </div></div>
            </form>

            <script src="http://cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
        </div>
    </div>
</div>

<?php
    if(isset($_POST["submit"])){
        $title      = $_POST["title"];
        $author     = $_POST["author"];
        $catid      = $_POST["catid"];
        $shortintro = $_POST['shortintro'];
        $content    = $_POST['content'];

        $sql = "update post set title='".$title."', author='".$author."', cat_id = '".$catid."', short_intro='".$shortintro."', content='".$content."';";
        $data = $dbo->prepare($sql);
        $data->execute();
    }
?>


