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
                                <a href="<?= url('admin/order') ?>">Manage Order</a>
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-shopping">
                                    <thead>
                                    <tr>
                                        <th class="th-description">Name</th>
                                        <th class="th-description">Email</th>
                                        <th class="th-description">Bank</th>
                                        <th class="th-description">Transaction Code</th>
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
                                        <td><?= $order->bank_code ?></td>
                                        <td><?= $order->transaction_code ?></td>
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
                                    <a href="<?= url($orders['meta']['prev_page_url']).appendQueries() ?>"> prev</a>
                                </li>
                                <?php for ($i = 1; $i <= $orders['meta']['last_page']; $i++): ?>
                                    <?php if ($i === $orders['meta']['current_page']) { ?>
                                        <li class="active">
                                            <a href="javascript:void(0);">
                                                <?= $orders['meta']['current_page'] ?>
                                            </a>
                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <a href="<?= url($orders['meta']['first_page_url'])."?page=$i".appendQueries() ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php endfor ?>
                                <li>
                                    <a href="<?= url($orders['meta']['next_page_url']).appendQueries() ?>"> prev</a>
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
        <?php include section('admin-theme.footer') ?>
    </div>
</div>
<?php include section('admin-theme.script') ?>
<script src="<?= url('public/assets/js/handle_search.js') ?>"></script>
<script>
    $('.btn-show').on('click', function() {
        const url = $(this).data('href')
        $.ajax({
            url: url,
        }).done(function (data) {
            const tbody = $('#modal-tbody')
            tbody.empty()
            data.forEach(function (each) {
                let name = each.movie_name ?? each.combo_name
                let image = each.image ?? 'https://static4.depositphotos.com/1012407/370/v/950/depositphotos_3707681-stock-illustration-yellow-ticket.jpg'

                tbody.append(`
                    <tr>
                        <td>
                            <div class="img-container">
                                <img src="${image}" alt="...">
                            </div>
                        </td>
                        <td class="td-name">
                            <span>${name}</span>
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
                `)
            })
            tbody.append(`
                <tr>
                    <td colspan="3"></td>
                    <td class="td-total">
                        Total
                    </td>
                    <td colspan="2" class="td-price">
                        ${prettyMoney(data[0].total)}
                    </td>
                    <td></td>
                </tr>
            `)
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