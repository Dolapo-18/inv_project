<nav class="navbar navbar-expand-lg navbar-light shadow-sm p-3">
  <a class="navbar-brand" href="#">INVENTORY</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"><i class="fa fa-home"></i>&nbsp;Home <span class="sr-only">(current)</span></a>
      </li>
      
    </ul>
  </div>

  <div class="navbar-collapse collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <?php 

        if (isset($_SESSION["user_id"])) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fa fa-user"></i>&nbsp;Logout</a>
        </li>
        <?php
        }
       ?>
        
        
    </ul>
</div>
</nav>