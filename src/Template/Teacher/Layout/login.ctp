<!DOCTYPE html>
<html>
<head>
    <title>
        Teacher Login | SchoolClub
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="Teacher login Schoolclub">
    <?php echo $this->Html->css([
        '../adminlte/bootstrap/css/bootstrap.min',
        '../adminlte/bootstrap/css/bootstrap.min',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        '../adminlte/dist/css/AdminLTE.min',
        '../adminlte/plugins/iCheck/square/blue',
    ]);
    ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
    
    <?= $this->fetch('content') ?>
    <?php echo $this->Html->script([
        '../adminlte/plugins/jQuery/jQuery-2.1.4.min',
        '../adminlte/bootstrap/js/bootstrap.min',
        '../adminlte/plugins/iCheck/icheck.min'
    ]);?>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
</body>
</html>
