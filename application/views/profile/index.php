<div class="items">
  <div class="container">
    <div class="row">

      <div class="col-md-3 col-sm-3 hidden-xs">

        <!-- Sidebar navigation -->
        <h5 class="title">Личный кабинет</h5>
        <!-- Sidebar navigation -->
          <nav>
            <ul id="nav">
              <li <?php if($current=="info") echo "class='color'";?>><a href="<?=base_url().'profile';?>">Личная информация</a></li>
              <li <?php if($current=="history") echo "class='color'";?>><a href="<?=base_url().'profile/history';?>">Список заказов</a></li>
              <li <?php if($current=="security") echo "class='color'";?>><a href="<?=base_url().'profile/security';?>">Безопасность</a></li>
            </ul>
          </nav>

      </div>

<!-- Main content -->
      <div class="col-md-9 col-sm-9">
		<?=$profile_page;?>
      </div>



    </div>
  </div>
</div>
