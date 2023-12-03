<?php 
 include('connect.php');


$rs_id="PHJ00101";
	$result1 = $db->prepare("SELECT REPLACE(name,'µ','A') FROM csv3  ");
             
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
					
				$co=$row1['id'];	
				$rspe=$row1['name'];
					
	$data = preg_replace("µ","A",$rspe);
	$sql = "UPDATE csv3 
        SET model=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($data,$co));
			
//echo $co."<br>";
//echo $rspe;	
					
		echo "µ","<br>";
				}



?>