
<div class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
    <span class="navbar-text">
      <li><a href="<?php echo base_url();?>index.php/contact/" data-tag="contact"></a> </li>
    </span>
    </div>
</div>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
      integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
      crossorigin=""/>
<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
<script defer="defer" src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
<script defer="defer" src="https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster-src.js"></script>
<script defer="defer" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();  ?>js/jquery-fallback.js"></script>
<script defer="defer" type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();  ?>js/app.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();  ?>js/hint.js"></script>
<script type = "text/javascript" src = "<?php echo base_url();  ?>js/<?php echo $title; ?>.js"></script>
        </body>
</html>