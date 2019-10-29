<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purchase Details</title>
</head>

<body>
	<h2>Your Purchase Details</h2>
	<?php
		if(isset($_POST['placeOrderSubmit'])){
			if((empty($_POST['quantityItem1'])) && (empty($_POST['quantityItem2'])) && (empty($_POST['quantityItem3'])) && (empty($_POST['quantityItem4'])) && (empty($_POST['quantityItem5'])) && (empty($_POST['quantityItem6']))){
			echo "<p>There was no purchase made.</p>\n";
			}else{
				for($a = 1; $a < 7; ++$a){
					if((int)$_POST['quantityItem'. $a] > 0){
						${"NameProduct". $a} = stripslashes($_POST['nameOfItem'. $a]);
						${"DescribeProduct". $a} = stripslashes($_POST['item_descriptionItem'. $a]);
						${"PriceOfOneProduct". $a} = stripslashes($_POST['priceItem'. $a]);
						${"QuantityProduct". $a} = stripslashes($_POST['quantityItem'. $a]);
						${"TotalThisProduct". $a} = "$". ((int)${"QuantityProduct". $a} * (float)str_replace('$', '', ${"PriceOfOneProduct". $a}));
					}
				}
			
				$TheGrandTotalPrice = 0;
				$FileName = 'OnlineOrders/order_'.date('m-d-Y_gisa_T').'.txt';
				$FileStorage = fopen($FileName, 'wb');
				if($FileStorage === false){
					echo "There was an error creating/updating the order file\n";
				}else{
					for($b = 1; $b < 7; ++$b){
						if((int)$_POST['quantityItem'. $b] > 0){
							fwrite($FileStorage, ${"NameProduct". $b} .", ". urlencode(${"DescribeProduct". $b}) .", ". ${"PriceOfOneProduct" . $b} .", ". ${"QuantityProduct". $b} .", ". ${"TotalThisProduct". $b} ."\n");
						} // end if
					} // end first for that writes order item details to text file
					$PurchaseArray = file($FileName); // begin section to read data from text file and insert details into html table
					echo "<table style=\"background-color: lightgray;\" border=\"1\" width=\"100%\">\n";
					$Count = count($PurchaseArray);
					for($p = 0; $p < $Count; ++$p){
						$CurrentPost = explode(", ", $PurchaseArray[$p]);
						echo "<tr>\n";
						echo "<td width=\"10%\" style=\"text-align: center; font-weight: bold;\" rowspan=\"2\">Purchase:<br />". ($p + 1) ."</td>\n";
						echo "<td width=\"90%\" colspan=\"3\">\n<span style=\"font-weight: bold;\">Name:</span> ". htmlentities($CurrentPost[0]) ."<br />\n";
						echo "<span style=\"font-weight: bold;\">Product Description:</span> ". urldecode(stripslashes($CurrentPost[1])) ."\n";
						echo "</td>\n";
						echo "</tr>\n<tr>\n";
						echo "<td>\n<span style=\"font-weight: bold;\">Product Price:</span> ". htmlentities(stripslashes($CurrentPost[2])) ."\n</td>\n";
						echo "<td>\n<span style=\"font-weight: bold;\">Quantity Ordered:</span> ". htmlentities(stripslashes($CurrentPost[3])) ."\n</td>\n";
						echo "<td>\n<span style=\"font-weight: bold;\">Total Price This Item:</span> ". htmlentities(stripslashes($CurrentPost[4])) ."\n</td>\n";
						echo "</tr>\n<tr>\n<td colspan=\"4\"style=\"background-color: FloralWhite;\">&nbsp;</td>\n</tr>\n";
						$itemPriceNoDollarSign = str_replace("$", "", htmlentities($CurrentPost[2]));
						$TheGrandTotalPrice += ((float)$itemPriceNoDollarSign * (int)htmlentities(stripslashes($CurrentPost[3])));
					}
					echo "</table><br />\n";
					echo "<table style=\"background-color: lightgray;\" border=\"1\" width=\"100%\">\n";
					echo "<tr>\n<td><span style=\"font-weight: bold;\">Grand Total This Purchase:</span> $". $TheGrandTotalPrice ."</td>\n";
					echo "</tr>\n";
					echo "</table>\n";
				}
				fclose($FileStorage);
			}
			echo "<br /><a href=\"OnlineOrderForm.php\">Place Another Order</a>\n";
		}
	?>
	
</body>
</html>