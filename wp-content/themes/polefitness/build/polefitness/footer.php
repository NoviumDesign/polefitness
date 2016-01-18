<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package polefitness
 */

?>

  	</div><!-- #content -->
  </div> <!-- wrapper -->

	<footer id="colophon" class="site-footer" role="contentinfo">



    <div class="footer-top">
      <div class="footer-content">
        <div class="footer-logo">
          <img src="<?php header_image() ?>">
        </div>
      </div>
    </div>



    <div class="footer-bottom">
      <div class="footer-content">
        <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu' ) ); ?>
        <?php dynamic_sidebar( 'footer-widget' ); ?>
      </div>
    </div>



	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71154019-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>
