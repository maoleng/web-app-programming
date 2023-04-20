<!doctype html>
<html lang="en">
<?php include section('customer-theme.head_tag') ?>
<body class="product-page">
<?php include section('customer-theme.header') ?>

<div class="page-header header-filter" data-parallax="true" filter-color="rose" style="background-image: url('assets/img/bg6.jpg');">
</div>
<div class="section section-gray">
    <div class="container">
        <div class="main main-raised main-product">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="tab-content">
                        <div class="tab-pane active" id="product-page2">
                            <img src="<?= $movie->bannerPath() ?>"/>
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
                        <?php if (authed() === null) { ?>
                            <a href="<?= $movie->trailer ?>" target="_blank" class="btn btn-rose btn-round">Login For Booking&nbsp;<span class="material-icons">login</span></a>
                        <?php } else { ?>
                            <button data-toggle="modal" data-target="#movie" class="btn btn-rose btn-round">Book &nbsp;<span class="material-icons">sell</span></button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="movie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                <h5 class="modal-title" id="myModalLabel">Booking Ticket</h5>
            </div>
            <div class="modal-body">
                <div class="instruction">
                    <div class="row">
                        <div class="col-md-7">
                            <strong>Choose date</strong>
                            <ul class="nav nav-pills nav-pills-rose">
                                <?php foreach (array_keys($show_dates) as $date) : ?>
                                    <li><a href="#<?= $date ?>" data-toggle="tab" aria-expanded="true"><?= $date ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <div class="col-md-5">
                            <div class="picture">
                                <img src="<?= $movie->bannerPath() ?>" alt="Thumbnail Image"  class="img-rounded img-responsive">
                                <p><strong><?= $movie->name ?></strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="instruction">
                    <div class="row">
                        <div class="col-md-12">
                            <strong>Choose Time</strong>
                            <div class="tab-content">
                                <?php foreach ($show_dates as $date => $times) : ?>
                                    <div class="tab-pane" id="<?= $date ?>">
                                        <ul class="nav nav-pills nav-pills-rose">
                                            <?php foreach ($times as $schedule_id => $time) : ?>
                                                <li data-id="<?= $schedule_id ?>" class="btn-choose_schedule"><a href="<?= $time ?>" data-toggle="tab"><?= $time ?></a></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="instruction">
                    <div class="row">
                        <div class="col-md-12">
                            <strong>Choose Ticket Type</strong>
                            <ul class="nav nav-pills nav-pills-rose">
                                <li data-type="1" class="btn-choose_type active"><a href="" data-toggle="tab" aria-expanded="true">2D</a></li>
                                <li data-type="2" class="btn-choose_type"><a href="" data-toggle="tab" aria-expanded="false">3D</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button id="btn-continue" type="button" class="hidden btn btn-info btn-round" data-dismiss="modal">Continue</button>
            </div>
        </div>
    </div>
</div>

<?php include section('customer-theme.footer') ?>
</body>
<?php include section('customer-theme.script') ?>
<script>
    const btn_continue = $('#btn-continue')
    $('.btn-choose_schedule').on('click', function () {
        btn_continue.removeClass('hidden')
    })
    btn_continue.on('click', function () {
        const schedule_id = $('.btn-choose_schedule.active').data('id')
        const type = $('.btn-choose_type.active').data('type')
        $.ajax({
            url: '<?= url('order/choose_schedule') ?>',
            method: 'POST',
            data: {
                schedule_id: schedule_id,
                type: type,
            }
        }).done(function () {
            window.location.href = '<?= url('order/choose_seat') ?>'
        })
    })

</script>
</html>