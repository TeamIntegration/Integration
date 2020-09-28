<?php

  $html = '
    <div class="button_container">
      <input type="button" name="demarrage" id="demarrage" class="inputButton" value="Démarrage" onclick="startIntegration()">
      <input type="button" name="nextTour" id="nextTour" class="inputButton" value="Tour suivant" onclick="nextTour()">
    </div>';
    $response = ["html" => $html];

    echo json_encode($response);
 ?>
