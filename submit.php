<?php


		// class KeyValuePair
		// {
		// 	public $Key;
		// 	public $Value;
		// }

		// function compare($first, $second) {
		// 	return strcmp($first->Value, $second->Value);
		// }

		// function GetShiftIndexes($key)
		// {
		// 	$keyLength = strlen($key);
		// 	$indexes = array();
		// 	$sortedKey = array();
		// 	$i;

		// 	for ($i = 0; $i < $keyLength; ++$i) {
		// 		$pair = new KeyValuePair();
		// 		$pair->Key = $i;
		// 		$pair->Value = $key[$i];
		// 		$sortedKey[] = $pair;
		// 	}

		// 	usort($sortedKey, 'compare');
		// 	$i = 0;

		// 	for ($i = 0; $i < $keyLength; ++$i)
		// 		$indexes[$sortedKey[$i]->Key] = $i;

		// 	return $indexes;
		// }

		// function Encipher($input, $key, $padChar)
		// {
		// 	$output = "";
		// 	$totalChars = strlen($input);
		// 	$keyLength = strlen($key);
		// 	$input = ($totalChars % $keyLength == 0) ? $input : str_pad($input, $totalChars - ($totalChars % $keyLength) + $keyLength, $padChar, STR_PAD_RIGHT);
		// 	$totalChars = strlen($input);
		// 	$totalColumns = $keyLength;
		// 	$totalRows = ceil($totalChars / $totalColumns);
		// 	$rowChars = array(array());
		// 	$colChars = array(array());
		// 	$sortedColChars = array(array());
		// 	$currentRow = 0; $currentColumn = 0; $i = 0; $j = 0;
		// 	$shiftIndexes = GetShiftIndexes($key);

		// 	for ($i = 0; $i < $totalChars; ++$i)
		// 	{
		// 		$currentRow = $i / $totalColumns;
		// 		$currentColumn = $i % $totalColumns;
		// 		$rowChars[$currentRow][$currentColumn] = $input[$i];
		// 	}

		// 	for ($i = 0; $i < $totalRows; ++$i)
		// 		for ($j = 0; $j < $totalColumns; ++$j)
		// 			$colChars[$j][$i] = $rowChars[$i][$j];

		// 	for ($i = 0; $i < $totalColumns; ++$i)
		// 		for ($j = 0; $j < $totalRows; ++$j)
		// 			$sortedColChars[$shiftIndexes[$i]][$j] = $colChars[$i][$j];

		// 	for ($i = 0; $i < $totalChars; ++$i)
		// 	{
		// 		$currentRow = $i / $totalRows;
		// 		$currentColumn = $i % $totalRows;
		// 		$output .= $sortedColChars[$currentRow][$currentColumn];
		// 	}

		// 	return $output;
		// }

		// function Decipher($input, $key)
		// {
		// 	$output = "";
		// 	$keyLength = strlen($key);
		// 	$totalChars = strlen($input);
		// 	$totalColumns = ceil($totalChars / $keyLength);
		// 	$totalRows = $keyLength;
		// 	$rowChars = array(array());
		// 	$colChars = array(array());
		// 	$unsortedColChars = array(array());
		// 	$currentRow = 0; $currentColumn = 0; $i = 0; $j = 0;
		// 	$shiftIndexes = GetShiftIndexes($key);

		// 	for ($i = 0; $i < $totalChars; ++$i)
		// 	{
		// 		$currentRow = $i / $totalColumns;
		// 		$currentColumn = $i % $totalColumns;
		// 		$rowChars[$currentRow][$currentColumn] = $input[$i];
		// 	}

		// 	for ($i = 0; $i < $totalRows; ++$i)
		// 		for ($j = 0; $j < $totalColumns; ++$j)
		// 			$colChars[$j][$i] = $rowChars[$i][$j];

		// 	for ($i = 0; $i < $totalColumns; ++$i)
		// 		for ($j = 0; $j < $totalRows; ++$j)
		// 			$unsortedColChars[$i][$j] = $colChars[$i][$shiftIndexes[$j]];

		// 	for ($i = 0; $i < $totalChars; ++$i)
		// 	{
		// 		$currentRow = $i / $totalRows;
		// 		$currentColumn = $i % $totalRows;
		// 		$output .= $unsortedColChars[$currentRow][$currentColumn];
		// 	}

		// 	return $output;
		// }
		function Cipher($ch, $key)
		{
			if (!ctype_alpha($ch))
				return $ch;
		
			$offset = ord(ctype_upper($ch) ? 'A' : 'a');
			return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
		}
		
		function Encipher($input, $key)
		{
			$output = "";
		
			$inputArr = str_split($input);
			foreach ($inputArr as $ch)
				$output .= Cipher($ch, $key);
		
			return $output;
		}
		
		  function Decipher($input, $key)
		  {
			  return Encipher($input, 26 - $key);
		  }


		if(isset($_POST['submit']))
		{
				function read($file)
				{
				
					$handle = fopen($file,"rb") or die("could not open the file");
					$contents = fread($handle,filesize($file));
				
					fclose($handle);
				
					return $contents;
				}	

				
				function save($con,$destination)
				{
				
					$fp = fopen($destination,'wb') or die("could not opn the file for writing");
						
					fwrite($fp,$con) or die('could not write to file');
					fclose($fp);
				}	
				
				// $conn = mysqli_connect('localhost','id12748558_anshubhagat', 'Madhu15062001@', 'id12748558_anshu');
				$conn = mysqli_connect('localhost','root', '', 'cssproject');
				
				$sql = "SELECT * FROM cipher";
				if(mysqli_query($conn,$sql))
				{
						$result = mysqli_query($conn, $sql);
				}
				else
				{
						echo 'failed';
				}
				$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

				$file = $_FILES['file']['tmp_name'];
				$text = read($file);
				// get the file extension
				$filename = $_FILES['file']['name'];
				$keyno = $_POST['key'];
				echo $keyno;
				$extension = pathinfo($filename, PATHINFO_EXTENSION);
				
				// the physical file on a temporary uploads directory on the server
				$size = $_FILES['file']['size'];

				if (!in_array($extension, ['txt'])) 
				{
					echo "You file extension must be .txt";
				} elseif ($_FILES['file']['size'] > 1000000) 
				{ // file shouldn't be larger than 1Megabyte
					echo "File too large!";
				} else 
				{
					
					$sql = "INSERT INTO cipher (name, size, download,keyno) VALUES ('$filename', $size, 0, '$keyno')";
					if (mysqli_query($conn, $sql)) 
					{
						echo "<script>alert('File uploaded successfully');</script>";
					}
					else 
					{
						echo "Failed to upload file.";
					}
				}
			
			$cipherText = Encipher($text, $keyno);
			save($cipherText,"en/".$filename);
			
			$plainText = Decipher($cipherText, $keyno);
			save($plainText,"de/".$filename);
			
			// echo $cipherText."<br>";
			
			// echo $plainText;
			echo "<script>alert('Encipher is: $cipherText');</script>";
		}
		
		
?>

<?php
session_start();
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <title> TechGroup </title>
	
	 <link rel="stylesheet" href="style.css">
    <title>Files Upload and Download</title>
	
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
      <div class="row">
        <form  method="post" enctype="multipart/form-data">
          <h3>Upload File</h3>
          <div class = "form-group"> 
			<input class="form-control" type="file" name="file" id="file" placeholder="Enter Key">
			</div>
			<br>
			<div class = "form-group">       
				<input class="form-control" type="text" name="key" id="key" placeholder="key">
			</div>
          <button type="submit" name="submit">upload</button>
        </form>
      </div>
    </div>
	

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>