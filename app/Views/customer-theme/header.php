<nav class="navbar navbar-inverse navbar-fixed-top" id="sectionsNav">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="presentation.html">THE CEENEMA</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="index.html">
                        <i class="material-icons">apps</i> Now Showing Movie
                    </a>
                </li>
                <li>
                    <a href="index.html">
                        <i class="material-icons">apps</i> Coming Soon Movie
                    </a>
                </li>
                <?php if (authed() === null) { ?>
                    <li class="button-container">
                        <a href="<?= url('login') ?>" class="btn btn-white btn-round">
                            <span class="material-icons">login</span> Login
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Hello <?= authed()->name ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-with-icons">
                            <li>
                                <a href="examples/landing-page.html">
                                    <span class="material-icons">account_circle</span> Profile
                                </a>
                            </li>
                            <li>
                                <a href="examples/blog-posts.html">
                                    <span class="material-icons">history</span> Order History
                                </a>
                            </li>
                            <li>
                                <a href="<?= url('logout') ?>">
                                    <span class="material-icons">logout</span> Log out
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>