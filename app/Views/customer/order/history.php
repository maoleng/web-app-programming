<!doctype html>
<html lang="en">
<?php include section('customer-theme.head_tag') ?>
<body class="section-white">
<?php include section('customer-theme.header') ?>
<div class="section">
    <div class="container tim-container">
        <div id="images">
            <div class="title">
                <h2>Order History</h2>
            </div>
        </div>
        <div id="contentAreas" class="cd-section">
            <div id="tables">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Bank Code</th>
                                    <th>Transaction Code</th>
                                    <th>Total</th>
                                    <th>Ordered At</th>
                                    <th class="text-right">View</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orders['data'] as $order) : ?>
                                    <tr>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination-area text-center">
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
</body>
<?php include section('customer-theme.script') ?>
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
</html>