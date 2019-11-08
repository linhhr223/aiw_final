
	<div class="sidebar-module-container">


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
		<!-- ============================================== CATEGORY : END ============================================== -->

	

