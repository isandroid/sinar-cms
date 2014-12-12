<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $judul; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('aset/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('aset/css/signin.css') ?>" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url('aset/js/ie-emulation-modes-warning.js') ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" method="post" action="<?php echo site_url('pengguna/masuk') ?>">
        <h2 class="form-signin-heading">Silakan Masuk</h2>
        <label for="nama_pengguna" class="sr-only">ID Pengguna</label>
        <input name="nama_pengguna" class="form-control" placeholder="ID Pengguna" required="" autofocus="" >
        <label for="kata_kunci" class="sr-only">Kata Kunci</label>
        <input name="kata_kunci" class="form-control" placeholder="Kata Kunci" required="" type="password">
        <div class="<?php echo $kelas; ?>"><?php echo $pesan; ?></div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Masuk!</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url('aset/js/ie10-viewport-bug-workaround.js') ?>"></script>
  

  </body>
</html>