<!doctype html>
<html lang="en">
<?php view('admin-theme.head_tag') ?>
<body>  <div id="sliderRegular" class="hidden"></div>
<div id="sliderDouble" class="hidden"></div>
<div class="wrapper">
    <?php view('admin-theme.side_bar') ?>
    <div class="main-panel">
        <?php view('admin-theme.header') ?>
        <div class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-sm-6 col-lg-2" style="float: right">
                                    <input type="text" class="form-control" placeholder=" Search ">
                                    <span class="material-input"></span>
                                </div>
                                <div class="col-sm-6 col-lg-2" style="float: right">
                                    <a href="" class="dropdown-toggle btn btn-primary btn-round" data-toggle="dropdown">Dropdown
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-left">

                                            <li>
                                                <a href="">
                                                    a
                                                </a>
                                            </li>

                                    </ul>
                                </div>
                            </div>
                            <h4 class="card-title">
                                <a href="<?= url('admin/schedule') ?>">Manage Schedule</a>
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-shopping">
                                    <thead class="text-primary">
                                    <tr>
                                        <?php foreach ($groups as $day_of_week => $schedules) : ?>
                                            <th class="text-center"><?= $day_of_week ?></th>
                                        <?php endforeach ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($groups as $schedules) : ?>
                                        <td class="col-md-1">

                                        <?php foreach ($schedules as $schedule) : ?>
                                            <div data-toggle="modal" data-target="#modal-<?= $schedule->id ?>" class="card" style="cursor: pointer">
                                                <div class="card-header">
                                                    <button type="button" class="close">
                                                        <i class="material-icons">clear</i>
                                                    </button>
                                                </div>
                                                <div class="card-content text-center">
                                                    <img src="<?= $schedule->banner ?>" alt=''>
                                                    <?= $schedule->started_time ?> - <?= $schedule->ended_time ?>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="modal-<?= $schedule->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-notice">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                                            <h5 class="modal-title" id="myModalLabel">Edit schedule</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="instruction">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="picture">
                                                                            <img src="<?= $schedule->banner  ?>" alt="Thumbnail Image" class="img-rounded img-responsive">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <strong><?= $schedule->name ?></strong>
                                                                        <p><?= $schedule->description ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="instruction">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <strong>Started At</strong>
                                                                            <label class="label-control"></label>
                                                                            <input type="text" class="form-control timepicker" value="<?= $schedule->started_time ?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <strong>Ended At</strong>
                                                                            <label class="label-control"></label>
                                                                            <input type="text" class="form-control timepicker" value="<?= $schedule->ended_time ?>" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer text-center">
                                                            <button class="btn btn-primary">Update<div class="ripple-container"></div></button>
                                                            <button class="btn btn-danger" style="margin-left: 20px">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                        </td>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php view('admin-theme.footer') ?>
    </div>
</div>
<?php view('admin-theme.script') ?>
<script>
    <?= alertSuccess() ?>

    function prettyMoney(money)
    {
        const formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        })

        return formatter.format(money)
    }
</script>
</body>



</html>