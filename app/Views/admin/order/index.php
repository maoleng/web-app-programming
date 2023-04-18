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
                                                <select data-href="<?= url('admin/order/update_status')."?id=$order->id" ?>" class="btn-update_status selectpicker" data-style="select-with-transition" title="Choose Category" data-size="3">
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
                                            <span data-href="<?= url('admin/order/').$order->id ?>" class="btn-show btn btn-success" data-toggle="modal" data-target="#modal" type="button" rel="tooltip">
                                                <i class="material-icons">visibility</i>
                                            </span>
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

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="material-icons">clear</i>
                        </button>
                        <h4 class="modal-title">Order Detail</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-shopping">
                                <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th>Product</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Amount</th>
                                    <th class="text-right">Sum</th>
                                </tr>
                                </thead>
                                <tbody id="modal-tbody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Print</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
    $('.btn-update_status').on('change', function () {
        const status = $(this).find(":selected").val();
        window.location.href = $(this).data('href') + `&status=${status}`
    })
    $('.btn-show').on('click', function() {
        const url = $(this).data('href')
        $.ajax({
            url: url,
        }).done(function (data) {
            const tbody = $('#modal-tbody')
            tbody.empty()
            data.forEach(function (each) {
                tbody.append(`
                    <tr>
                        <td>
                            <div class="img-container">
                                <img src="https://static4.depositphotos.com/1012407/370/v/950/depositphotos_3707681-stock-illustration-yellow-ticket.jpg" alt="...">
                            </div>
                        </td>
                        <td class="td-name">
                            <span>${each.name}</span>
                            <br />
                            <small>${each.category}</small>
                        </td>
                        <td class="td-number text-right">
                            ${prettyMoney(each.price)}
                        </td>
                        <td class="td-number">
                            ${each.amount}
                        </td>
                        <td class="td-number">
                            ${prettyMoney(each.sum)}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td class="td-total">
                            Total
                        </td>
                        <td colspan="2" class="td-price">
                            ${prettyMoney(each.total)}
                        </td>
                        <td></td>
                    </tr>
                `)
            })
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