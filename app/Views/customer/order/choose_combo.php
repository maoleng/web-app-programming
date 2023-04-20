<!doctype html>
<html lang="en">
<?php view('customer-theme.head_tag') ?>
<body class="section-white">
<?php view('customer-theme.header') ?>
<div class="section"></div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="text-center">
            <h3 class="title">Choose Combos</h3>
        </div>
        <div class="card card-raised card-form-horizontal">
            <div class="card-content">
                <div class="row">
                    <?php foreach ($combos as $combo) : ?>
                        <div class="col-md-4">
                            <div class="card card-profile">
                                <div class="card-image">
                                    <a href="#pablo">
                                        <img class="img" src="<?= $combo->image ?>">
                                    </a>
                                    <div class="colored-shadow" style="background-image: url('<?= $combo->image ?>'); opacity: 1;"></div><div class="ripple-container"></div></div>

                                <div class="card-content">
                                    <h4 class="card-title"><?= $combo->limitName() ?></h4>
                                    <h6 class="category text-gray">Price: <b><?= prettyMoney($combo->price) ?></b></h6>
                                    <div class="footer">
                                        <button data-id="<?= $combo->id ?>" data-type="increase" <?= $combo->amount >= 10 ? 'disabled' : '' ?> class="btn-choose_combo btn btn-just-icon btn-twitter btn-round">
                                            <svg style="width: 20px;height: 20px" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 96 960 960" width="48"><path d="M450 856V606H200v-60h250V296h60v250h250v60H510v250h-60Z"/></svg>
                                        </button>
                                        <b style="padding: 0px 5px 0px 5px"><?= $combo->amount ?></b>
                                        <button data-id="<?= $combo->id ?>" data-type="decrease" <?= $combo->amount <= 0 ? 'disabled' : '' ?> class="btn-choose_combo btn btn-just-icon btn-google btn-round">
                                            <svg style="width: 20px;height: 20px" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 96 960 960" width="48"><path d="M200 606v-60h560v60H200Z"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="text-center">
    <a style="" href="<?= url('order/choose_seat') ?>" class="btn btn-info btn-round">Back<div class="ripple-container"></div></a>
    <a style="" href="#pablo" class="btn btn-success btn-round">Pay<div class="ripple-container"></div></a>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card card-raised card-form-horizontal">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="picture">
                            <img src="<?= $tickets[0]->banner ?>" alt="Thumbnail Image"  class="img-rounded img-responsive">
                            <p><strong><?= $tickets[0]->name ?></strong></p>
                            <p><?= $tickets[0]->description ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Information</h5>
                        <div class="social-feed">
                            <div class="feed-line">
                                <b>Cinema</b>
                                <p><?= env('APP_NAME') ?></p>
                            </div>
                            <div class="feed-line">
                                <b>Showtime</b>
                                <p><?= $tickets[0]->started_at ?></p>
                            </div>
                            <div class="feed-line">
                                <b>Seats</b>
                                <p><?= $str_seats ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Payment</h5>
                        <div class="social-feed">
                            <div class="feed-line">
                                <b>Ticket</b>
                                <p><?= prettyMoney($tickets_price) ?></p>
                            </div>
                            <div class="feed-line">
                                <b>Combo</b>
                                <p><?= prettyMoney($combos_price) ?></p>
                            </div>
                            <div class="feed-line">
                                <b>Total</b>
                                <p><?= prettyMoney($total) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php view('customer-theme.script') ?>
<script>
    $('.btn-choose_combo').on('click', function () {
        $.ajax({
            url: '<?= url('order/choose_combo') ?>',
            method: 'POST',
            data: {
                combo_id: $(this).data('id'),
                type: $(this).data('type'),
            },
        }).done(function () {
            location.reload()
        })
    })
</script>
</html>