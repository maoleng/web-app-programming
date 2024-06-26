<!doctype html>
<html lang="en">
<?php include section('customer-theme.head_tag') ?>
<body class="section-white">
<?php include section('customer-theme.header') ?>
<div class="section"></div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="text-center">
            <h3 class="title">Choose Seats</h3>
            <p class="description">
                <u><b>THE SCREEN</b></u>
            </p>
        </div>
        <div class="card card-raised card-form-horizontal">
            <div class="card-content">
                <?php $count = 0 ?>
                <?php foreach ($tickets as $ticket) : ?>
                    <?php
                        if ($count === 9) {
                            echo '<br><br>';
                            $count = 0;
                        }
                        $count++;
                    ?>
                    <?php if ((int) $ticket->is_bought) { ?>
                        <button class="btn btn-danger disabled">&nbsp;X&nbsp;<div class="ripple-container"></div></button>
                    <?php } elseif (in_array($ticket->id, $chosen_tickets, true)) { ?>
                        <a href="<?= url('order/choose_seat/').$ticket->id ?>" class="btn btn-primary">
                            <?= $ticket->seatName() ?>
                            <div class="ripple-container"></div>
                        </a>
                    <?php } else { ?>
                        <a href="<?= url('order/choose_seat/').$ticket->id.'?type=choose' ?>" class="btn btn-primary btn-simple">
                            <?= $ticket->seatName() ?>
                            <div class="ripple-container"></div>
                        </a>
                    <?php } ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<div class="text-center">
    <a style="" href="<?= url('order/choose_combo') ?>" class="btn btn-info btn-round">Continue<div class="ripple-container"></div></a>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card card-raised card-form-horizontal">
            <?php include section('customer.order.order_information') ?>
        </div>
    </div>
</div>
</body>
<?php include section('customer-theme.script') ?>
</html>