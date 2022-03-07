<?php		
    if($success!="") {			
        echo "<div class='alert alert-success'>".utf8_encode($success)."</div>";	
    }elseif($warning!="") {	
        echo "<div class='alert alert-danger'>".utf8_encode($warning)."</div>";	 
    }
?>