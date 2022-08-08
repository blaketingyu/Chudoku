<?php 

    if(isset($_GET['action']) && $_GET['action']=="add"){ 
          
        $id=intval($_GET['id']); 
          
        if(isset($_SESSION['cart'][$id])){ 
              
            $_SESSION['cart'][$id]['quantity']++; 
             
        }else{ 
              
           $sql_s="SELECT * FROM products 
                WHERE productID={$id}"; 
            $query_s=mysqli_query($connect,$sql_s); 
            if(mysqli_num_rows($query_s)!=0){ 
                $row_s=mysqli_fetch_array($query_s); 
                
                $_SESSION['cart'][$row_s['productID']]=array( 
                        "quantity" => 1, 
                        "unitsPrice" => $row_s['unitsPrice'] 
                    ); 
                  
                  
            }else{ 
                  
                $message="This product id is invalid!"; 
                  
            } 
              
        } 
          
    } 
  
?>
<h1>Product List</h1> 

<?php 
    
	if(isset($message)){ 
        echo "<h2>$message</h2>"; 
    } 
?>

    <table> 
        <tr>		
            <th>ID</th>
			<th>Name</th> 
            <th>Price</th>
			<th>Units</th>
			<th>Supplier</th>
			<th>Category</th>
            <th>Action</th> 
        </tr>
		<?php 
  
	$sql="SELECT * FROM products"; 
	$query=mysqli_query($connect,$sql); 
    
    while ($row=mysqli_fetch_array($query)) 	
	{ 
          
?> 
        <tr> 
            <td><?php echo $row['productID'] ?></td> 
            <td><?php echo $row['productName'] ?></td> 
            <td>$<?php echo $row['unitsPrice'] ?></td> 
			<td><?php echo $row['unitsInStore'] ?></td> 
            <td><?php echo $row['Supplier'] ?></td> 
            <td><?php echo $row['Category'] ?></td> 
            <td><a href="index.php?page=products&action=add&id=<?php echo $row['productID'] ?>">Add to cart</a></td>
        </tr> 
<?php 
          
    } 
  
?>
    </table>