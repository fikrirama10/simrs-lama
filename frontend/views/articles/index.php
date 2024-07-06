<?php 

use yii\helpers\Html;
use yii\helpers\StringHelper;
?>

<section  class="medilife-blog-area section-padding-100">
        <div class="container"style='margin-top:100px;'>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="row">
                        <!-- Single Blog Area -->
						<?php foreach($models as $m): ?>
                        <div class="col-12 col-md-6">
                            <div class="single-blog-area bg-gray mb-50">
                                <!-- Post Thumbnail -->
                                <div class="blog-post-thumbnail">
                                   <?= Html::img(Yii::$app->params['baseUrl'].'/frontend/images/articles/'.$m->Picture,['class'=>'img img-responsive','width'=>'']) ?>
                                    <!-- Post Date -->
                                    <div class="post-date">
                                        <a href="#"><?= date('d F Y',strtotime($m->Created)) ?></a>
                                    </div>
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-author">
                                       
                                    </div>
                                    <a href="#" class="headline"><?= $m->Title ?></a>
                                   <p><?= StringHelper::truncateWords($m->Content, 10, $suffix = '...', $asHtml = false ) ?></p>
                                    <a href="#" class="comments">3 Comments</a>
                                </div>
                            </div>
							<?php endforeach; ?>
                        </div>
                        <!-- Single Blog Area -->
                      
                        <!-- Single Blog Area -->
                        
                        <!-- Single Blog Area -->
                        
                        <!-- Single Blog Area -->
               
                        <!-- Single Blog Area -->
         
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="medilife-blog-sidebar-area">

                        <!-- Search Widget -->
                        <div class="search-widget-area mb-50">
                            <form action="#" method="get">
                                <input type="search" placeholder="Type Any Keywords">
                                <input type="submit" value="Search">
                            </form>
                        </div>

                        <!-- Catagories Widget -->
                        <div class="medilife-catagories-card mb-50">
                            <h5>Categories</h5>
                            <ul class="catagories-menu">
                                <li><a href="#">Radiology</a></li>
                                <li><a href="#">Cardiology</a></li>
                                <li><a href="#">Gastroenterology</a></li>
                                <li><a href="#">Neurology</a></li>
                                <li><a href="#">General surgery</a></li>
                            </ul>
                        </div>

                        <!-- Latest News -->
                        <div class="latest-news-widget-area mb-50">
                            <h5>Latest News</h5>
                            <div class="widget-blog-post">
                                <!-- Single Blog Post -->
                                <div class="widget-single-blog-post d-flex align-items-center">
                                    <div class="widget-post-thumbnail pr-3">
                                        <img src="img/blog-img/ln1.jpg" alt="">
                                    </div>
                                    <div class="widget-post-content">
                                        <a href="#">A big discovery for medicine</a>
                                        <p>Dec 02, 2017</p>
                                    </div>
                                </div>
                                <!-- Single Blog Post -->
                                <div class="widget-single-blog-post d-flex align-items-center">
                                    <div class="widget-post-thumbnail pr-3">
                                        <img src="img/blog-img/ln2.jpg" alt="">
                                    </div>
                                    <div class="widget-post-content">
                                        <a href="#">Dentistry for everybody</a>
                                        <p>Dec 02, 2017</p>
                                    </div>
                                </div>
                                <!-- Single Blog Post -->
                                <div class="widget-single-blog-post d-flex align-items-center">
                                    <div class="widget-post-thumbnail pr-3">
                                        <img src="img/blog-img/ln3.jpg" alt="">
                                    </div>
                                    <div class="widget-post-content">
                                        <a href="#">When it’s time to take pills</a>
                                        <p>Dec 02, 2017</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- medilife Emergency Card -->
                        <div class="medilife-emergency-card bg-img bg-overlay" style="background-image: url(img/bg-img/about1.jpg);">
                            <i class="icon-smartphone"></i>
                            <h2>For Emergency calls</h2>
                            <h3>+12-823-611-8721</h3>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- Pagination Area -->
                    <div class="pagination-area mt-50">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                              
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>