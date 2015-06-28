<div class="content error-page">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-5">
                <!-- Big 404 text -->
                <div class="big-text">404</div>
                <hr />
            </div>
            <div class="col-md-5 col-sm-5 col-sm-offset-1 col-md-offset-1">
                <h2><span class="color">Во беда =( !!!</span></h2>
                <h4><?=$error;?></h4>
                <hr />
                <!-- Some site links -->
                <div class="horizontal-links">
                    <h5>Посмотрите на сайте чтото другое =)</h5>
                    <a href="<?=base_url();?>">Главная</a> <a href="#">Почитайте о нас</a> <a href="#">Помощь</a> <a href="#">Связаться с нами</a>
                </div>
                <hr />
                <!-- Search form -->
                <div class="form">
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <input type="email" class="form-control" id="search" placeholder="Начните вводить текст">
                        </div>

                        <button type="submit" class="btn btn-default">Поиск</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
