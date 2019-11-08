<?php 
require_once "config.php";
        $page = 1;
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
        }

        if(isset($_GET['category']))
        {
            $allnews = file_get_contents(server."/index.php?category=".$_GET['category']);
            $listtotal = json_decode($allnews, true);
            $getlistnews = file_get_contents(server."/index.php?category=".$_GET['category']."&order=created&ordertype=desc&limit=".$page*postperpage.",".postperpage);
            $listnews = json_decode($getlistnews, true);
            $total = count($listtotal['result']);
            $totalpage = $total/postperpage;
        }
        else {
            $allnews = file_get_contents(server."/index.php?getlist=post&order=created&ordertype=desc");
            $listtotal = json_decode($allnews, true);
            $getlistnews = file_get_contents(server."/index.php?getlist=post&order=created&ordertype=desc&limit=".$page*postperpage.",".postperpage);
            $listnews = json_decode($getlistnews, true);
            $total = count($listtotal['result']);
            $totalpage = $total/postperpage;
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php if(isset($_GET['category'])): ?>
    <title><?= $listnews['catinfo']['cat_name'] ?></title>
<?php elseif(isset($_GET['tag'])): ?>
	 <title>Post for <?= $_GET['tag'] ?></title>
<?php else: ?>
 <title>News</title>
<?php endif; ?>
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
                                <li class="active dropdown yamm-fw"> <a href="/client/index.php" >Home</a> </li>
                                <li class="active dropdown yamm-fw"> <a href="/server/writepost.php" >Create Post</a> </li>
                                <li class="active dropdown yamm-fw"> <a href="index.php" >Update & Delete Post</a> </li>

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
				<li>News</li>
<?php if(isset($_GET['category'])): ?>
				<li><?= $listnews['catinfo']['cat_name'] ?></li>
			<?php endif; ?>
			<?php if(isset($_GET['tag'])): ?>
				<li>Tags</li>
				<li><?= $_GET['tag'] ?></li>
			<?php endif; ?>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="row">
			<div class="blog-page">
				<div class="col-md-9">
					<?php 
					
                    //echo $totalpage;
					foreach($listnews['result'] as $new): ?>
					<div class="blog-post  wow fadeInUp">
						<h1><a href="detail.php?id=<?= $new['post_id'] ?>"><?= $new['title'] ?></a></h1>
						<span class="author"><?= $new['author'] ?></span>
						<span class="date-time"><?= $new['created'] ?></span>
						<p><?php
							if (strlen($new['short_intro']) <=200) {
								echo $new['short_intro'];
							} else {
								echo substr(strip_tags($new['short_intro']), 0, 200) . '...';
							}
							?></p>
						<a href="detail.php?id=<?= $new['post_id'] ?>" class="btn btn-upper btn-primary read-more">read more</a>
					</div>

	<?php endforeach; ?>
					<div class="clearfix blog-pagination filters-container  wow fadeInUp" style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">

						<div class="text-right">
							<div class="pagination-container">
								<ul class="list-inline list-unstyled">
									<li class="prev"><a href="<?php if($page != 0): ?>index.php?page=<?= $page-1 ?><?php else: ?>index.php<?php endif; ?>"><i class="fa fa-angle-left"></i></a></li>
									<?php for($i = 1;$i<=$totalpage;$i++): ?>
									<li <?php if($i == $page): ?> class="active" <?php endif; ?>><a href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
								<?php endfor; ?>
									<li class="next"><a href="index.php?page=<?= $page+1 ?>"><i class="fa fa-angle-right"></i></a></li>
								</ul><!-- /.list-inline -->
							</div><!-- /.pagination-container -->    </div><!-- /.text-right -->

					</div><!-- /.filters-container -->				</div>
				<div class="col-md-3 sidebar">
					<?php require "sidebar.php" ?>
				</div>
				</div>
			</div>
		</div>
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
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
</body>
</html>