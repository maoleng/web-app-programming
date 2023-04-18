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
                            <div class="row">
                                <div class="col-sm-6 col-lg-2" style="float: right">
                                    <input type="text" class="form-control" placeholder=" Search ">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                            <h4 class="card-title">
                                <a href="<?= url('admin/movie') ?>">Manage Movie</a>
                            </h4>
                            <div class="table-responsive">
                                <a href="<?= url('admin/movie/create') ?>" class="btn btn-primary">Add new movie<div class="ripple-container"></div></a>
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
                                                <img src="<?= $movie->bannerPath() ?>" alt="...">
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
                                            <a href="<?= url('admin/movie/edit/').$movie->id ?>" type="button" rel="tooltip" class="btn btn-success">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <form action="<?= url('admin/movie/destroy/').$movie->id ?>" style="display: inline" method="post">
                                                <button class="btn-delete btn btn-danger" type="button" rel="tooltip">
                                                    <i class="material-icons">close</i>
                                                </button>
                                            </form>
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
<?php view('admin-theme.script') ?>
<script>
    <?= alertSuccess() ?>
    $('.btn-delete').on('click', function(e) {
        const form = $(this).parent()
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Yes, delete it!',
            buttonsStyling: false
        }).then(function() {
            form.submit()
        })
    })
</script>
</body>



</html>