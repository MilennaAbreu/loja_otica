<?php
include 'header.php';
?>
<main class="container">
  <h1>Provador Virtual</h1>
    <div id="ar-container">
      <a-scene mindar-face embedded color-space="sRGB" vr-mode-ui="enabled: false" device-orientation-permission-ui="enabled: false">
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
    sceneEl.addEventListener('loaded', () => {
      const mindarComponent = sceneEl.components['mindar-face-system'];
      if (mindarComponent && mindarComponent.start) {
        mindarComponent.start();
      }
    });
  });
</script>
<?php
include 'footer.php';
?>
