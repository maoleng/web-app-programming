<!doctype html>
<html lang="en">
<?php include section('admin-theme.head_tag') ?>
<body>
<div class="wrapper">
    <?php include section('admin-theme.side_bar') ?>
    <div class="main-panel">
        <?php include section('admin-theme.header') ?>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <h2 class="title">
                            <b><?= $status === true ? 'Successfully' : 'Error' ?></b>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-pricing card-raised">
                            <div class="card-content">
                                <h2 class="title"><?= $message ?></h2>
                                <div class="icon icon-rose">
                                    <?php if ($status === true) { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 96 960 960" width="48"><path d="M480 976q-85 0-158-30.5T195 861q-54-54-84.5-127T80 576q0-84 30.5-157T195 292q54-54 127-85t158-31q75 0 140 24t117 66l-43 43q-44-35-98-54t-116-19q-145 0-242.5 97.5T140 576q0 145 97.5 242.5T480 916q145 0 242.5-97.5T820 576q0-30-4.5-58.5T802 462l46-46q16 37 24 77t8 83q0 85-31 158t-85 127q-54 54-127 84.5T480 976Zm-59-218L256 592l45-45 120 120 414-414 46 45-460 460Z"/></svg>
                                    <?php } else { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 96 960 960" width="48"><path d="M479.982 776q14.018 0 23.518-9.482 9.5-9.483 9.5-23.5 0-14.018-9.482-23.518-9.483-9.5-23.5-9.5-14.018 0-23.518 9.482-9.5 9.483-9.5 23.5 0 14.018 9.482 23.518 9.483 9.5 23.5 9.5ZM453 623h60V370h-60v253Zm27.266 353q-82.734 0-155.5-31.5t-127.266-86q-54.5-54.5-86-127.341Q80 658.319 80 575.5q0-82.819 31.5-155.659Q143 347 197.5 293t127.341-85.5Q397.681 176 480.5 176q82.819 0 155.659 31.5Q709 239 763 293t85.5 127Q880 493 880 575.734q0 82.734-31.5 155.5T763 858.316q-54 54.316-127 86Q563 976 480.266 976Zm.234-60Q622 916 721 816.5t99-241Q820 434 721.188 335 622.375 236 480 236q-141 0-240.5 98.812Q140 433.625 140 576q0 141 99.5 240.5t241 99.5Zm-.5-340Z"/></svg>
                                    <?php } ?>
                                </div>
                                <?php if ($status === true) { ?>
                                    <h3 class="card-title">
                                        <b>Customer: </b> <?= $ticket->customer_name ?>
                                        <br>
                                        <b>Movie: </b> <?= $ticket->movie_name ?></h3>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include section('admin-theme.script') ?>
<script src="<?= url('public/assets/js/handle_search.js') ?>"></script>
</body>
</html>