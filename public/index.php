<?php
    require("header.php");
?>

<main>
<br>
<div class="container">
  <div class="row">
    <div class="col-12 d-flex justify-content-center">
        <div id="race">
          
        </div>
        <div id="teaminfo-wrapper">
          <?php
            require('includes/index.inc.php');
            
            foreach ($boats as $boat){
              echo "<div class='teaminfo' points='$boat->points' teamname='$boat->name' imgsrc='$boat->imgsrc'>Point: $boat->points<br>Holdnavn: $boat->name.</div>";
            }
          ?>
        </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row d-flex justify-content-around">
    <div class="col-sm-5">
      <div class='embed-container'>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/g8D3zQ9Y03U" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
    <div class="col-sm-5">
      <div class='embed-container mb-5'>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/cl4ojDDFWd0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </iframe>
    </div>
    </div>
  </div>
</div>
</main>
<script src="race.js"></script>


<?php
    require("footer.php");
?>