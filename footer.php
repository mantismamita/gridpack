<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gridpack
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'gridpack' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'gridpack' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s.', 'gridpack' ),'<a href="https://github.com/mantismamita/gridpack">Gridpack</a>' );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<?php if ( $_SERVER['HTTP_HOST'] == 'kirstencassidy.dev'):?>
    <script id="__bs_script__">//<![CDATA[
        document.write("<script async src='http://localhost:3000/browser-sync/browser-sync-client.js?v=2.16.0'><\/script>");
        //]]></script>
<?php endif; ?>

</body>
</html>
