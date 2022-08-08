<?php 
  
    if(isset($_POST['submit'])){ 
          
        foreach($_POST['quantity'] as $key => $val) { 
            if($val==0) { 
                unset($_SESSION['cart'][$key]); 
            }else{ 
                $_SESSION['cart'][$key]['quantity']=$val; 
            } 
        } 
          
    } 
  
?> 

<h1>View cart</h1> 
<a href="index.php?page=products">Go back to products page</a> 
<form method="post" action="index.php?page=cart"> 
      
    <table> 
          
        <tr> 
            <th>Name</th> 
            <th>Quantity</th> 
            <th>Price</th> 
            <th>Items Price</th> 
        </tr> 
          
        <?php 
          
            $sql="SELECT * FROM products WHERE productID IN ( "; 
                      
                    foreach($_SESSION['cart'] as $id => $value) { 
                        $sql.=$id.","; 
                    } 
                      
                    $sql=substr($sql, 0, -1).")";
						echo $sql;
                    $query=mysqli_query($connect,$sql); 
					                    $totalprice=0; 
                    while($row=mysqli_fetch_array($query)){ 
                        $subtotal=$_SESSION['cart'][$row['productID']]['quantity']*$row['unitsPrice']; 
                        $totalprice+=$subtotal; 
                    ?> 
                        <tr> 
                            <td><?php echo $row['productName'] ?></td> 
                            <td><input type="text" name="quantity[<?php echo $row['productID'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['productID']]['quantity'] ?>" /></td> 
                            <td><?php echo $row['unitsPrice'] ?>$</td> 
                            <td><?php echo $_SESSION['cart'][$row['productID']]['quantity']*$row['unitsPrice'] ?>$</td> 
                        </tr> 
                    <?php 
                          
                    } 
        ?> 
                    <tr> 
                        <td colspan="4">Total Price: <?php echo $totalprice ?></td> 
                    </tr> 
          
    </table> 
    <br /> 
    <button type="submit" name="submit">Update Cart</button> 
</form> 
<br /> 
<p>To remove an item, set it's quantity to 0. </p>