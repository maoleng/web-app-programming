<?php $old = session()->get('old') ?>

<!doctype html>
<html lang="en">
<?php view('admin-theme.head_tag') ?>
<body>
<div class="wrapper">

    <?php view('admin-theme.side_bar') ?>
    <div class="main-panel">
        <?php view('admin-theme.header') ?>
        <div class="content">
            <button id="oke" class="btn btn-rose btn-fill">Try me!</button>
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">assignment</i>
                        </div>
                        <form method="post" action="<?= url('/admin/movie/store') ?>" enctype="multipart/form-data" class="form-horizontal">
                            <div class="card-content">
                                <h4 class="card-title">
                                    <a href="<?= url('admin/movie') ?>">Manage Movie</a>
                                    >
                                    <a href="<?= url('admin/movie/create') ?>">Add Movie</a>
                                </h4>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">Name</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label"></label>
                                            <input name="name" value="<?= $old['name'] ?? null ?>" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">Description</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label"></label>
                                            <input name="description" value="<?= $old['description'] ?? null ?>" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">Duration</label>
                                    <div class="col-md-3">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label"></label>
                                            <input name="duration" value="<?= $old['duration'] ?? null ?>" type="number" class="form-control" placeholder="minutes">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 label-on-left">Category</label>
                                    <div class="col-md-3">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label"></label>
                                            <select name="category" class="selectpicker" data-style="select-with-transition" title="Choose Category" data-size="7">
                                                <?php foreach ($categories as $key => $category) : ?>
                                                    <option <?= ((string) $key === ($old['category'] ?? null)) ? 'selected' : '' ?> value="<?= $key ?>">
                                                        <?= $category ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">Actors</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label"></label>
                                            <input name="actors" value="<?= $old['actors'] ?? null ?>" type="text" class="form-control" placeholder="Robert Kirkman, Chris McKay, ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">Directors</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label"></label>
                                            <input name="directors" value="<?= $old['directors'] ?? null ?>" type="text" class="form-control" placeholder="Nicolas Cage, Nicholas Hoult, Awkwafina, Ben Schwartz, ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">Premiere Date</label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label class="control-label"></label>
                                            <input name="premiered_date" value="<?= $old['premiered_date'] ?? null ?>" type="text" class="form-control datepicker" placeholder="<?= now()->format('Y-m-d') ?>">
                                            <div id="sliderRegular" class="hidden"></div>
                                            <div id="sliderDouble" class="hidden"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left">Trailer</label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label"></label>
                                            <input name="trailer" value="<?= $old['trailer'] ?? null ?>" type="text" class="form-control" placeholder="https://www.youtube.com/watch?v=PbasE68lqA4">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 25px">
                                    <label class="col-sm-2 label-on-left">Banner</label>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                <img src="<?= url('assets/img/image_placeholder.jpg') ?>" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            <div>
                                                <span class="btn btn-rose btn-round btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="banner" />
                                                </span>
                                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 label-on-left"></label>
                                    <div class="col-sm-10">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label"></label>
                                            <button class="btn btn-primary">Submit</button>
                                            <a href="<?= url('admin/movie') ?>" class="btn btn-danger" style="margin-left: 30px">Cancel<div class="ripple-container"></div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php view('admin-theme.footer') ?>
    </div>
</div>
<?php view('admin-theme.script') ?>
<script>
    <?= alertError() ?>
</script>
</body>

</html>


