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
      <?php foreach (getProducts($pdo) as $product): ?>
        <div class="product-card">
          <?php $img = $product['IMAGEM']; if (strpos($img,'http')!==0) $img = 'assets/images/'.$img; ?>
          <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($product['NOME']) ?>">
          <h4><?= htmlspecialchars($product['NOME']) ?></h4>
          <p>R$ <?= number_format($product['VALOR_UNITARIO'], 2, ',', '.') ?></p>
          <a class="btn" href="add_to_cart.php?id=<?= $product['ID'] ?>">Adicionar</a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php include 'footer.php'; ?>
