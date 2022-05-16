<?php
//Template name: Home
get_header(); ?>

<?php
$products_slide = wc_get_products([
  'limit' => 6,
  'tag' => ['slide'],
  'stock_status' => 'instock',
]);

$products_new = wc_get_products([
  'limit' => 3,
  'orderby' => 'date',
  'order' => 'DESC',
  'stock_status' => 'instock',
]);

$products_sales = wc_get_products([
  'limit' => 3,
  'meta_key' => 'total_sales',
  'orderby' => 'meta_value_num',
  'order' => 'DESC',
  'stock_status' => 'instock',
]);

$data = [];

$data['slide'] = format_products($products_slide, 'slide');
$data['lancamentos'] = format_products($products_new, 'medium');
$data['vendas'] = format_products($products_sales, 'medium');

$img_url = get_stylesheet_directory_uri() . '/img';

?>

<?php if (have_posts()) {
  while (have_posts()) {
    the_post(); ?>
    <section class="institucional-slider-section">
      <div class="institucional-slide-container">
        <div>
          <img class="institucional-image" src="<?php the_field('imagem_institucional_1') ?>">
          <img class="institucional-image-mobile" src="<?php the_field('imagem_institucional_1_mobile') ?>">
        </div>
        <div>
          <img class="institucional-image" src="<?php the_field('imagem_institucional_2') ?>">
          <img class="institucional-image-mobile" src="<?php the_field('imagem_institucional_2_mobile') ?>">
        </div>
        <div>
          <img class="institucional-image" src="<?php the_field('imagem_institucional_3') ?>">
          <img class="institucional-image-mobile" src="<?php the_field('imagem_institucional_3_mobile') ?>">
        </div>
      </div>
    </section>

    <section class="slick-slider-section">
      <div>
        <h2 class="subtitulo">Destaques</h2>
        <div class="slick-container">
          <?php foreach ($data['slide'] as $product) { ?>
            <div class="slide-item">
              <img class="slide-image" src="<?= $product['img']; ?>" alt="<?= $product['name']; ?>">
              <div class="slide-info">
                <div class="slide-price-name">
                  <span class="slide-preco"><?= $product['price']; ?></span>
                  <h2 class="slide-nome"><?= $product['name']; ?></h2>
                </div>
                <a class="btn-link" href="<?= $product['link']; ?>">Ver Produto</a>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <section class="container">
      <h2 class="subtitulo">Lançamentos</h2>
      <?php villacloset_product_list($data['lancamentos']) ?>
    </section>

    <section class="container">
      <h2 class="subtitulo">Categorias</h2>
      <div class="category-items">
        <div class="vestidos">
          <img class="grid-image" src="<?php the_field('imagem_vestido') ?>" alt="Categoria de Vestidos">
          <a href="<?= get_term_link((int)'62', 'product_cat') ?>">
            <div class="category-overlay">
              <span class="btn-link">Vestidos</span>
            </div>
          </a>
        </div>
        <div class="conjuntos">
          <img class="grid-image" src="<?php the_field('imagem_conjuntos') ?>" alt="Categoria de Conjuntos">
          <a href="<?= get_term_link((int)'61', 'product_cat') ?>">
            <div class="category-overlay">
              <span class="btn-link">Conjuntos</span>
            </div>
          </a>
        </div>
        <div class="calcas">
          <img class="grid-image" src="<?php the_field('imagem_calcas') ?>" alt="Categoria de Calças">
          <a href="<?= get_term_link((int)'60', 'product_cat') ?>">
            <div class="category-overlay">
              <span class="btn-link">Calças</span>
            </div>
          </a>
        </div>
        <div class="blusas">
          <img class="grid-image" src="<?php the_field('imagem_blusas') ?>" alt="Categoria de Blusas">
          <a href="<?= get_term_link((int)'51', 'product_cat') ?>">
            <div class="category-overlay">
              <span class="btn-link">Blusas</span>
            </div>
          </a>
        </div>
        <div class="shorts">
          <img class="grid-image" src="<?php the_field('imagem_shorts') ?>" alt="Categoria de Shorts">
          <a href="<?= get_term_link((int)'26', 'product_cat') ?>">
            <div class="category-overlay">
              <span class="btn-link">Shorts</span>
            </div>
          </a>
        </div>
        <div class="saias">
          <img class="grid-image" src="<?php the_field('imagem_saias') ?>" alt="Categoria de Saias">
          <a href="<?= get_term_link((int)'21', 'product_cat') ?>">
            <div class="category-overlay">
              <span class="btn-link">Saias</span>
            </div>
          </a>
        </div>
        <div class="blazers">
          <img class="grid-image" src="<?php the_field('imagem_blazers') ?>" alt="Categoria de Blazers">
          <a href="<?= get_term_link((int)'38', 'product_cat') ?>">
            <div class="category-overlay">
              <span class="btn-link">Blazers</span>
            </div>
          </a>
        </div>
        <div class="acessorios">
          <img class="grid-image" src="<?php the_field('imagem_acessorios') ?>" alt="Categoria de Acessórios">
          <a href="<?= get_term_link((int)'59', 'product_cat') ?>">
            <div class="category-overlay">
              <span class="btn-link">Acessórios</span>
            </div>
          </a>
        </div>
      </div>
    </section>

    <section class="container">
      <h2 class="subtitulo">Mais Vendidos</h2>
      <?php villacloset_product_list($data['vendas']) ?>
    </section>

<?php }
} ?>

<?php get_footer(); ?>