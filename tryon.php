<?php include 'header.php'; ?>
<main class="container">
  <h2>Provador Virtual</h2>
  <div class="tryon-container">
    <video id="webcam" autoplay playsinline></video>
    <model-viewer id="glasses" src="assets/images/Glasses.obj" alt="Glasses" style="width:50%;height:50%;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);" background-color="rgba(0,0,0,0)" camera-controls></model-viewer>
  </div>
</main>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script>
(async function(){
  try {
    const stream = await navigator.mediaDevices.getUserMedia({ video: true });
    const video = document.getElementById('webcam');
    video.srcObject = stream;
  } catch(e){
    alert('Não foi possível acessar a câmera: ' + e);
  }
})();
</script>
<?php include 'footer.php'; ?>
