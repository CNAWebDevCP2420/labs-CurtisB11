<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order Form</title>
</head>

<body>
	<h2>Shopping Items:</h2>
	<?php	
		$ProductOne = array("itemNum" => "Item 1", "itemName" => "Dell 27 inch 4K Monitor", "itemDescription" => "The world’s first 27\" 4K monitor with InfinityEdge, that supports HDR content playback.See stunning colors and details on a virtually borderless display.", "itemPrice" => 749.99);
		$ProductTwo = array("itemNum" => "Item 2", "itemName" => "MSI Motherboard",  "itemDescription" => "MSI MEG Z390 GODLIKE LGA 1151 (300 Series), Intel Z390 SATA 6Gb/s, USB 3.1, Extended ATX Intel Motherboard", "itemPrice" => 797.99);
		$ProductThree = array("itemNum" => "Item 3", "itemName" => "Intel Processor",  "itemDescription" => "Intel Core i9-9900K Coffee Lake 8-Core, 16-Thread, 3.6 GHz (5.0 GHz Turbo), LGA 1151 (300 Series), 95W BX80684I99900K Desktop Processor, Intel UHD Graphics 630", "itemPrice" => 639.99);
		$ProductFour = array("itemNum" => "Item 4", "itemName" => "RAM",  "itemDescription" => "Micron Technology Inc. Memory Module DDR4 SDRAM, 32GB, 2400MTs, 288-RDIMM", "itemPrice" => 417.86);
		$ProductFive = array("itemNum" => "Item 5", "itemName" => "PC Tower Case",  "itemDescription" => "The Commander C31 ATX, mid-tower computer case, gives you the ultimate freedom of choice in building your dream rig, with superior hardware support, excellent cooling options, and integrated riser-GPU support bracket. Being Tt LCS Certified, this case eliminates the hassle of searching to find the right-fitting components. Once configuring is done, you can tune the button on the I/O panel to stunningly light your gaming rig up, or sync the lighting effect to all compatible components via motherboard software.", "itemPrice" => 139.99);
		$ProductSix = array("itemNum" => "Item 6", "itemName" => "Razer BlackWidow Keyboard",  "itemDescription" => "Durable swift and ultra-responsive, this mechanical keyboard is made for peak gaming performance.", "itemPrice" => 184.99);
		$Products = array("item1" => $ProductOne, "item2" => $ProductTwo, "item3" => $ProductThree, "item4" => $ProductFour, "item5" => $ProductFive, "item6" => $ProductSix);
		 
		$TheQuantityItem1 = 0;
		$TheQuantityItem2 = 0;
		$TheQuantityItem3 = 0;
		$TheQuantityItem4 = 0;
		$TheQuantityItem5 = 0;
		$TheQuantityItem6 = 0;
		$finalPriceItem1 = 0;
		$finalPriceItem2 = 0;
		$finalPriceItem3 = 0;
		$finalPriceItem4 = 0;
		$finalPriceItem5 = 0;
		$finalPriceItem6 = 0;
	
		foreach($Products as $TheProduct => $anItem){
			$indexCount = str_replace('item', '', $TheProduct);
			$itemNumSpaceRemoved = str_replace(" ", "", $anItem['itemNum']);
			if(!empty($_POST["quantityItem". $indexCount])){
				${'TheQuantity'. $itemNumSpaceRemoved} = (int)$_POST['quantityItem'. $indexCount];
				${'ThePrice'. $itemNumSpaceRemoved} = number_format(str_replace('$', '', $_POST['priceItem'. $indexCount]), 2);
				${'PriceNoDollarSign'. $itemNumSpaceRemoved} = number_format(str_replace('$', '', ${'ThePrice'. $itemNumSpaceRemoved}), 2);
				${'finalPrice'. $itemNumSpaceRemoved} = ${'PriceNoDollarSign'. $itemNumSpaceRemoved} * ${'TheQuantity'. $itemNumSpaceRemoved};
			}
		}
		
		if(isset($_POST['showGrandTotal'])){			
			$TheGrandTotalPrice = "$". ($finalPriceItem1 + $finalPriceItem2 + $finalPriceItem3 + $finalPriceItem4 + $finalPriceItem5 + $finalPriceItem6);
		}else{
			$TheGrandTotalPrice = "Press View Grand Total";
		}
	?>
	
	<form name="shopping" method="post" action="OnlineOrderForm.php">
		<?php
			foreach($Products as $Product => $item){
				$itemNumNoSpace = str_replace(" ", "", $item['itemNum']);
				echo "<p style=\"padding: 40px 0 5px 0; font-size: 20px;\"><strong>". $item['itemNum'] .":</strong></p>\n";
				echo "<p><input type=\"text\" name=\"nameOf". $itemNumNoSpace ."\" style=\"width: 560px;\" value=\"". $item['itemName'] ."\" readonly /></p>\n";
				echo "<p>Description:<br />\n<textarea name=\"item_description". $itemNumNoSpace ."\" rows=\"4\" style=\"width: 560px;\" readonly>". $item['itemDescription'] ."</textarea></p>\n";
				echo "<p>Price:<br />\n<input type=\"text\" name=\"price". $itemNumNoSpace ."\" style=\"width: 100px;\" value=\"$". $item['itemPrice'] ."\" readonly />&nbsp;&nbsp;&nbsp;";
				echo "&nbsp;&nbsp;&nbsp;\nQuantity: <input type=\"text\" style=\"width: 25px;\" name=\"quantity". $itemNumNoSpace ."\" value=\"". ${'TheQuantity'. $itemNumNoSpace} ."\" />&nbsp;&nbsp;&nbsp;";
				echo "&nbsp;&nbsp;&nbsp;\n<input type=\"submit\" name=\"total". $itemNumNoSpace ."\" value=\"Check Total Price\" />&nbsp;&nbsp;&nbsp;";
				echo "&nbsp;&nbsp;&nbsp;\nTotal: <input type=\"text\" name=\"totalPrice". $itemNumNoSpace ."\" style=\"width: 100px;\" value=\"$". ${'finalPrice'. $itemNumNoSpace} ."\" readonly /></p><br />\n<hr />\n";
			}
		?>
		<br />
		<p>
			<input type="submit" name="showGrandTotal" value="View Grand Total" />&nbsp;&nbsp;&nbsp;&nbsp;
			Grand Total: <input type="text" name="displayGrandTotal" value="<?php echo $TheGrandTotalPrice; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="placeOrderSubmit" formaction="OnlineOrderViewPurchase.php" style="width: 160px; height: 40px; font-size: 20px;" value="Place Order" />
		</p>
		<br /><br />
	</form>
</body>
</html>