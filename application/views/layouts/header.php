<!-- Header starts -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- Logo. Use class "color" to add color to the text. -->
                <div class="logo">
                    <h1><a href="<?=base_url();?>">Smile<span class="color bold">Shop</span></a></h1>
                    <p class="meta">интернет-шоппинг это просто</p>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-4">

                <!-- Search form -->
                <form role="form">
                    <div class="input-group">
                        <input type="email" class="form-control" id="search1" placeholder="Поиск по сайту...">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">Поиск</button>
                        </span>
                    </div>
                </form>
                <?=$user_widget;?>
            </div>
        </div>
    </div>
</header>
<!--/ Header ends -->
