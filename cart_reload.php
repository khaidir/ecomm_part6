
<?php

					
				if(isset($_SESSION['cart'])){
					$products =$_SESSION['cart'];
					$str = "";
					foreach ($products as $key) {
						$str .= $key.",";
					}
					$str  = rtrim($str,','); // remove the last comma 
					// get all product_id  corrosponding to the checked categories
					$sql = "SELECT * FROM products WHERE id IN ($str)";
				}else{
					$sql = "SELECT * FROM products WHERE id IN (0)"; // no products
				}


					//$sql = "SELECT * FROM products";
					//echo $sql;
					//$sql = "SELECT * FROM images";
					$result = mysqli_query($conn, $sql);
					$total = 0;
					if (mysqli_num_rows($result) > 0) {
					    // output data of each row
					    $count = 0;
					    while($row = mysqli_fetch_assoc($result)) {
					    	echo '<tr>';
					    	
					    	$image = "images/".$row['image_name'];
					       
					        $product_id = $row['id'];
					        echo '<td>';
					        echo '<a href="details.php?product_id='.$product_id.'" >
					        	<img src="'.$image.'" class="tile" style="max-width:100px;max-height:150px"
					      		  /></a>';
					      	echo '</td>';
					      	echo '<td>';

					        echo "<h3>".$row['pname'].'</h3>';
					        echo '</td>';
					        echo '<td>';

					       echo '<p>'.'Rs '.$row['price']."</p>";
					       echo '</td>';
					       echo '<td>';

					       echo '<p class="btn btn-danger" onclick="delete_cart('.$product_id.')" > Delete from Cart </p>';
					       echo '</td>';

					        $total += (int)$row['price'];


			         
					    	echo "</tr>";
					    }
					} else {
					    echo "No Products";
					}
					?>
					<tr>
					<td>
					</td>
					<td>
					</td>
					<td>
					Amount Payable
					</td>
					<td>
					<p class='total' > Rs <?php echo $total ?> </p>
					</td>
					</tr>