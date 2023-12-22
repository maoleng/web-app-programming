<?php $old = session()->get('old') ?>

<!doctype html>
<html lang="en">
<?php include section('admin-theme.head_tag') ?>
<body>  <div id="sliderRegular" class="hidden"></div>
<div id="sliderDouble" class="hidden"></div>
<div class="wrapper">
    <?php include section('admin-theme.side_bar') ?>
    <div class="main-panel">
        <?php include section('admin-theme.header') ?>
        <div class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-sm-6 col-lg-1" style="float: right">
                                    <button id="btn-change_date" class="btn btn-primary btn-simple" style="float: right">
                                        Filter
                                    </button>
                                </div>
                                <div class="col-sm-6 col-lg-2" style="float: right">
                                    <div class="form-group">
                                        <?php $date = request()->get('date') ?>
                                        <input id="i-change_date" type="text" class="form-control datepicker" value="<?= $date ?? now()->format('Y-m-d') ?>" placeholder="Filter by date">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-8" style="float: right">
                                    <button data-toggle="modal" data-target="#btn-add_schedule" class="btn btn-primary">Add Schedule<div class="ripple-container"></div></button>
                                </div>

                                <div class="modal fade" id="btn-add_schedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-notice">
                                        <form action="<?= url('admin/schedule') ?>" method="post" class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                                <h5 class="modal-title" id="myModalLabel">Create schedule</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="instruction">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="picture">
                                                                <img id="img-movie" src="<?= url('public/assets/img/image_placeholder.jpg') ?>" alt="Thumbnail Image" class="img-rounded img-responsive">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <strong>Choose movie</strong>
                                                            <p id="p-movie"></p>
                                                            <div class="form-group label-floating is-empty">
                                                                <label class="control-label"></label>
                                                                <select name="movie_id" class="selectpicker" data-style="select-with-transition" title="Choose Movie" data-size="7">
                                                                    <?php foreach ($movies as $movie) : ?>
                                                                        <option <?= (string) $movie->id === ($old['movie_id'] ?? null) ? 'selected' : '' ?> value="<?= $movie->id ?>">
                                                                            <?= $movie->name ?>
                                                                        </option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="instruction">
                                                    <div class="row">
                                                        <input type="hidden" name="date">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <strong>Started At</strong>
                                                                <label class="label-control"></label>
                                                                <input name="started_at" value="<?= $old['started_at'] ?? null ?>" type="text" class="form-control datetimepicker">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <strong>Ended At</strong>
                                                                <label class="label-control"></label>
                                                                <input name="ended_at" value="<?= $old['ended_at'] ?? null ?>" type="text" class="form-control datetimepicker">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer text-center">
                                                <button class="btn btn-primary">Save<div class="ripple-container"></div></button>
                                            </div>
                                        </form>
                                    </div>
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
                                                    <form action="<?= url('admin/schedule/').$schedule->id ?>" method="post" class="modal-content">
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
                                                                    <input type="hidden" name="date" value="<?= $schedule->date ?>">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <strong>Started At</strong>
                                                                            <label class="label-control"></label>
                                                                            <input name="started_at" type="text" class="form-control timepicker" value="<?= $schedule->started_time ?>" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <strong>Ended At</strong>
                                                                            <label class="label-control"></label>
                                                                            <input name="ended_at" type="text" class="form-control timepicker" value="<?= $schedule->ended_time ?>" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer text-center">
                                                            <button class="btn btn-primary">Update<div class="ripple-container"></div></button>
                                                            <button data-href="<?= url('admin/schedule/destroy/').$schedule->id ?>" type="button" class="btn-delete btn btn-danger" style="margin-left: 20px">Delete</button>
                                                        </div>
                                                    </form>
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

        <?php include section('admin-theme.footer') ?>
    </div>
</div>
<?php include section('admin-theme.script') ?>
<script>
    <?= alertSuccess() ?>
    <?= alertError() ?>

    $('#btn-change_date').on('click', function(e) {
        const date = $('#i-change_date').val()
        window.location.href = location.protocol + '//' + location.host + location.pathname + `?date=${date}`
    })

    $('.btn-delete').on('click', function() {
        const href = $(this).data('href')
        $.ajax({
            url: href,
            method: 'POST',
        }).done(function (e) {
            window.location.reload()
        })
    })

    $('select').on('change', function (e) {
        const movie_id = this.value
        $.ajax({
            url: `<?= url('admin/movie/') ?>${movie_id}`,
        }).done(function (data) {
            $('#img-movie').attr('src', data.banner)
            $('#p-movie').html(`Movie duration: ${data.duration} minutes`)
        })
    })

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