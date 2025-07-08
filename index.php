<?php
require 'config.php';
require 'functions.php';
$marcaSel = $_GET['marca'] ?? null;
$catSel = $_GET['categoria'] ?? null;
$brands = getBrands($pdo);
$categories = getCategories($pdo);
include 'header.php';
?>
<main>
  <section class="hero-slider">
    <div class="slide active">
      <img src="assets/images/slide1.jpg" alt="Slide 1">
      <div class="slide-caption"><h1>Descubra a Elegância da Nova Coleção</h1></div>
    </div>
    <div class="slide">
      <img src="assets/images/slide2.jpg" alt="Slide 2">
      <div class="slide-caption"><h1>Encontre Seu Estilo Icônico</h1></div>
    </div>
    <button class="slider-nav prev">&#10094;</button>
    <button class="slider-nav next">&#10095;</button>
  </section>

  <section class="info-cards container">
    <div class="info-card">
      <img src="assets/images/icon-delivery.svg" alt="Entregas">
      <p>Entregas para todo o Brasil</p>
    </div>
    <div class="info-card">
      <img src="assets/images/icon-quality.svg" alt="Qualidade">
      <p>Qualidade Garantida</p>
    </div>
    <div class="info-card">
      <img src="assets/images/icon-original.svg" alt="Originais">
      <p>Produtos 100% Originais</p>
    </div>
  </section>

  <section class="products-section container">
    <aside class="filters-panel">
      <h3>Filtros</h3>
      <form method="get">
        <label>Marca
          <select name="marca">
            <option value="">Todas</option>
            <?php foreach ($brands as $b): ?>
              <option value="<?= htmlspecialchars($b) ?>" <?= $b === $marcaSel ? 'selected' : '' ?>><?= htmlspecialchars($b) ?></option>
            <?php endforeach; ?>
          </select>
        </label>
        <label>Categoria
          <select name="categoria">
            <option value="">Todas</option>
            <?php foreach ($categories as $c): ?>
              <option value="<?= htmlspecialchars($c) ?>" <?= $c === $catSel ? 'selected' : '' ?>><?= htmlspecialchars($c) ?></option>
            <?php endforeach; ?>
          </select>
        </label>
        <button class="btn" type="submit">Filtrar</button>
      </form>
    </aside>
    <div class="products-grid">
      <?php foreach (getProducts($pdo, $marcaSel, $catSel) as $product): ?>
        <div class="product-card">
          <?php
            $img = $product['IMAGEM'] ?? '';
            if (!preg_match('/^https?:\/\//', $img)) {
                if ($img !== '' && $img !== null && $img[0] !== '/') {
                    $img = 'assets/images/' . $img;
                }
            }
            if ($img === '' || $img === null) {
                $img = 'assets/images/placeholder.svg';
            }
          ?>
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
