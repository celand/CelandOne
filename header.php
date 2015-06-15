<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage CelandOne
 * @since CelandOne 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<link rel="stylesheet" href="http://garris.github.io/TremulaJS/dist/Tremula.css">

		<style type="text/css"> @import url(http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz);</style>
		
		<script src="http://garris.github.io/TremulaJS/libs/jquery-min.js"></script>
		<script src="http://garris.github.io/TremulaJS/libs/hammer.js"></script>
		<script src="http://garris.github.io/TremulaJS/libs/jsBezier-0.6.js"></script>

		<script src="http://garris.github.io/TremulaJS/dist/Tremula.js"></script>
	<style> 
	
			
			/* === Tremula Styles === */
		
					/* Note: any gridBox border added must be compensated for by adding negative margin */
					.gridBox{
						border:#fff 10px solid;
						margin-left: -15%;
						margin: 10%;
						
					}
		        
		        .moneyShot{
		          width:100%;
		        }
		
		.boxLabel{display: inline-block;font-size: 13px;font-weight: 100; color:#666;}
		
		
		.doReflect .boxLabel{
			display:inline-block; 
			-webkit-transform: translateZ(0);
		}
		
		.doReflect .gridBox{
			-webkit-box-reflect : below 18px -webkit-gradient(
				linear, left bottom, left top, 
				from(rgba(255,255,255,0.25)), 
				color-stop(0.3, transparent)
			); 
		}
		
					/* .tremulaContainer must have actual dimentionality (set H&W) */
					.tremulaContainer{
						height:60%;
						height:calc(100% - 20px);
						width:100%;
						position:relative;
						top:-20px;
						background-image:url(http://pngimg.com/upload/smoke_PNG962.png);
						background-repeat:no-repeat;
						left:0;
						z-index: 1;
						margin:0px auto;
						border: black solid 0px;
					}
		
					.pageLayoutContainer{
						height:100%;
						width:100%;
						position:fixed;
						float:right;
						margin:0;
						border: black solid 0px;
						min-height: 200px;
					}
	</style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'celandone' ); ?></a>

	<div id="sidebar" class="sidebar">
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif;
				?>
				<button class="secondary-toggle"><?php _e( 'Menu and widgets', 'celandone' ); ?></button>
			</div><!-- .site-branding -->
		</header><!-- .site-header -->

		<?php get_sidebar(); ?>
	</div><!-- .sidebar -->

	<div id="content" class="site-content">