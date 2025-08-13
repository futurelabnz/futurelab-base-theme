<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package futurelab-base-theme2
 */

?>
<?php
	require_once get_template_directory() . '/inc/futurelab/futurelab.class.php';

	$futurelab = new \FutureLab\FutureLabCore();

?>

<?php 
	echo $futurelab->get_element_content('footer');
?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
