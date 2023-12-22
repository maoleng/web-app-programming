<!doctype html>
<html lang="en">
<?php include section('customer-theme.head_tag') ?>
<body class="section-white">
<?php include section('customer-theme.header') ?>
<div class="cd-section" id="features">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title"><?= $title ?></h2>
                </div>
                <?php foreach ($movies as $movie) : ?>
                    <div class="col-md-3">
                        <div class="card card-product card-plain">
                            <div class="card-image">
                                <a href="<?= $movie->url() ?>">
                                    <img src="<?= $movie->bannerPath() ?>" alt="" />
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
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

</div>
<?php include section('customer-theme.footer') ?>
</body>
<?php include section('customer-theme.script') ?>
</html>