
   <?php 
    error_reporting("E_ERROR");
    require_once("./common/config.php"); 
	require_once("./common/DB_Connection.php");
	require_once("./common/functions.php");
	?>	
    <?php 
	$text = file_get_contents('product.csv');

    $text = explode("\n",$text);

    $i = 0;
	foreach($text as $line)
	{
		$temp = array();
		$temp = explode(',',$line);


		$code = $temp[1];
        
        for($i = 0; $i < count($temp); $i++){
           if($i == 0){
              $upc = $temp[$i]; 
           }
           if($i == 1){
              $brand = $temp[$i]; 
           }
           if($i == 2){
              $itmeName = $temp[$i]; 
           }
           if($i == 3){
              $size = $temp[$i]; 
           }
           if($i == 4){
              $retail = $temp[$i]; 
           }
           if($i == 5){
             $nbd = $temp[$i];  
           } 
        }
        
        for($i = count($temp); $i < 6; $i++){
            if($i == 0){
              $upc = ""; 
           }
           if($i == 1){
              $brand = ""; 
           }
           if($i == 2){
              $itmeName = ""; 
           }
           if($i == 3){
              $size = ""; 
           }
           if($i == 4){
              $retail = ""; 
           }
           if($i == 5){
             $nbd = "";  
           }   
        }
    	
		$sql = "insert into ca_product (upcCode , brand , itemName , size , retail , nbd , user_id , store_id , created_at , updated_at) 

					values('$upc', '$brand', '$itmeName', '$size', '$retail', '$nbd' ,'3' ,'1' , now() ,now())";
        
		$db->queryInsert($sql);
    }
	?>
