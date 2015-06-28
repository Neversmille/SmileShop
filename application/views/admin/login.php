<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <title>Вход в панель администрирования</title>
    <!-- Bootstrap -->
    <link href="/asset/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/asset/admin/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="/asset/admin/css/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="/asset/admin/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">

      <form class="form-signin" method="POST" action="/admin/login" id="admin-login">
        <h2 class="form-signin-heading">Авторизация SmileShop</h2>
        <input type="text" class="input-block-level" placeholder="Email" name="email"><?=form_error("email");?>
        <input type="password" class="input-block-level" placeholder="Пароль" name="password"><?=form_error("password");?>
		<?php if (isset($auth_error)) echo $auth_error;?>
        <button class="btn btn-primary" type="submit" name="admin-login">Войти</button>
      </form>

    </div> <!-- /container -->
    <!--/.fluid-container-->
    <script src="/asset/admin/vendors/jquery-1.9.1.min.js"></script>
    <script src="/asset/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="/asset/admin/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
    <script src="/asset/admin/js/scripts.js"></script>
    <!--jQuery Validation-->
    <script src="/asset/admin/js/jquery.validate.js"></script>
    <script src="/asset/admin/js/additional-methods.js"></script>
    <script src=/asset/admin/js/admin-valid-rules.js></script>
    <script>
    $(function() {
        // Easy pie charts
        $('.chart').easyPieChart({animate: 1000});
    });
    </script>
  </body>
</html>
