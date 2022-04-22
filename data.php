<?php
  session_start();
?>

<html>
  <head>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css"
  rel="stylesheet"
/>

  <link rel="stylesheet" href="style.css">
  <title>TechGroup</title>
  </head>

  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="data.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="submit.php">Upload</a>
        </li>

		    <li class="nav-item">
          <a class="nav-link" href="downloads.php">Download</a>
        </li>
       
      
      </ul>
      <div class="d-flex me-2 ">
         Welcome, <?=$_SESSION['username']?>
       </div>
       <a href="logout.php">logout</a>
    </div>
  </div>
</nav>




<div class="container">

<br><br>

<table class="table">
	<thead>
    <tr>
        <th><i class="fas fa-file-upload fa-6x"></i><h2><a href="submit.php">upload files </a></h2></th>
        <th><i class="fas fa-file-download fa-6x"></i><h2><a href="downloads.php">download files</a></h2></th>
    </tr>
	</thead>
	<tbody>

	</tbody>
</table>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"
></script>
</body>
</html>