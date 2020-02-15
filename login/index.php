
<!DOCTYPE html>
<html>
<head>
<title>Login Administrador</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

	 <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

	<!-- Custom Theme files -->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
	<!-- //Custom Theme files -->

	<!-- web font -->
	<link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
	<!-- //web font -->
	<link rel="icon" type="image/png" href="../images/icono.png" />

</head>
<body>

<!-- main -->
<div class="w3layouts-main"> 
	<div class="bg-layer">
		<h1>Administrador</h1>
		<div class="header-main">
			<div class="main-icon">
			<a href="../index.php" class="logo"><img src="../images/logo.png" alt="Induscity" class="logo"></a>
			</div>
			<div class="header-left-bottom">
				<form action="../phpmyadmin/loguear.php" method="post">
					<div class="icon1">
						<span class="fa fa-user"></span>
						<input type="text" placeholder="Usuario" name="login" required="" disabled value="ADMINISTRADOR"/>
					</div>
					<div class="icon1">
						<span class="fa fa-lock"></span>
						<input type="password" placeholder="Password"  name="password" required=""/>
					</div>
					<!--<div class="login-check">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i> Keep me logged in</label>
					</div>--><br>
					<div class="bottom">
						<button class="btn">Iniciar</button>
					</div>
					
				</form>	
			</div>
			
		</div>
		
		<!-- copyright -->
		<div class="copyright">
			<p>© 2019 Login . Derechos de autor by <a href="#" target="_blank">Neon</a></p>
		</div>
		<!-- //copyright --> 
	</div>
</div>	
<!-- //main -->

</body>
</html>