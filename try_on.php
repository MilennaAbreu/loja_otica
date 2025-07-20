<?php
include 'header.php';
?>
<main class="container">
  <h1>Provador Virtual</h1>
    <div id="ar-container">
      <a-scene mindar-face="autoStart: false" embedded color-space="sRGB" vr-mode-ui="enabled: false" device-orientation-permission-ui="enabled: true">
        <a-assets>
          <a-asset-item id="glassesModel" src="assets/images/glasses-1-.glb"></a-asset-item>
        </a-assets>
        <a-camera active="false" position="0 0 0"></a-camera>
        <a-entity mindar-face-target="anchorIndex: 168">
          <a-gltf-model src="#glassesModel" rotation="0 0 0" position="0 -0.4 0.5" scale="0.75 0.75 0.75"></a-gltf-model>
        </a-entity>
      </a-scene>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/aframe@1.4.1/dist/aframe.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/mind-ar@1.1.4/dist/mindar-face-aframe.prod.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const sceneEl = document.querySelector('a-scene');
    const startMindAR = () => {
      const mindarSystem = sceneEl.systems['mindar-face-system'];
      if (mindarSystem && mindarSystem.start) {
        mindarSystem.start();
      }
    };
    if (sceneEl.hasLoaded) {
      startMindAR();
    } else {
      sceneEl.addEventListener('loaded', startMindAR);
    }
  });
</script>
<?php
include 'footer.php';
?>
