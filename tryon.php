<?php include 'header.php'; ?>
<main class="container">
  <h2>Provador Virtual</h2>
  <div id="error-message" class="error-banner" style="display:none"></div>
  <div class="tryon-container">
    <video id="webcam" autoplay playsinline></video>
    <model-viewer id="glasses" src="assets/images/glasses-1-.glb" alt="Glasses" background-color="rgba(0,0,0,0)" camera-controls></model-viewer>
  </div>
</main>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script>
(async function(){
  const video = document.getElementById('webcam');
  const errorBox = document.getElementById('error-message');
  try {
    const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
    video.srcObject = stream;
  } catch(e){
    errorBox.textContent = 'Não foi possível acessar a câmera: ' + e.message;
    errorBox.style.display = 'block';
    return;
  }

  const model = document.getElementById('glasses');
  if ('FaceDetector' in window) {
    const detector = new FaceDetector({ fastMode: true });
    model.addEventListener('error', (ev) => {
      errorBox.textContent = 'Falha ao carregar o modelo 3D.';
      errorBox.style.display = 'block';
      console.error('Erro no model-viewer', ev);
    });

    async function update() {
      if (video.readyState >= 2) {
        try {
          const faces = await detector.detect(video);
          if (faces.length) {
            const b = faces[0].boundingBox;
            model.style.left = (b.x + b.width / 2) + 'px';
            model.style.top = (b.y + b.height / 2) + 'px';
            model.style.width = (b.width * 1.4) + 'px';
            model.style.height = (b.height * 0.7) + 'px';
          }
        } catch(e) {
          console.log('Detecção falhou', e);
        }
      }
      requestAnimationFrame(update);
    }
    update();
  } else {
    errorBox.textContent = 'FaceDetector API não suportada neste navegador. Posicione os óculos manualmente.';
    errorBox.style.display = 'block';
    console.log('FaceDetector API não suportada neste navegador');

    model.style.left = '50%';
    model.style.top = '50%';
    model.style.width = '250px';
    model.style.height = '120px';
    model.style.pointerEvents = 'auto';

    let dragging = false;
    let offsetX = 0;
    let offsetY = 0;

    model.addEventListener('pointerdown', (e) => {
      dragging = true;
      offsetX = e.clientX - model.offsetLeft;
      offsetY = e.clientY - model.offsetTop;
    });

    window.addEventListener('pointermove', (e) => {
      if (dragging) {
        model.style.left = (e.clientX - offsetX) + 'px';
        model.style.top = (e.clientY - offsetY) + 'px';
      }
    });

    window.addEventListener('pointerup', () => {
      dragging = false;
    });
  }
})();
</script>
<?php include 'footer.php'; ?>
