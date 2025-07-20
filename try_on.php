<?php
include 'header.php';
?>
<main class="container">
  <h1>Provador Virtual</h1>
  <div id="ar-container">
    <a-scene mindar-face embedded color-space="sRGB" vr-mode-ui="enabled: false" device-orientation-permission-ui="enabled: false">
      <a-assets>
        <a-asset-item id="glassesObj" src="assets/images/Glasses.obj"></a-asset-item>
      </a-assets>
      <a-camera active="false" position="0 0 0"></a-camera>
      <a-entity mindar-face-target="anchorIndex: 168">
        <a-entity obj-model="obj: #glassesObj" rotation="0 0 0" position="0 -0.4 0.5" scale="0.75 0.75 0.75"></a-entity>
      </a-entity>
    </a-scene>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/aframe@1.4.1/dist/aframe.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/mind-ar@1.1.4/dist/mindar-face-aframe.prod.js"></script>
<?php
include 'footer.php';
?>
