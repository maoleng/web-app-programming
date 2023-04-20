<!doctype html>
<html lang="en">
<?php include section('customer-theme.head_tag') ?>
<body class="section-white">
<?php include section('customer-theme.header') ?>
<div class="header-3">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <div class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="page-header" style="background-image: url('https://www.cgv.vn/media/banner/cache/1/b58515f018eb873dafa430b6f9ae0c1e/9/8/980x448_205.jpg');">
                    </div>
                </div>
                <div class="item">
                    <div class="page-header" style="background-image: url('https://www.cgv.vn/media/banner/cache/1/b58515f018eb873dafa430b6f9ae0c1e/c/g/cgv-q2_980x448_1.jpg');">
                    </div>
                </div>
                <div class="item">
                    <div class="page-header" style="background-image: url('https://www.cgv.vn/media/banner/cache/1/b58515f018eb873dafa430b6f9ae0c1e/9/8/980wx448h_27.jpg');">
                    </div>
                </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <i class="material-icons">keyboard_arrow_left</i>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <i class="material-icons">keyboard_arrow_right</i>
            </a>
        </div>
    </div>
</div>
<div class="cd-section" id="features">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title">COMING SOON MOVIE</h2>
                </div>
                <?php foreach ($movies as $movie) : ?>
                    <div class="col-md-3">
                    <div class="card card-product card-plain">
                        <div class="card-image">
                            <a href="#">
                                <img src="<?= $movie->banner ?>" alt="" />
                            </a>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">
                                <a href="<?= $movie->url() ?>"><?= $movie->limitName() ?></a>
                            </h4>
                            <div class="footer text-center">
                                <a href="<?= $movie->url() ?>" class="btn btn-rose btn-round">
                                    <span class="material-icons">visibility</span> View
                                </a>
                                <a href="#pablo" class="btn btn-rose btn-round">
                                    <span class="material-icons">sell</span> Book
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <a href="<?= url('coming_soon_movie') ?>" class="btn btn-primary btn-round">
                        View more
                        <div class="ripple-container"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- section -->
    <div class="section" id="carousel">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title">Why THE CEENEMA is the best</h2>
                    <h5 class="description">Inspired by the business class seats on the plane, the GOLD CLASS theater was born to bring a luxurious and classy movie space to moviegoers. GOLD CLASS is also the perfect choice for special events to create wonderful, unforgettable memories.</h5>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <!-- Carousel Card -->
                    <div class="card card-raised card-carousel">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <div class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                </ol>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="public/assets/img/bg2.jpg" alt="Awesome Image">
                                        <div class="carousel-caption">
                                            <h4><i class="material-icons">location_on</i> Yellowstone National Park, United States</h4>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="public/assets/img/bg3.jpg" alt="Awesome Image">
                                        <div class="carousel-caption">
                                            <h4><i class="material-icons">location_on</i> Somewhere Beyond, United States</h4>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="public/assets/img/bg.jpg" alt="Awesome Image">
                                        <div class="carousel-caption">
                                            <h4><i class="material-icons">location_on</i> Yellowstone National Park, United States</h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <i class="material-icons">keyboard_arrow_left</i>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Carousel Card -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include section('customer-theme.footer') ?>
</body>
<?php include section('customer-theme.script') ?>
</html>