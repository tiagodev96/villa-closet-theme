<footer class="footer">
  <img class="logo" src="<?= get_stylesheet_directory_uri(''); ?>/img/villacloset-logo-white.png" alt="Logo Villa Closet">

  <div class="container footer-info">
    <section>
      <h3>Páginas</h3>
      <?php wp_nav_menu([
        'menu' => 'footer',
        'container' => 'nav',
        'container_class' => 'footer-menu',
      ]); ?>
    </section>

    <section>
      <h3>Redes Sociais</h3>
      <?php wp_nav_menu([
        'menu' => 'redes',
        'container' => 'nav',
        'container_class' => 'footer-redes',
      ]); ?>
    </section>

    <section>
      <h3>Pagamentos</h3>
      <ul>
        <li>PayPal</li>
        <li>PagSeguro</li>
      </ul>
    </section>
  </div>

  <?php
  $countries = WC()->countries;
  $base_address = $countries->get_base_address();
  $base_city = $countries->get_base_city();
  $base_state = $countries->get_base_state();
  $complete_address = "$base_address, $base_city, $base_state";
  ?>

  <small class="footer-copy">Villa Closet &copy; <?= date('Y'); ?> - <?= $complete_address; ?></small>
</footer>

<?php wp_footer(); ?>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>
<script src="<?= get_stylesheet_directory_uri(); ?>/js/slick.js"></script>
<script src="<?= get_stylesheet_directory_uri(); ?>/js/script.js"></script>

</body>

</html>