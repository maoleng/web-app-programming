<!doctype html>
<html lang="en">
<?php view('admin-theme.head_tag') ?>
<body>
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
                            <h4 class="card-title">Manage Movie</h4>
                            <div class="table-responsive">
                                <a class="btn btn-primary">Add new movie<div class="ripple-container"></div></a>
                                <div style="float:right;width:200px!important"  role="search">
                                    <input type="text" class="form-control" placeholder=" Search ">
                                    <span class="material-input"></span>
                                </div>
                                <table class="table table-shopping">
                                    <thead>
                                    <tr>
                                        <th class="th-description">Banner</th>
                                        <th class="th-description">Name</th>
                                        <th class="th-description">Duration</th>
                                        <th class="th-description">Category</th>
                                        <th class="th-description">Premier date</th>
                                        <th class="th-description">Created At</th>
                                        <th class="text-right">Actions</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($movies['data'] as $movie) : ?>
                                        <tr>
                                        <td>
                                            <div class="img-container">
                                                <img src="<?= $movie->banner ?>" alt="...">
                                            </div>
                                        </td>
                                        <td class="td-name">
                                            <a href="#jacket"><?= $movie->limitName() ?></a>
                                            <br />
                                            <small><?= $movie->actors ?></small>
                                        </td>
                                        <td><?= $movie->duration ?></td>
                                        <td><?= $movie->prettyCategory() ?></td>
                                        <td><?= $movie->premiered_date ?></td>
                                        <td><?= $movie->created_at ?></td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" class="btn btn-info">
                                                <i class="material-icons">person</i>
                                            </button>
                                            <button type="button" rel="tooltip" class="btn btn-success">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" rel="tooltip" class="btn btn-danger">
                                                <i class="material-icons">close</i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination pagination-primary">
                                <li>
                                    <a href="<?= url($movies['meta']['prev_page_url']) ?>"> prev</a>
                                </li>
                                <li class="active">
                                    <a href="javascript:void(0);">
                                        <?= $movies['meta']['current_page'] ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= url($movies['meta']['next_page_url']) ?>"> prev</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php view('admin-theme.footer') ?>
    </div>
</div>
</body>

<?php view('admin-theme.script') ?>


