<!DOCTYPE html>
<html>
<head>
	<title>Develop An E commerce Store</title>
	 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"
    rel="stylesheet">
    
</head>
<body>
<div class="container" style="margin-top:100px">
<?php include("connect.php")  ?>

	<?php 
		if(isset($_POST['upload'])){ // if upload button is clicked then proceed
			if ($_FILES['file']['error'] > 0) { // if error > 0 then do display error
			    echo "Error: " . $_FILES['file']['error'] . "<br />";
			} else {
			   
			    $image_name = $_FILES['file']['name'];
			     // store image name 
                $pn=mysqli_real_escape_string($conn,$_POST['naam']);
                // clean name 
                $pc=mysqli_real_escape_string($conn,$_POST['cate']);
				$p=mysqli_real_escape_string($conn,$_POST['pr']);

			    $imageFileType = pathinfo($image_name, PATHINFO_EXTENSION); // get image file type 
			    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
					// image is not in requiered format 
				    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br />";
				   
				}else{
					// image is in correct format 
					// save the image
					echo "Product Image is ok"."<br />";
					// save image 
					$new_name = basename(uniqid().$image_name);
					$target_file = "images/".$new_name; // unique id function make sure all images are unique
					 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
					 	// move the file from temo location to image folder
				        $sql = "INSERT INTO products (image_name,pname,pdesc,price)
							VALUES ('$new_name','$pn','$pc','$p')";

							if (mysqli_query($conn, $sql)) {
							    echo "New product record created successfully<br />";
							} else {
							    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
							$product_id =  mysqli_insert_id($conn);
							$categories = $_POST['cat'];
							foreach ($categories as $key ) {
								$sql = "INSERT INTO `product_cat`( `product_id`, `categories_id`) 
								VALUES ('$product_id','$key')";
								echo $sql;
								if (mysqli_query($conn, $sql)) {
							    echo "New product record created successfully<br />";
							} else {
							    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
							}



				    } else {
				    	// if move failed then show error.
				        echo "Sorry, there was an error uploading your file.<br />";
				    }
				}
			}
		} 
	?>
	</div>
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Webtutplus</a>
	    </div>
	    <div>
	      <ul class="nav navbar-nav">
	        <li ><a href="index.php">Home</a></li>
	        <li ><a href="admin.php">Admin panel</a></li>
	       	<li class="active"><a href="admin.php">Add new product</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<div class="container" style="margin-top:0px">
		<h2 style="text-align:center"  class="bg-success"> Upload a new product</h2>
	<div class="container">
		<form action="" method="post"  enctype="multipart/form-data" style="width:50%;margin:0 auto">

		  <div class="form-group">
                  <label for="exampleInputFile"> Product Name </label>  
               <input type="text" class="form-control" name="naam" required>
          <label for="exampleInputFile">Product Description </label>  
           <textarea class="form-control"  name="cate" rows="5" id="comment"></textarea>
		
		  <label for="exampleInputFile">Product Price </label> 
		 <input type="number" min="10" class="form-control" name="pr" required>
		    <label for="exampleInputFile">Upload Product Image</label>
		    <input type="file" class="form-control" name="file" id="exampleInputFile" required>
		   
		  </div>
		  <div class="form-group">
		  <label for="exampleInputFile">Add relevent categories</label>
		  	<?php
						
					$sql = "SELECT * FROM categories";
					$result = mysqli_query($conn, $sql);
						
					if (mysqli_num_rows($result) > 0) {
					    
					    while($row = mysqli_fetch_assoc($result)) {
					    	?>
					    	<br /><input type="checkbox" name="cat[]" value="<?php echo $row['id']; ?>"  > 
					    		<?php echo $row['name']; ?>

			<?php
			}
		}
			?>

		  </div>
		 
		  
		  <button type="submit" name="upload" class="btn btn-info" >Add new product</button>
		</form>
	</div>

	</div>

</body>
</html>