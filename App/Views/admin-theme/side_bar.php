<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="<?= url('public/assets/img/sidebar-1.jpg') ?>">
    <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
        -->
    <div class="logo">
        <a href="<?= url('admin') ?>" class="simple-text logo-mini">
            MV
        </a>
        <a href="<?= url('admin') ?>" class="simple-text logo-normal">
            The Moovee
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
<!--            <li>-->
<!--                <a href="../dashboard.html">-->
<!--                    <i class="material-icons">dashboard</i>-->
<!--                    <p> Dashboard </p>-->
<!--                </a>-->
<!--            </li>-->
            <li <?= toggleActiveMenu('admin/order') ?>>
                <a href="<?= url('admin/order') ?>">
                    <i class="material-icons">dashboard</i>
                    <p> Order </p>
                </a>
            </li>
            <li <?= toggleActiveMenu('admin/schedule') ?>>
                <a href="<?= url('admin/schedule') ?>">
                    <i class="material-icons">dashboard</i>
                    <p> Schedule </p>
                </a>
            </li>
            <li <?= toggleActiveMenu('admin/movie') ?>>
                <a href="<?= url('admin/movie') ?>">
                    <i class="material-icons">dashboard</i>
                    <p> Movie </p>
                </a>
            </li>
            <li <?= toggleActiveMenu('admin/customer') ?>>
                <a href="<?= url('admin/customer') ?>">
                    <i class="material-icons">dashboard</i>
                    <p> Customer </p>
                </a>
            </li>
<!--            <li>-->
<!--                <a data-toggle="collapse" href="#formsExamples">-->
<!--                    <i class="material-icons">content_paste</i>-->
<!--                    <p> Statistic-->
<!--                        <b class="caret"></b>-->
<!--                    </p>-->
<!--                </a>-->
<!--                <div class="collapse" id="formsExamples">-->
<!--                    <ul class="nav">-->
<!--                        <li>-->
<!--                            <a href="../forms/regular.html">-->
<!--                                <span class="sidebar-mini"> RF </span>-->
<!--                                <span class="sidebar-normal"> Revenue </span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="../forms/extended.html">-->
<!--                                <span class="sidebar-mini"> EF </span>-->
<!--                                <span class="sidebar-normal"> Movie </span>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </li>-->
        </ul>
    </div>
</div>