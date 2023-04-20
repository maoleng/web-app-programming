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