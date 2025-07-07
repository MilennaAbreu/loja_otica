<?php
require 'config.php';
require 'functions.php';
include 'header.php';
?>
<main>
  <section class="hero-slider container">
    <div class="slide active">
      <img src="assets/images/slide1.jpg" alt="Slide 1">
      <div class="slide-caption"><h1>Explore a nova coleção</h1></div>
    </div>
    <div class="slide">
      <img src="assets/images/slide2.jpg" alt="Slide 2">
      <div class="slide-caption"><h1>Estilo icônico</h1></div>
    </div>
    <button class="slider-nav prev">&#10094;</button>
    <button class="slider-nav next">&#10095;</button>
  </section>

  <section class="products-section container">
    <aside class="filters-panel">
      <h3>Filtros</h3>
      <ul>
        <li><button class="filter-toggle">Masculino</button></li>
        <li><button class="filter-toggle">Feminino</button></li>
        <li><button class="filter-toggle">Unissex</button></li>
        <li><button class="filter-toggle">Polarizado</button></li>
      </ul>
    </aside>
    <div class="products-grid">
      <?php foreach(getProducts($pdo) as $product): ?>
        <div class="product-card">
          <img src="<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>">
          <h4><?= $product['name'] ?></h4>
          <p>R$ <?= number_format($product['price'],2,',','.') ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php include 'footer.php'; ?>