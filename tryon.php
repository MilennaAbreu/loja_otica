<?php include 'header.php'; ?>
<main class="container">
  <h2>Provador Virtual</h2>
  <div class="tryon-container">
    <video id="webcam" autoplay playsinline></video>
    <model-viewer id="glasses" src="assets/images/glasses-1-.glb" alt="Glasses" background-color="rgba(0,0,0,0)" camera-controls></model-viewer>
  </div>
</main>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script>
(async function(){
  const video = document.getElementById('webcam');
  try {
    const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
    video.srcObject = stream;
  } catch(e){
    alert('Não foi possível acessar a câmera: ' + e);
    return;
  }

  if ('FaceDetector' in window) {
    const detector = new FaceDetector({ fastMode: true });
    const model = document.getElementById('glasses');

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
    console.log('FaceDetector API não suportada neste navegador');
  }
})();
</script>
<?php include 'footer.php'; ?>
