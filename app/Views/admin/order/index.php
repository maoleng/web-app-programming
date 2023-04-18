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
                                <div class="col-sm-6 col-lg-2" style="float: right">
                                    <a href="" class="dropdown-toggle btn btn-primary btn-round" data-toggle="dropdown">Dropdown
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-left">
                                        <?php foreach ($status as $key => $each) : ?>
                                            <li>
                                                <a href="">
                                                    <?= $each ?>
                                                </a>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>
                            <h4 class="card-title">
                                <a href="<?= url('admin/order') ?>">Manage Order</a>
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-shopping">
                                    <thead>
                                    <tr>
                                        <th class="th-description">Name</th>
                                        <th class="th-description">Email</th>
                                        <th class="th-description">Is Paid</th>
                                        <th class="th-description">Status</th>
                                        <th class="th-description">Total</th>
                                        <th class="th-description">Ordered At</th>
                                        <th class="text-right">Actions</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($orders['data'] as $order) : ?>
                                        <tr>
                                        <td class="td-name"><?= $order->name ?></td>
                                        <td><?= $order->email ?></td>
                                        <td>
                                            <span data-href="<?= url('admin/order/update_payment')."?id=$order->id" ?>" class="checkbox btn-update_payment <?= (int) $order->is_paid ? 'disabled' : '' ?> ">
                                                <label>
                                                    <input <?= (int) $order->is_paid ? 'checked disabled' : '' ?> type="checkbox">
                                                </label>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label"></label>
                                                <select name="category" class="selectpicker" data-style="select-with-transition" title="Choose Category" data-size="3">
                                                    <?php foreach ($status as $key => $each) : ?>
                                                        <option <?= (string) $key === $order->status ? 'selected' : '' ?> value="<?= $key ?>">
                                                            <?= $each ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td><?= prettyMoney($order->total) ?></td>
                                        <td><?= $order->ordered_at ?></td>
                                        <td class="td-actions text-right">
                                            <a href="<?= url('admin/movie/').$order->id ?>" type="button" rel="tooltip" class="btn btn-success">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination pagination-primary">
                                <li>
                                    <a href="<?= url($orders['meta']['prev_page_url']) ?>"> prev</a>
                                </li>
                                <li class="active">
                                    <a href="javascript:void(0);">
                                        <?= $orders['meta']['current_page'] ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= url($orders['meta']['next_page_url']) ?>"> prev</a>
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
    $('.btn-update_payment').on('click', function () {
        if (! $(this).hasClass('disabled')) {
            window.location.href = $(this).data('href')
        }
    })
</script>
</body>



</html>