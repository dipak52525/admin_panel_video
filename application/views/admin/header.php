<!DOCTYPE html>
<html>
<head>
	<title></title>

	    <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>/assets/css/simple_sidebar.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/login.scss">
	
</head>
<body>
	<!-- Page Content -->
  <div id="page-content-wrapper">

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <?php if($this->session->userdata('id')) { ?>
      <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>
        <li><a href="<?= base_url('index.php/Admin/logout');?>" class="btn btn-warning">Logout</a></li>
    <?php } else { ?>
        <h1>Login</h1>
    <?php } ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
</div>
<!-- /#page-content-wrapper -->



</nav>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
</body>
</html>