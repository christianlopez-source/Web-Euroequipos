<?php 
include_once("conexion.php");
session_start();

$_SESSION['mensaje']="";
$mensajee=$_SESSION['mensaje'];

$_SESSION['insert']="";
$minsert=$_SESSION['insert'];

if (!isset($_SESSION['username'])){
    header("Location: ../login/");
}else{$usuario = $_SESSION['username'];}

		$bus_id = "";
        $bus_nombre = "";
        $bus_servicio = "";
        $bus_fecha = "";
        $bus_desci = "";

if(!isset($usuario)){
	header("Location: ../login/");
}else{
$boton_select="";
$boton_insert="";
$boton_update="";
$boton_delete="";
$boton_truncate="";
if(isset($_POST['select']))$boton_select=$_POST['select'];
if(isset($_POST['insert']))$boton_insert=$_POST['insert'];
if(isset($_POST['update']))$boton_update=$_POST['update'];
if(isset($_POST['delete']))$boton_delete=$_POST['delete'];
		 				
				$boton_idEliminar="";
				if(isset($_POST['id']))$boton_idEliminar=$_POST['id'];
				if($boton_idEliminar)
				{
					$id=$_REQUEST['id'];
					$consultadelete = "delete from ".$tableCatalogo." where id ='$id' ";
					$resultadodelete = mysqli_query($conexion,$consultadelete);

					if($resultadodelete){
						mysqli_close($conexion);
						header("Location: index.php");
						//header ("Location: index.php");
					}else{echo "no eliminado";}
				}


		 //BOTON BUSCAR
		 if($boton_select)
    {
		$busqueda = $_REQUEST['busqueda'];
		$consultaselect = "select * from ".$tableCatalogo." where id='$busqueda' LIMIT 1";
		$resultadoselect = mysqli_query($conexion,$consultaselect);
        if($filaselect=mysqli_fetch_array($resultadoselect)){
		$bus_id = $filaselect['id'];  $bus_nombre = $filaselect['nombre'];
        $bus_servicio = $filaselect['tipo_servicio']; $bus_fecha = $filaselect['fecha'];
        $bus_desci = $filaselect['descri']; $mensajee = $_SESSION['mensaje']="SE ENCONTRO UN REGISTRO"; 
		}else{ $bus_id = ""; $bus_nombre = ""; $bus_servicio = ""; $bus_fecha = ""; $bus_desci = ""; $mensajee = $_SESSION['mensaje']="ID NO ENCOTRADO"; }
		mysqli_close($conexion);
	}

		//BOTON INSERTAR
		if($boton_insert)
	{
		$nombre = $_POST['nombre']; $tipo_servi = $_POST['tipo_servi'];
		$fecha = $_POST['fecha']; $fechaFinal = substr($fecha, 8, 2)."/".substr($fecha,5,2)."/".substr($fecha, 0, 4);
		$descri = $_POST['descri'];
		$imagen = addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));
		$query = "INSERT INTO ".$tableCatalogo."(nombre,tipo_servicio,fecha,descri,Imagen) VALUES ('$nombre','$tipo_servi','$fechaFinal','$descri','$imagen')";
		$resultado = $conexion->query($query);
		if($resultado)
		{
			header("Location: index.php");
			$minsert=$_SESSION['insert']="SE AGREGADO UN NUEVO REGISTRO";
			if(mysqli_affected_rows($conexion)==0){
				$mensajee = $_SESSION['mensaje'] = "NO SE PUDO AGREGAR";
			}else{ }
		}
		else
		{  header("Location: index.php"); $mensajee = $_SESSION['mensaje']="NO SE PUDO AGREGAR"; }  
		mysqli_close($conexion);
	}

	    //BOTON ACTUALIZAR
		if($boton_update)
	{
		$nombre = $_POST['nombre']; $tipo_servi = $_POST['tipo_servi'];
		 $descri = $_POST['descri'];
		$busqueda = $_POST['busqueda'];
		//$fechaFinal = substr($fecha, 8, 2)."/".substr($fecha,5,2)."/".substr($fecha, 0, 4);
		//$imagen = addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));
		if(isset($_POST['op1'])){
		    $fecha = $_POST['fecha'];
		    $fechaFinal = substr($fecha, 8, 2)."/".substr($fecha,5,2)."/".substr($fecha, 0, 4);
			$query = "UPDATE ".$tableCatalogo." SET nombre='$nombre',tipo_servicio='$tipo_servi',fecha='$fechaFinal',descri='$descri' WHERE id='$busqueda'";
			$resultado = $conexion->query($query);
			if($resultado){ header("Location: index.php"); $mensajee = $_SESSION['mensaje']="SE ACTUALIZAO UN REGISTRO";}
			else { header("Location: index.php"); $mensajee = $_SESSION['mensaje']="NO SE PUDO ACTUALIZO";}	
		}elseif(isset($_POST['op2'])){
		    $imagen = addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));
			$query = "UPDATE ".$tableCatalogo." SET nombre='$nombre',tipo_servicio='$tipo_servi',descri='$descri',Imagen='$imagen' WHERE id='$busqueda'";
			$resultado = $conexion->query($query);
			if($resultado){ header("Location: index.php"); $mensajee = $_SESSION['mensaje']="SE ACTUALIZAO UN REGISTRO";}
			else { header("Location: index.php"); $mensajee = $_SESSION['mensaje']="NO SE PUDO ACTUALIZO";}	
		}else{
		    $fecha = $_POST['fecha'];
		    $fechaFinal = substr($fecha, 8, 2)."/".substr($fecha,5,2)."/".substr($fecha, 0, 4);
		    $imagen = addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));
            $query = "UPDATE ".$tableCatalogo." SET nombre='$nombre',tipo_servicio='$tipo_servi',fecha='$fechaFinal',descri='$descri',Imagen='$imagen' WHERE id='$busqueda'";
			$resultado = $conexion->query($query);
			if($resultado){ header("Location: index.php"); $mensajee = $_SESSION['mensaje']="SE ACTUALIZAO UN REGISTRO";}
			else { header("Location: index.php"); $mensajee = $_SESSION['mensaje']="NO SE PUDO ACTUALIZO";}	
		}	
		mysqli_close($conexion);
	}

	//BOTON ELIMINAR
		if($boton_delete)
	{
		unset($_SESSION["mensaje"]);
		$mensajee = $_SESSION['mensaje']="SEEE ELIMINO UN REGISTRO";
		$id = $_REQUEST['busqueda'];
		$consultadelete = "delete from ".$tableCatalogo." where id ='$id' ";
		$resultadodelete = mysqli_query($conexion,$consultadelete);
		if($resultadodelete){
			header("Location: index.php"); $mensajee = $_SESSION['mensaje']="SE eLLLLL UN REGISTRO";;
			//header ("Location: index.php");
		}else{ header("Location: index.php");$mensajee = $_SESSION['mensaje']="NO SE PUDO ELIMINO";}
		mysqli_close($conexion);
	}
	
		
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="http://demo2.steelthemes.com/induscity/xmlrpc.php">

	<link rel="icon" type="image/png" href="../images/icono.png" />
	<title>SQL Catálago &#8211; Euroequipos</title>
<link rel='dns-prefetch' href='//s.w.org' />
<link rel="alternate" type="application/rss+xml" title="Induscity &raquo; Feed" href="http://demo2.steelthemes.com/induscity/feed/" />
<link rel="alternate" type="application/rss+xml" title="Induscity &raquo; Comments Feed" href="http://demo2.steelthemes.com/induscity/comments/feed/" />
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/2.4\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/2.4\/svg\/","svgExt":".svg","source":{"concatemoji":"http:\/\/demo2.steelthemes.com\/induscity\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.9.7"}};
			!function(a,b,c){function d(a,b){var c=String.fromCharCode;l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,a),0,0);var d=k.toDataURL();l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,b),0,0);var e=k.toDataURL();return d===e}function e(a){var b;if(!l||!l.fillText)return!1;switch(l.textBaseline="top",l.font="600 32px Arial",a){case"flag":return!(b=d([55356,56826,55356,56819],[55356,56826,8203,55356,56819]))&&(b=d([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]),!b);case"emoji":return b=d([55357,56692,8205,9792,65039],[55357,56692,8203,9792,65039]),!b}return!1}function f(a){var c=b.createElement("script");c.src=a,c.defer=c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var g,h,i,j,k=b.createElement("canvas"),l=k.getContext&&k.getContext("2d");for(j=Array("flag","emoji"),c.supports={everything:!0,everythingExceptFlag:!0},i=0;i<j.length;i++)c.supports[j[i]]=e(j[i]),c.supports.everything=c.supports.everything&&c.supports[j[i]],"flag"!==j[i]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[j[i]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(h=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",h,!1),a.addEventListener("load",h,!1)):(a.attachEvent("onload",h),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),g=c.source||{},g.concatemoji?f(g.concatemoji):g.wpemoji&&g.twemoji&&(f(g.twemoji),f(g.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}

.logotext {
	font-size: 15px;
	margin-top: -17px;
	color:white;
	align-content: center;
	font-style: italic;
	left:25px;
	position: absolute;
}
</style>
<link rel='stylesheet' id='flaticon-css'  href='css/flaticon.min.css?ver=1.0.0' type='text/css' media='all' />
<link rel='stylesheet' id='contact-form-7-css'  href='css/styles.css?ver=4.9.2' type='text/css' media='all' />
<link rel='stylesheet' id='rs-plugin-settings-css'  href='css/settings.css?ver=5.4.1' type='text/css' media='all' />
<style id='rs-plugin-settings-inline-css' type='text/css'>
#rs-demo-id {}
</style>
<link rel='stylesheet' id='woocommerce-general-css'  href='css/woocommerce.css?ver=3.4.4' type='text/css' media='all' />
<style id='woocommerce-inline-inline-css' type='text/css'>
.woocommerce form .form-row .required { visibility: visible; }
</style>
<link rel='stylesheet' id='js_composer_front-css'  href='css/js_composer.min.css?ver=5.4.2' type='text/css' media='all' />
<link rel='stylesheet' id='induscity-fonts-css'  href='https://fonts.googleapis.com/css?family=Hind%3A400%2C500%2C600%2C700&#038;subset=latin%2Clatin-ext&#038;ver=20161025' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-css'  href='css/bootstrap.min.css?ver=3.3.7' type='text/css' media='all' />
<link rel='stylesheet' id='fontawesome-css'  href='css/font-awesome.min.css?ver=4.6.3' type='text/css' media='all' />
<link rel='stylesheet' id='photoswipe-css'  href='css/photoswipe.css?ver=3.4.4' type='text/css' media='all' />
<link rel='stylesheet' id='slick-css'  href='css/slick.css?ver=1.8.1' type='text/css' media='all' />
<link rel='stylesheet' id='induscity-css'  href='css/estilo.css?ver=20161025' type='text/css' media='all' />

<link rel="stylesheet" href="css/estilo_poveda.css">
<link rel="stylesheet" href="css/sqlcatalogo.css">
<link rel="stylesheet" href="css/tabla.css">

<link rel="stylesheet" href="css/animate.css">
<style id='induscity-inline-css' type='text/css'>
	/* Color Scheme */
	/* Background Color */
	.main-background-color,
	ul.nav-filter li a.active, ul.nav-filter li a:hover,
	.primary-nav > ul.menu > li.mf-active-menu,
	.numeric-navigation .page-numbers:hover,.numeric-navigation .page-numbers.current,
	.project-nav-ajax .numeric-navigation .page-numbers.next:hover,.project-nav-ajax .numeric-navigation .page-numbers.next:focus,
	.primary-mobile-nav .menu-item-button-link a,
	.mf-btn,
	.mf-btn:hover,.mf-btn:focus,.mf-btn:active,
	.mf-heading-primary:after,
	.mf-heading-primary:after,
	.post-author .box-title:after,
	.post-author .box-title:after,
	.single-post .social-share li a:hover,
	.mf-service-banner:before,
	.single-portfolio .single-project-title:after,
	.single-portfolio .single-project-title:after,
	.error404 .site-content:before,
	.comments-title:after,.comment-reply-title:after,
	.comments-title:after,.comment-reply-title:after,
	.comment-respond .form-submit .submit,
	.comment-respond .form-submit .submit:hover,.comment-respond .form-submit .submit:focus,.comment-respond .form-submit .submit:active,
	.widget_tag_cloud a:hover,
	.service-sidebar .download .item-download:hover,
	.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,
	.woocommerce a.button.disabled,.woocommerce button.button.disabled,
	.woocommerce input.button.disabled,.woocommerce a.button.alt.disabled,.woocommerce button.button.alt.disabled,.woocommerce input.button.alt.disabled,
	.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,
	.woocommerce input.button.alt:hover,.woocommerce a.button.disabled:hover,
	.woocommerce button.button.disabled:hover,.woocommerce input.button.disabled:hover,.woocommerce a.button.alt.disabled:hover,
	.woocommerce button.button.alt.disabled:hover,.woocommerce input.button.alt.disabled:hover,.woocommerce a.button:focus,.woocommerce button.button:focus,
	.woocommerce input.button:focus,.woocommerce a.button.alt:focus,.woocommerce button.button.alt:focus,
	.woocommerce input.button.alt:focus,.woocommerce a.button.disabled:focus,.woocommerce button.button.disabled:focus,
	.woocommerce input.button.disabled:focus,.woocommerce a.button.alt.disabled:focus,.woocommerce button.button.alt.disabled:focus,.woocommerce input.button.alt.disabled:focus,
	.woocommerce a.button:active,.woocommerce button.button:active,.woocommerce input.button:active,.woocommerce a.button.alt:active,.woocommerce button.button.alt:active,
	.woocommerce input.button.alt:active,.woocommerce a.button.disabled:active,.woocommerce button.button.disabled:active,
	.woocommerce input.button.disabled:active,.woocommerce a.button.alt.disabled:active,
	.woocommerce button.button.alt.disabled:active,.woocommerce input.button.alt.disabled:active,
	.woocommerce .cross-sells h2:after,.woocommerce .up-sells h2:after,.woocommerce .cart_totals h2:after,.woocommerce .woocommerce-billing-fields h3:after,
	.woocommerce #order_review_heading:after,.woocommerce #ship-to-different-address:after,
	.woocommerce .cross-sells h2:after,.woocommerce .up-sells h2:after,.woocommerce .cart_totals h2:after,.woocommerce .woocommerce-billing-fields h3:after,
	.woocommerce #order_review_heading:after,.woocommerce #ship-to-different-address:after,
	.woocommerce div.product #reviews #review_form .comment-form .form-submit input.submit,
	.woocommerce div.product #reviews #review_form .comment-form .form-submit input.submit:hover,
	.woocommerce div.product #reviews #review_form .comment-form .form-submit input.submit:focus,
	.woocommerce div.product #reviews #review_form .comment-form .form-submit input.submit:active,
	.woocommerce ul.products li.product .woocommerce-loop-product__link .product-icon,
	.woocommerce ul.products li.product .button:hover:after,
	.woocommerce .widget_product_tag_cloud a:hover,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle:before,
	.woocommerce nav.woocommerce-pagination ul .page-numbers:hover,.woocommerce nav.woocommerce-pagination ul .page-numbers.current,
	.footer-widgets .widget-title:after,
	.footer-widgets .widget-title:after,
	.footer-widgets ul li:hover:before,
	.footer-social a:hover,
	.owl-nav div:hover,
	.owl-dots .owl-dot.active span,.owl-dots .owl-dot:hover span,
	.induscity-office-location-widget .office-switcher,
	.induscity-office-location-widget .office-switcher ul,
	.mf-section-title h2:after,
	.mf-icon-box.icon_style-has-background-color:hover .mf-icon,
	.mf-services-2 .mf-icon,
	.mf-services-2.style-2 .service-title:before,
	.mf-portfolio ul.nav-filter.dark li a.active, .mf-portfolio ul.nav-filter.dark li a:hover,
	.mf-portfolio.style-2 .owl-nav div:hover,
	.mf-portfolio .owl-nav div:hover,
	.mf-testimonial.style-1 .desc,
	.mf-testimonial.style-2 .testimonial-info:hover .desc,
	.mf-pricing .pricing-content a:hover,
	.mf-history .date:before,
	.mf-contact-box .contact-social li:hover a,
	.wpcf7-form input[type="submit"],
	.wpcf7-form input[type="submit"]:hover,.wpcf7-form input[type="submit"]:focus,.wpcf7-form input[type="submit"]:active,
	.mf-list li:before,
	.vc_progress_bar.vc_progress-bar-color-custom .vc_single_bar .vc_bar,
	.induscity-arrow:hover,
	.slick-prev:hover, .slick-prev:focus,
	.slick-next:hover, .slick-next:focus,
	.mf-team .team-member ul li
	{background-color: #f7c02d}

	/* Color */
	blockquote cite,
	blockquote cite span,
	.main-color,
	.header-transparent.header-v2 .site-extra-text .induscity-social-links-widget a:hover,
	.site-extra-text .header-contact i,
	.site-extra-text .induscity-social-links-widget a:hover,
	.main-nav ul.menu > li.current-menu-item > a,.main-nav ul.menu > li.current-menu-parent > a,.main-nav ul.menu > li.current-menu-ancestor > a,.main-nav ul.menu > li:hover > a,
	.main-nav div.menu > ul > li.current_page_item > a,.main-nav div.menu > ul > li:hover > a,
	.header-v3 .main-nav ul.menu > li.current-menu-item > a,.header-v3 .main-nav ul.menu > li.current-menu-parent > a,.header-v3 .main-nav ul.menu > li.current-menu-ancestor > a,.header-v3 .main-nav ul.menu > li:hover > a,
	.header-v4 .main-nav ul.menu > li.current-menu-item > a,.header-v4 .main-nav ul.menu > li.current-menu-parent > a,.header-v4 .main-nav ul.menu > li.current-menu-ancestor > a,.header-v4 .main-nav ul.menu > li:hover > a,
	.post-navigation a:hover,
	.portfolio-navigation .nav-previous a:hover,.portfolio-navigation .nav-next a:hover,
	.project-nav-ajax .numeric-navigation .page-numbers.next,
	.project-nav-ajax .numeric-navigation .page-numbers.next span,
	.primary-mobile-nav ul.menu li.current-menu-item > a,
	.entry-meta a:hover,
	.entry-title:hover a,
	.entry-footer .read-more:hover,
	.entry-footer .read-more:hover i,
	.blog-wrapper.sticky .entry-title:before,
	.service-inner:hover .service-title a,
	.single-portfolio .project-socials a:hover,
	.portfolio-metas i,
	.comment .comment-reply-link:hover,
	.widget_categories a:hover, .widget_recent_comments a:hover, .widget_rss a:hover, .widget_pages a:hover, .widget_archive a:hover, .widget_nav_menu a:hover, .widget_recent_entries a:hover, .widget_meta a:hover, .widget-recent-comments a:hover, .courses-categories-widget a:hover,
	.popular-posts-widget .mini-widget-title h4:hover a,
	.widget-about a:hover,
	.service-sidebar .services-menu-widget li:hover a,.service-sidebar .services-menu-widget li.current-menu-item a,
	.service-sidebar .mf-team-contact i,
	.woocommerce .quantity .increase:hover,.woocommerce .quantity .decrease:hover,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce ul.products li.product .button:hover,
	.woocommerce ul.products li.product .added_to_cart:hover,
	.woocommerce table.shop_table td.product-subtotal,
	.woocommerce .widget_product_categories li:hover,
	.woocommerce .widget_product_categories li:hover > a,
	.woocommerce .widget_top_rated_products ul.product_list_widget li a:hover,
	.woocommerce .widget_recent_reviews ul.product_list_widget li a:hover,
	.woocommerce .widget_products ul.product_list_widget li a:hover,
	.woocommerce .widget_recently_viewed_products ul.product_list_widget li a:hover,
	.woocommerce-checkout #payment .payment_method_paypal .about_paypal,
	.woocommerce-checkout .woocommerce-info a,
	.woocommerce-account .woocommerce-MyAccount-navigation ul li:hover a,.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
	.site-footer .footer-copyright a,
	.footer-widgets ul li:hover > a,
	.footer-widgets .footer-widget-contact .detail i,
	.page-header.has-image h1,
	.page-header.has-image .breadcrumbs,
	.topbar .induscity-social-links-widget a:hover,
	.induscity-office-location-widget .topbar-office li i,
	.mf-services-2 .service-summary > a:hover,
	.mf-services-2 h4:hover a,
	.mf-services-2.style-1 .btn-service-2:hover i,
	.mf-services-2.style-3 .btn-service-2:hover i,
	.mf-services-3.style-1 .vc_service-wrapper:hover i,
	.mf-services-3.style-1 .vc_service-wrapper.featured-box i,
	.mf-services-3.style-1 .on-hover .vc_service-wrapper.featured-box.active i,
	.mf-portfolio.light-version .project-inner:hover .cat-portfolio,
	.mf-portfolio.style-3 .project-title a:hover,
	.mf-testimonial.style-3 .testimonial-avatar .testi-icon,
	.mf-testimonial.style-3 .address,
	.mf-testimonial.style-3 .owl-nav div:hover,
	.mf-testimonial.style-4 .address,
	.mf-counter .mf-icon,
	.mf-counter .counter-content .counter,
	.mf-contact-box .contact-info i,
	.mf-department .department-info i,
	.wpb-js-composer div .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title > a,
	.wpb-js-composer div .vc_tta.vc_tta-accordion .vc_tta-panel:hover .vc_tta-panel-title > a,
	.wpb-js-composer div .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-controls-icon.vc_tta-controls-icon-chevron:after,
	.wpb-js-composer div .vc_tta.vc_tta-accordion .vc_tta-panel:hover .vc_tta-controls-icon.vc_tta-controls-icon-chevron:after,
	.wpb-js-composer div .vc_tta-tabs-position-top.vc_tta-color-white.vc_tta-style-classic .vc_tta-tab.vc_active > a,
	.wpb-js-composer div .vc_tta-tabs-position-top.vc_tta-color-white.vc_tta-style-classic .vc_tta-tab:hover > a,
	.induscity-arrow-2:hover .fa,
	.primary-mobile-nav ul.menu li.current_page_parent > a,
	.primary-mobile-nav ul.menu li.current-menu-item > a,
	.primary-mobile-nav ul.menu li.current-menu-ancestor > a,
	.primary-mobile-nav ul.menu li.current-menu-parent > a,
	.primary-mobile-nav ul.menu li > a:hover
	{color: #f7c02d}

	.woocommerce table.shop_table a.remove:hover
	{color: #f7c02d !important;}

	/* Border */
	ul.nav-filter li a.active, ul.nav-filter li a:hover,
	.numeric-navigation .page-numbers:hover,.numeric-navigation .page-numbers.current,
	.project-nav-ajax .numeric-navigation .page-numbers.next:hover,.project-nav-ajax .numeric-navigation .page-numbers.next:focus,
	.single-post .social-share li a:hover,
	.widget_tag_cloud a:hover,
	.woocommerce .widget_product_tag_cloud a:hover,
	.woocommerce nav.woocommerce-pagination ul .page-numbers:hover,.woocommerce nav.woocommerce-pagination ul .page-numbers.current,
	.footer-social a:hover,
	.owl-nav div:hover,
	.mf-portfolio ul.nav-filter.dark li a.active, .mf-portfolio ul.nav-filter.dark li a:hover,
	.mf-testimonial.style-3 .owl-nav div:hover,
	.mf-contact-box .contact-social li:hover a,
	.owl-dots .owl-dot span,
	.service-inner:before,
	.project-inner:before,
	.mf-testimonial.style-3 .testimonial-avatar .testi-icon,
	.slick-prev:hover, .slick-prev:focus,
	.slick-next:hover, .slick-next:focus
	{border-color: #f7c02d}

	/* Border Bottom */
	.mf-testimonial.style-1 .desc:before,
	.mf-testimonial.style-2 .testimonial-info:hover .desc:before
	{border-bottom-color: #f7c02d}

	/* Border Left */
	.woocommerce-checkout .woocommerce-info,
	.woocommerce .widget_product_categories ul,
	.widget_categories ul, .widget_recent_comments ul,
	.widget_rss ul,
	.widget_pages ul,
	.widget_archive ul,
	.widget_nav_menu ul,
	.widget_recent_entries ul,
	.widget_meta ul,
	.widget-recent-comments ul,
	.courses-categories-widget ul
	{border-left-color: #f7c02d}
	.popular-posts-widget .widget-thumb
	{ cursor: url( images/cursor.png ), auto; }.header-v1 .main-nav ul.menu > li:not(.mf-active-menu), .header-v2 .main-nav ul.menu > li:not(.mf-active-menu), .header-v5 .main-nav ul.menu > li:not(.mf-active-menu) { background-image: url( images/menu-seperate.png); }
</style>
<link rel='stylesheet' id='photoswipe-default-skin-css'  href='css/default-skin.css?ver=3.4.4' type='text/css' media='all' />
<link rel='stylesheet' id='manufactory-style-switcher-css'  href='css/switcher.css?ver=4.9.7' type='text/css' media='all' />
<link rel='stylesheet' id='manufactory-color-switcher-css'  href='css/default.css?ver=4.9.7' type='text/css' media='all' />
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
<script type='text/javascript' src='js/time.js'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/revslider/public/assets/js/jquery.themepunch.tools.min.js?ver=5.4.1'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/revslider/public/assets/js/jquery.themepunch.revolution.min.js?ver=5.4.1'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var wc_add_to_cart_params = {"ajax_url":"\/induscity\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/induscity\/?wc-ajax=%%endpoint%%","i18n_view_cart":"View cart","cart_url":"http:\/\/demo2.steelthemes.com\/induscity\/cart\/","is_cart":"","cart_redirect_after_add":"no"};
/* ]]> */
</script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=3.4.4'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/js_composer/assets/js/vendors/woocommerce-add-to-cart.js?ver=5.4.2'></script>
<!--[if lt IE 9]>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/themes/induscity/js/html5shiv.min.js?ver=3.7.2'></script>
<![endif]-->
<!--[if lt IE 9]>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/themes/induscity/js/respond.min.js?ver=1.4.2'></script>
<![endif]-->
<link rel='https://api.w.org/' href='http://demo2.steelthemes.com/induscity/wp-json/' />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://demo2.steelthemes.com/induscity/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://demo2.steelthemes.com/induscity/wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 4.9.7" />
<meta name="generator" content="WooCommerce 3.4.4" />
<link rel="canonical" href="../nosotros" />
<link rel='shortlink' href='http://demo2.steelthemes.com/induscity/?p=32' />
<link rel="alternate" type="application/json+oembed" href="http://demo2.steelthemes.com/induscity/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fdemo2.steelthemes.com%2Finduscity%2Fabout-us%2F" />
<link rel="alternate" type="text/xml+oembed" href="http://demo2.steelthemes.com/induscity/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fdemo2.steelthemes.com%2Finduscity%2Fabout-us%2F&#038;format=xml" />
	<noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
	<meta name="generator" content="Powered by WPBakery Page Builder - drag and drop page builder for WordPress."/>
<!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="http://demo2.steelthemes.com/induscity/wp-content/plugins/js_composer/assets/css/vc_lte_ie9.min.css" media="screen"><![endif]--><meta name="generator" content="Powered by Slider Revolution 5.4.1 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface." />
		<style type="text/css" id="wp-custom-css">
			/*
You can add your own CSS here.

Click the help icon above to learn more.
*/


.header-v3 .mf-header-item-button, .header-v4 .primary-nav ul.menu li.menu-item-search {display: none}
		</style>
	<style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1508747702557{background-color: #f2f2f2 !important;}.vc_custom_1515471913255{padding-top: 50px !important;padding-bottom: 50px !important;background-image: url(images/action-bg-1.jpg?id=108) !important;}.vc_custom_1510649070067{margin-top: 0px !important;margin-bottom: 0px !important;}.vc_custom_1508989129564{background-color: #f2f2f2 !important;}.vc_custom_1510649215114{margin-top: 0px !important;margin-bottom: 0px !important;}</style><noscript><style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript></head>

<body class="page-template page-template-template-fullwidth page-template-template-fullwidth-php page page-id-32 woocommerce-no-js full-content header-sticky hide-topbar-mobile header-v1 wpb-js-composer js-comp-ver-5.4.2 vc_responsive">
<!--bloqueo de pagina-->

	<div id="page" class="hfeed site">

		
	<div id="mf-header-minimized" class="mf-header-minimized mf-header-v1"></div>
        <div id="menu">
			
		      <ul>
				  <a href="../"><img src="../images/logo-light.png" alt="Logo" width="144"></a>
				 <li><a href="logout.php">Cerrar Session</a></li>
				  <li><a href="../">Inico</a></li>	 
             </ul>
        </div>


	
	<!--<header id="masthead" class="site-header clearfix">
		
<div class="header-main clearfix">
			
<div class="navbar-toggle col-md-3 col-sm-3 col-xs-3"><span id="mf-navbar-toggle" class="navbar-icon">
					<span class="navbars-line"></span>
				</span></div>

	<div class="site-menu container">
		<nav id="site-navigation" class="main-nav primary-nav nav">
			<ul id="menu-primary-menu" class="menu"><li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-has-children menu-item-19 dropdown hasmenu"><a href="../" >Inicio</a>
</li>
<li class="extra-menu-item menu-item-search" >	
		<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-57"><a href="logout.php">Cerrar Sesión</a></li>
		</li>
</ul></nav>
		
</div>	</header>  -- #masthead -->
	<div id="content" class="site-content">
		<!--SQL CATALOGO-->
		<a href="formatear/" class="btn btn-danger" style="position: relative;"> FORMATEAR LA TABLA</a>
		<div class="contenedor" id="forr">
		
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
			<div style="position: absolute; right: 0px; top: 120px">
		   
		   </div>
			  <h2>Base de datos</h2>
			  <h3 class="animated fadeInRight" style="font-size: 15px; color: #FFEDED;"><?php echo $mensajee; ?></h3>
			  <p style="color: #ffff; font-size: 12px;">Este apartado es verificar el ID <strong style="color: #fffg01;">con ello puede actualizar y  eliminar</strong></p>
			  <input type="text" name="busqueda" placeholder="Buscar por ID" value="<?php echo $bus_id; ?>">
			  <input type="submit" id="boton" name="select" value="Buscar"  class="btn btn-primary marginn">
			  <hr>
			  
			  <input type="text" name="nombre" placeholder="Compañia o Empresa" maxlength="23" title="Se concreto con el nombre" value="<?php echo $bus_nombre;?>">
			  <input type="text" name="tipo_servi" placeholder="Tipo de Servicio" maxlength="24" title="Se concreto con el nombre del servicio" value="<?php echo $bus_servicio; ?>"/>
			  <input class="demo" type="date" name="fecha" id="fecha" placeholder="Fecha.." value="<?php echo $bus_fecha; ?>" />
			  
			  <textarea name="descri" placeholder="Escriba una descripción" maxlength="58" title="Se concreto con la descripción"><?php echo $bus_desci; ?></textarea>
			  <input style="color: #fff" type="file" id="Imagen" name="Imagen" />
			  
			  <input type="submit" name="insert" value="Agregar"  class="btn btn-success" >
	         <hr>
			  <p><strong style="color: #ffff; font-size: 10px; margin-bottom: 10px;">Cuando actualice si no quieres perder la fecha o la imagen procure salvarlo.</strong></p>
			  <input style="margin-bottom: 10px;" type="submit" name="update" value="Actualizar"   class="btn btn-warning marginn" > 
			  <label style="color: #fff; margin-right: 7px; margin-left: 12px;"><input type="checkbox" style="display: inline;" name="op2" onClick="if(this.checked == true){ document.getElementById('fecha').disabled = true;} else{document.getElementById('fecha').disabled = false;}"/>Cuidar Fecha</label>
			  <label style="color: #fff; "><input type="checkbox" style="display: inline;" name="op1" onClick="if(this.checked == true){ document.getElementById('Imagen').disabled = true;} else{document.getElementById('Imagen').disabled = false;}"/>Cuidar imagen</label>
		
			  <input type="submit" name="delete" value="Eliminar" class="btn btn-danger marginn" >
		   <br>
		
<!--
			  <button type="submit" class="btn btn-primary marginn" id="select">Buscar</button>
			  <button type="submit" class="btn btn-success marginn" id="insert"> Agegar </button>
			  <button type="button" class="btn btn-warning marginn" id="update">Modificar</button>
			  <button type="button" class="btn btn-danger marginn" name="delete">Eliminar</button>
 -->
			</form>
			
		  </div>
		<hr style="width: 80%; font-weight: 500;  height: 5px; background-color: rgb(247, 192, 45);">
		<form action="proceso_guardar.php" method="POST" enctype="multipart/form-data">
		<h2>AGREGAR Ó ACTUALIZAR</h2>
		<P style="color:red;">solo se puede insertar o actualizar **por ID</P>
		<input type="text" name="busqueda" placeholder="Buscar por ID" require/>
		<input style="color: #fff" type="file" name="Imagen" />
	    <input type="submit" name="insert" value="Agregar"  class="btn btn-success marginn" >
        </form>
		<hr style="width: 50%; font-weight: 500;  height: 10px; background-color: rgb(247, 192, 45);">
		<a href="#forr"><button type="button" class="btn btn-default" ><h3 class="animated shake"><?php echo $mensajee; ?></h3></button></a>
<!--ENVIAR INFORMACION A LA BASE DE DATO-->

<!--FIN DE LA MODIFICAION  A LA BD-->		
<br>
   <!--Tabla buscar-->
   <div id="main-container">
	<table>
		<thead>
			<tr>
			<th>Num #</th><th>Nombre Empresa</th><th>Tipo de servicio</th><th>Fecha</th><th>Descripción</th><th>Imagen</th><th>Eliminar</th>
			</tr>
		</thead>
 <?php 
 include ("conexion.php");
   $consultaTable="select * from ".$tableCatalogo;
   $resultadoTable=mysqli_query($conexion,$consultaTable);

   while($filaTable=mysqli_fetch_array($resultadoTable, MYSQLI_ASSOC)){
	$imagenn = $filaTable['Imagen'];
   ?>
		<tr>
			<td><?php echo $filaTable['id'];?> </td><td><?php echo $filaTable['nombre'];?></td><td><?php echo $filaTable['tipo_servicio'];?></td><td><?php echo $filaTable['fecha'];?></td><td><?php $contDescri= strlen($filaTable['descri']); $desc=$filaTable['descri']; if($contDescri>=29){echo substr($desc,0,29)."<br>".substr($desc,29,$contDescri);}else{echo $desc;}?></td><td><img src="<?php if($imagenn!=""){ ?>data:image/jpg;base64, <?php echo base64_encode($filaTable['Imagen']);?><?php }else{?>null.png<?php } ?>" width="100" height="100"></td><td> <span class="fa fa-trash" style="position: relative; color:#d9534f; font-size: 20px; display: line; margin-left: 30px;"></span> <br><a href="sql.php?id=<?php echo $filaTable['id'];?>"><input type="submit" name="id" value="Eliminar"  class="btn btn-danger"></a></td>
		</tr>
   <?php } ?>
	</table>
</div>

	</div><!-- #content -->
<br>
    
	<footer id="colophon" class="site-footer">
		    <div class="container footer-info">
        <div class="footer-copyright">
            Copyright © 2019 Todos los derechos reservados por <a href="#">NEON</a>.        </div>
        <div class="text-right">
                <div class="socials footer-social">
        <a href="https://facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a><a href="https://www.skype.com/" target="_blank"><i class="fa fa-skype"></i></a><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a>    </div>
            </div>
    </div>
    	</footer><!-- #colophon -->

	</div><!-- #page -->

    <div id="modal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="item-detail">
            <div class="modal-dialog woocommerce">
                <div class="modal-content product">
                    <div class="modal-header">
                        <button type="button" class="close fh-close-modal" data-dismiss="modal">&#215;<span
                                    class="sr-only"></span></button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
    </div>
        <div class="primary-mobile-nav" id="primary-mobile-nav" role="navigation">
        <div class="mobile-nav-content">
            <a href="#" class="close-canvas-mobile-panel"></a>
            <ul id="menu-primary-menu-1" class="menu"><li id="menu-item-19" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-58"><a href="../">Inicio</a></li>
			<li class="extra-menu-item menu-item-search" >	
		<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-57"><a href="logout.php">Cerrar Sesión</a></li>
		</li>
		</ul>     </div>
    </div>
        <div id="off-canvas-layer" class="off-canvas-layer"></div>
        <a id="scroll-top" class="backtotop" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
        <div id="pswp" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="pswp__bg"></div>

        <div class="pswp__scroll-wrap">

            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">


                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close"
                            title="Close (Esc)"></button>

                    <button class="pswp__button pswp__button--share"
                            title="Share"></button>

                    <button class="pswp__button pswp__button--fs"
                            title="Toggle fullscreen"></button>

                    <button class="pswp__button pswp__button--zoom"
                            title="Zoom in/out"></button>

                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>

                <button class="pswp__button pswp__button--arrow--left"
                        title="Previous (arrow left)">
                </button>

                <button class="pswp__button pswp__button--arrow--right"
                        title="Next (arrow right)">
                </button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>

            </div>

        </div>

    </div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

			<script type="text/javascript">
		var c = document.body.className;
		c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
		document.body.className = c;
	</script>
	<!--location.reload()-->
<script type="text/javascript">
(function(){
	var ro
})
</script>

	<link rel='stylesheet' id='vc_tta_style-css'  href='http://demo2.steelthemes.com/induscity/wp-content/plugins/js_composer/assets/css/js_composer_tta.min.css?ver=5.4.2' type='text/css' media='all' />
<script type='text/javascript'>
/* <![CDATA[ */
var wpcf7 = {"apiSettings":{"root":"http:\/\/demo2.steelthemes.com\/induscity\/wp-json\/contact-form-7\/v1","namespace":"contact-form-7\/v1"},"recaptcha":{"messages":{"empty":"Please verify that you are not a robot."}},"cached":"1"};
/* ]]> */
</script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=4.9.2'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.70'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js?ver=2.1.4'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var woocommerce_params = {"ajax_url":"\/induscity\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/induscity\/?wc-ajax=%%endpoint%%"};
/* ]]> */
</script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=3.4.4'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var wc_cart_fragments_params = {"ajax_url":"\/induscity\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/induscity\/?wc-ajax=%%endpoint%%","cart_hash_key":"wc_cart_hash_fd3974ab91d53993f4f5731efaa4a2cf","fragment_name":"wc_fragments_fd3974ab91d53993f4f5731efaa4a2cf"};
/* ]]> */
</script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js?ver=3.4.4'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/woocommerce/assets/js/photoswipe/photoswipe.min.js?ver=4.1.1'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/themes/induscity/js/photoswipe-ui.min.js?ver=4.1.1'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/js_composer/assets/lib/waypoints/waypoints.min.js?ver=5.4.2'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/js_composer/assets/lib/bower/isotope/dist/isotope.pkgd.min.js?ver=5.4.2'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-includes/js/imagesloaded.min.js?ver=3.2.0'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/themes/induscity/js/plugins/jquery.counterup.min.js?ver=1.0'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/themes/induscity/js/plugins/jquery.parallax.min.js?ver=1.0'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/themes/induscity/js/plugins/jquery.tabs.js?ver=1.0'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/themes/induscity/js/plugins/owl.carousel.js?ver=1.31'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/themes/induscity/js/plugins/slick.min.js?ver=1.0'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/themes/induscity/js/scripts.min.js?ver=20171013'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/manufactory-style-switcher/js/switcher.js?ver=20170810'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-includes/js/wp-embed.min.js?ver=4.9.7'></script>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js?ver=3.0.22'></script>
<script type='text/javascript'>
WebFont.load({google:{families:['Hind:300,600']}});
</script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min.js?ver=5.4.2'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/js_composer/assets/lib/vc_accordion/vc-accordion.min.js?ver=5.4.2'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/js_composer/assets/lib/vc-tta-autoplay/vc-tta-autoplay.min.js?ver=5.4.2'></script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/induscity-vc-addons//assets/js/owl.carousel.js?ver=2.2.0'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var induscityShortCode = {"history":{"history-slider-5cc7441e863b8":{"nav":true,"dot":false,"autoplay":false,"autoplay_speed":0,"autoplay_timeout":0}},"team":{"team-slider-5cc7441e89014":{"nav":true,"dot":false,"autoplay":false,"autoplay_speed":0,"autoplay_timeout":0,"columns":4,"is_carousel":1}}};
/* ]]> */
</script>
<script type='text/javascript' src='http://demo2.steelthemes.com/induscity/wp-content/plugins/induscity-vc-addons//assets/js/frontend.js?ver=20171018'></script>
</body>
</html>
<?php } ?>


<!-- Dynamic page generated in 1.014 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2019-04-29 18:36:14 -->

<!-- super cache -->