<?php 
require_once "config.php";
?>
<?php if(isset($_GET['id'])):
     $newdetail = file_get_contents(server."/index.php?post=".$_GET['id']);
    $detail = json_decode($newdetail, true);
    $new = $detail['result'];

     $commentlist = file_get_contents(server."/index.php?cmt&postid=".$_GET['id']."&cmtdate=desc");
    $comments = json_decode($commentlist, true);
    $cmts = $comments['result'];
    $totalcmt = count($cmts);
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title><?= $new['title'] ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/blue.css">
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>


</head>
<body>

<header class="header-style-1">
    <!-- ============================================== TOP MENU ============================================== -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="index.php">Home</a> </li>
                                <li class="active dropdown yamm-fw"> <a href="/server/writepost.php">Create Post</a> </li>


                                <!--<li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li> -->
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="index.php">Home</a></li>
				<li><a href="index.php?category=<?= $new['cat_id'] ?>"><?= $new['cat_name'] ?></a></li>
				<li class='active'><?= $new['title'] ?></li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="row">
			<div class="blog-page">
				<div class="col-md-9">
					<div class="blog-post wow fadeInUp" style="overflow: hidden;">
						
						<h1><?= $new['title'] ?></h1>
						<span class="author"><?= $new['author'] ?></span>
						<span class="review"><?= $totalcmt ?> Comments</span>
						<span class="date-time"><?= $new['created'] ?></span>
                        <span><a href="/server/update.php?update=<?= $new['post_id'] ?>" style="color: #aaa;">Update</a></span>
                        <span><a href="/server/delete.php?delete=<?= $new['post_id'] ?>" style="color: #aaa;">Delete</a></span>
                        <p><?= $new['content'] ?></p>
						<p><h4>Bài viết liên quan</h4></p>
						<ul>
						<?php 

						 $relatenews = file_get_contents(server."/index.php?category=".$new['cat_id']."&order=rand()&ordertype=desc&limit=0,5");
                    $listnews = json_decode($relatenews, true);
                    foreach($listnews['result'] as $n):
						 ?>
							<li><i class="fa fa-star" aria-hidden="true"></i><a href="detail.php?id=<?= $n['post_id'] ?>"> <?= $n['title'] ?></a></li>
						<?php endforeach; ?>
						</ul>
						<div class="social-media">
							<span>share post:</span>
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-linkedin"></i></a>
							<a href=""><i class="fa fa-rss"></i></a>
							<a href="" class="hidden-xs"><i class="fa fa-pinterest"></i></a>
						</div>
					</div>
					<div class="blog-post-author-details wow fadeInUp">
						<div class="row">
							<div class="col-md-1" style="text-align: right">
								<i class="fa fa-user-o fa-3x" aria-hidden="true"></i>
							</div>
							<div class="col-md-10">
								<h4><?= $new['author'] ?></h4>
								<div class="btn-group author-social-network pull-right">
									<span>Follow me on</span>
									<button type="button" class="dropdown-toggle" data-toggle="dropdown">
										<i class="twitter-icon fa fa-twitter"></i>
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#"><i class="icon fa fa-facebook"></i>Facebook</a></li>
										<li><a href="#"><i class="icon fa fa-linkedin"></i>Linkedin</a></li>
										<li><a href=""><i class="icon fa fa-pinterest"></i>Pinterst</a></li>
										<li><a href=""><i class="icon fa fa-rss"></i>RSS</a></li>
									</ul>
								</div>
								<span class="author-job"></span>
								
							</div>
						</div>
					</div>
						<div class="blog-review wow fadeInUp" id="listcmt">
	<div class="row" id="review">
		<div class="col-md-12">
			<h3 class="title-review-comments"><?= $totalcmt ?> comments</h3>
		</div>
		<?php 
$cmts = $comments['result'];		
		foreach($cmts as $cmt):
		?>
		<div class="col-md-2 col-sm-2" style="text-align: right;">
			<i class="fa fa-user-circle fa-5x" aria-hidden="true"></i>
		</div>
		<div class="col-md-10 col-sm-10 blog-comments outer-bottom-xs">
			<div class="blog-comments inner-bottom-xs">
				<h4><?= $cmt['user_name'] ?></h4>
				<span class="review-action pull-right">
					<?= $cmt['created'] ?>  
				</span>
				<p><?= $cmt['content'] ?></p>
			</div>
			
		</div>

	<?php endforeach; ?>

		
		
		<!-- <div class="post-load-more col-md-12"><a class="btn btn-upper btn-primary" href="#">Load more</a></div> -->
	</div>
</div>					<div class="blog-write-comment outer-bottom-xs outer-top-xs">
	<div class="row">
		<div class="col-md-12">
			<h4>Viết bình luận</h4>
		</div>
		<form class="register-form" id="binhluan" role="form">
		<div class="col-md-6">
				<div class="form-group">
			    <label class="info-title" for="exampleInputName">Tên <span>*</span></label>
			    <input type="text" name="username" class="form-control unicase-form-control text-input" id="username" placeholder="Tên của bạn" required="">
			    <input type="hidden" name="idpost" id="idpost" value="<?= $_GET['id'] ?>">
			  </div>
			
		</div>
		<div class="col-md-6">
			
				<div class="form-group">
			    <label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
			    <input type="email" name="email" class="form-control unicase-form-control text-input" id="email" placeholder="Email của bạn" required="">
			  </div>
			
		</div>
		
		<div class="col-md-12">
			
				<div class="form-group">
			    <label class="info-title" for="exampleInputComments">Nội dung <span>*</span></label>
			    <textarea class="form-control unicase-form-control" id="content" name="content" placeholder="nội dung" required="" ></textarea>
			  </div>
			
		</div>
		<div class="col-md-12 outer-bottom-small m-t-20">
			<button type="button" id="gui" class="btn-upper btn btn-primary checkout-page-button">Gửi</button>
		</div>
		</form>
	</div>
</div>
				</div>
				<div class="col-md-3 sidebar">
					<?php require "sidebar.php" ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-padding social">
                <ul class="link">

                    <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#" title="PInterest"></a></li>
                    <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#" title="Linkedin"></a></li>
                    <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#" title="Youtube"></a></li>
                    <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a></li>
                    <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
                    <li class="gg pull-left"><a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a></li>
                    <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 no-padding">
                <div class="clearfix payment-methods">
                    <ul>
                        <li><img src="http://titstore.dev:2207/public/images/payments/1.png" alt=""></li>
                        <li><img src="http://titstore.dev:2207/public/images/payments/2.png" alt=""></li>
                        <li><img src="http://titstore.dev:2207/public/images/payments/3.png" alt=""></li>
                        <li><img src="http://titstore.dev:2207/public/images/payments/4.png" alt=""></li>
                        <li><img src="http://titstore.dev:2207/public/images/payments/5.png" alt=""></li>
                    </ul>
                </div>
                <!-- /.payment-methods -->
            </div>
        </div>
    </div>
 <script src="assets/js/alert.js" type="text/javascript"></script>
 <script>
 var server = '<?= server ?>';
    $(document).ready(function () {
       $('#gui').on("click", function () {

				$.post({
				    url: server+'/index.php',
				    data: $("#binhluan").serialize(),
				    dataType: 'json',
				    type : 'post',
				    success : function(returnData) {
				        
				    }
				});
				 makeSAlertright("Bình luận thành công!",6000);
				         $("#binhluan")[0].reset();
				         $("#listcmt").load(location.href + " #review");
          });
        });
</script>

<?php endif; ?>
</body>
</html>