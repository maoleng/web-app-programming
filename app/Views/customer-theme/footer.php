<footer class="footer footer-black footer-big">
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>The Ceenema is a modern cinema that offers a unique movie experience for moviegoers. With state-of-the-art technology, comfortable seating, and a wide selection of movies, The Ceenema provides a perfect escape from the hustle and bustle of everyday life. Whether you're looking to enjoy the latest blockbuster hit or a classic film, The Ceenema has something for everyone. With its friendly staff and welcoming atmosphere, The Ceenema is the ideal place to unwind and enjoy a night out at the movies.</p>
                </div>
                <div class="col-md-4">
                    <h5>Social Feed</h5>
                    <div class="social-feed">
                        <div class="feed-line">
                            <i class="fa fa-facebook-square"></i>
                            <p><a href="https://www.facebook.com/maoleng.bhl/">Bui Huu Loc</a></p>
                        </div>
                        <div class="feed-line">
                            <i class="fa fa-facebook-square"></i>
                            <p><a href="https://facebook.com/100026893044148">Tran Huu Nhan</a></p>
                        </div>
                        <div class="feed-line">
                            <i class="fa fa-facebook-square"></i>
                            <p><a href="https://www.facebook.com/100010725765287">Nhat Tan Vu</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Movie Feed</h5>
                    <div class="gallery-feed">
                        <?php foreach (getMovieFeed() as $movie) : ?>
                            <img src="<?= $movie->bannerPath() ?>" class="img img-raised img-rounded" alt="">
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright pull-right">
            Copyright © <?= now()->year ?> - Loc Nhan Tan All Rights Reserved
        </div>
    </div>
</footer>