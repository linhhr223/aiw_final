
	<div class="sidebar-module-container">
		<div class="search-area outer-bottom-small">
			<form method="get" action="index.php">
				<div class="control-group">
					<input placeholder="Gõ từ khoá" class="search-field" name="tag">
					<a href="#" class="search-button"></a>
				</div>
			</form>
		</div>

<!--		<div class="home-banner outer-top-n outer-bottom-xs">-->
<!--			<img src="--><?//= public_url() ?><!--images/banners/LHS-banner.jpg" alt="Image">-->
<!--		</div>-->
		<!-- ==============================================CATEGORY============================================== -->
		<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
			<h3 class="section-title">Chuyên Mục</h3>
			<div class="sidebar-widget-body m-t-10">
				<div class="accordion">
					<?php
					$getlistcats = file_get_contents(server."/index.php?getlist=category");
                    $listcat = json_decode($getlistcats, true);

					foreach($listcat['result'] as $cat): ?>
					<div class="accordion-group">
						<div class="accordion-heading">
							<a href="index.php?category=<?= $cat['cat_id'] ?>" class="accordion-toggle collapsed">
								<?= $cat['cat_name'] ?>
							</a>
						</div><!-- /.accordion-heading -->

					</div><!-- /.accordion-group -->
					<?php endforeach; ?>
<!---->
<!--					<div class="accordion-group">-->
<!--						<div class="accordion-heading">-->
<!--							<a href="#collapseSix" data-toggle="collapse" class="accordion-toggle collapsed">-->
<!--								Accessories-->
<!--							</a>-->
<!--						</div><!-- /.accordion-heading -->
<!--						<div class="accordion-body collapse" id="collapseSix" style="height: 0px;">-->
<!--							<div class="accordion-inner">-->
<!--								<ul>-->
<!--									<li><a href="#">gaming</a></li>-->
<!--									<li><a href="#">office</a></li>-->
<!--									<li><a href="#">kids</a></li>-->
<!--									<li><a href="#">for women</a></li>-->
<!--								</ul>-->
<!--							</div><!-- /.accordion-inner -->
<!--						</div><!-- /.accordion-body -->
<!--					</div><!-- /.accordion-group -->

				</div><!-- /.accordion -->
			</div><!-- /.sidebar-widget-body -->
		</div><!-- /.sidebar-widget -->
		<!-- ============================================== CATEGORY : END ============================================== -->						<div class="sidebar-widget outer-bottom-xs wow fadeInUp">


			<ul class="nav nav-tabs">
				<li class="active"><a href="#popular" data-toggle="tab">Nổi bật</a></li>
				<li><a href="#recent" data-toggle="tab">Bài viết mới</a></li>
			</ul>
			<div class="tab-content" style="padding-left:0">
				<div class="tab-pane active m-t-20" id="popular">
					<?php
					 $newlist = file_get_contents(server."/index.php?feature&order=created&ordertype=desc&limit=0,3");
					$listnews = json_decode($newlist, true);
					 foreach($listnews['result'] as $new): ?>
					<div class="blog-post " >
						<h4><a href="detail.php?id=<?= $new['post_id'] ?>"><?= $new['title'] ?></a></h4>
<!--						<span class="review">0 Comments</span>-->
						<span class="date-time"><?= $new['created'] ?></span>
						<p><?php
							if (strlen($new['content']) <=70) {
								echo $new['content'];
							} else {
								echo substr(strip_tags($new['content']), 0, 70) . '...';
							}
							?></p>

					</div>
					<?php endforeach; ?>
				</div>

				<div class="tab-pane m-t-20" id="recent">
					<?php
 					$newlist = file_get_contents(server."/index.php?getlist=post&order=created&ordertype=desc&limit=0,3");
					$listnews = json_decode($newlist, true);
					 foreach($listnews['result'] as $new): ?>
						<div class="blog-post " >
							<h4><a href="detail.php?id=<?= $new['post_id'] ?>"><?= $new['title'] ?></a></h4>
							<!--						<span class="review">0 Comments</span>-->
							<span class="date-time"><?= $new['created'] ?></span>
							<p><?php
								if (strlen($new['content']) <=70) {
									echo $new['content'];
								} else {
									echo substr(strip_tags($new['content']), 0, 70) . '...';
								}
								?></p>

						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	

	<div class="sidebar-widget product-tag wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
	<h3 class="section-title">Tags</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="tag-list">
		<?php
 					$taglist = file_get_contents(server."/index.php?getlist=tags&order=rand()&ordertype=desc&limit=0,10");
					$tags = json_decode($taglist, true);
					 foreach($tags['result'] as $tag): ?>					
			<a class="item" title="<?= $tag['word'] ?>" href="index.php?tag=<?= $tag['word'] ?>"><?= $tag['word'] ?></a>
			<?php endforeach; ?>
		</div><!-- /.tag-list -->
	</div><!-- /.sidebar-widget-body -->
</div>