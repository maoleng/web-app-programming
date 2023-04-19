<!doctype html>
<html lang="en">
<?php view('customer-theme.head_tag') ?>
<body class="product-page">
<?php view('customer-theme.header') ?>

<div class="page-header header-filter" data-parallax="true" filter-color="rose" style="background-image: url('assets/img/bg6.jpg');">
</div>
<div class="section section-gray">
    <div class="container">
        <div class="main main-raised main-product">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="tab-content">
                        <div class="tab-pane active" id="product-page2">
                            <img src="<?= $movie->banner ?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h2 class="title"> <?= $movie->name ?> </h2>
                    <h3 class="main-price">$335</h3>
                    <div id="acordeon">
                        <div class="panel-group" id="accordion">
                            <p><b>Description: </b><?= $movie->description ?></p>
                            <p><b>Duration: </b><?= $movie->duration ?> minutes</p>
                            <p><b>Directors: </b><?= $movie->directors ?></p>
                            <p><b>Actors: </b><?= $movie->actors ?></p>
                            <p><b>Category: </b><?= $movie->prettyCategory() ?></p>
                            <p><b>Premier Date: </b><?= $movie->premieredDate()->format('d-m-Y') ?></p>
                        </div>
                    </div>
                    <div class="row text-right">
                        <a href="<?= $movie->trailer ?>" target="_blank" class="btn btn-rose btn-round">Trailer &nbsp;<span class="material-icons">smart_display</span></a>
                        <button class="btn btn-rose btn-round">Book &nbsp;<span class="material-icons">sell</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php view('customer-theme.footer') ?>
</body>
<?php view('customer-theme.script') ?>
</html>