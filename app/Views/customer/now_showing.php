<!doctype html>
<html lang="en">
<?php view('customer-theme.head_tag') ?>
<body class="section-white">
<?php view('customer-theme.header') ?>
<div class="cd-section" id="features">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title">NOW SHOWING MOVIE</h2>
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
                                    <a href="#pablo"><?= $movie->limitName() ?></a>
                                </h4>
                                <div class="footer text-center">
                                    <a href="#pablo" class="btn btn-rose btn-round">
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
        </div>
    </div>

</div>
<?php view('customer-theme.footer') ?>
</body>
<?php view('customer-theme.script') ?>
</html>