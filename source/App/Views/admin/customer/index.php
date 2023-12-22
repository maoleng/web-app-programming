<!doctype html>
<html lang="en">
<?php include section('admin-theme.head_tag') ?>
<body>
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
                                <div class="col-sm-6 col-lg-2" style="float: right">
                                    <input value="<?= request()->get('q') ?>" id="i-search" type="text" class="form-control" placeholder=" Search ">
                                    <span class="material-input"></span>
                                </div>
                            </div>
                            <h4 class="card-title">
                                <a href="<?= url('admin/customer') ?>">Manage Customer</a>
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-shopping">
                                    <thead>
                                    <tr>
                                        <th class="th-description">Name</th>
                                        <th class="th-description">Email</th>
                                        <th class="th-description">Created At</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($customers['data'] as $customer) : ?>
                                        <tr>
                                        <td class="td-name"><?= $customer->name ?></td>
                                        <td><?= $customer->email ?></td>
                                        <td><?= $customer->created_at ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination pagination-primary">
                                <li>
                                    <a href="<?= url($customers['meta']['prev_page_url']).appendQueries() ?>"> prev</a>
                                </li>
                                <?php for ($i = 1; $i <= $customers['meta']['last_page']; $i++): ?>
                                    <?php if ($i === $customers['meta']['current_page']) { ?>
                                        <li class="active">
                                            <a href="javascript:void(0);">
                                                <?= $customers['meta']['current_page'] ?>
                                            </a>
                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <a href="<?= url($customers['meta']['first_page_url'])."?page=$i".appendQueries() ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php endfor ?>
                                <li>
                                    <a href="<?= url($customers['meta']['next_page_url']).appendQueries() ?>"> prev</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include section('admin-theme.footer') ?>
    </div>
</div>
<?php include section('admin-theme.script') ?>
<script src="<?= url('public/assets/js/handle_search.js') ?>"></script>
</body>



</html>