<?php
// $conn = mysqli_connect('localhost','id12748558_anshubhagat', 'Madhu15062001@', 'id12748558_anshu');
$conn = mysqli_connect('localhost','root', '', 'cssproject');

$sql = "SELECT * FROM cipher";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Downloads files
if (isset($_GET['file_id'])) 
	{
			$id = $_GET['file_id'];
			$keyno = $_GET['keyno'];

			// fetch file to download from database
			$sql = "SELECT * FROM cipher WHERE id=$id";
			$result = mysqli_query($conn, $sql);

			$file = mysqli_fetch_assoc($result);
			$filepath = 'de/' . $file['name'];
			$keydata = $file['keyno'];
			
			if($keyno == $keydata)
			{
				
				if (file_exists($filepath)) {
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename=' . basename($filepath));
					header('Expires: 0');
					header('Cache-Control: must-revalidate');
					header('Pragma: public');
					header('Content-Length: ' . filesize('de/' . $file['name']));
					readfile('de/' . $file['name']);

					// Now update downloads count
					$newCount = $file['download'] + 1;
					$updateQuery = "UPDATE cipher SET download=$newCount WHERE id=$id";
					mysqli_query($conn, $updateQuery);
					exit;
				}
			}
			else
			{
				echo '<script>alert("key is wrong")</script>';
			}
	}
?>

<?php
session_start();
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
  <title>Download files</title>
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





<table>
	<thead>
		<th>ID</th>
		<th>Filename</th>
		<th>size (in mb)</th>
		<th>Downloads</th>
		<!-- <th>file id</th> -->
		<th>key</th>
		<th>Action</th>
	</thead>
	<tbody>
	<?php foreach ($files as $file): ?>
		<tr>
		<td><?php echo $file['id']; ?></td>
		<td><?php echo $file['name']; ?></td>
		<td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
		
		<td><?php echo $file['download']; ?></td>
		<form>
			<input type="hidden" name='file_id' value="<?php echo $file['id']?>">
			<!-- <td><input name = 'file_id' type = 'text'></td> -->
			<td><input name = 'keyno' type = 'text'></td>
			<td><input type="submit" class="btnSubmit btn btn-primary" value="Download" /></td>
		</form>
		</tr>
	<?php endforeach;?>

	</tbody>
</table>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>