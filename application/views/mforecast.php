<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SP | Forecast</title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>design/style/style.css" />
    <link href="<?php echo base_url();?>design/images/icon.jpg" rel="shortcut icon" type="image/x-icon">
</head>
<body>

<div class="container">
	
    <h1>
    	UPLB Course Demand Prediction System :: Demand Forecast
        
    	<?php echo form_open('admin/logout'); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'LOGOUT');?>
		<?php echo form_close();?>
        
        <?php echo form_open('admin/dashboard/'.$course_id); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'DASHBOARD');?>
		<?php echo form_close();?>
    </h1>

	<div class="body">
        
        <?php
			
			/** exponential smoothing method */
			$forecast[0] = $demand[0];
			$range = $ctr;
			for($i=1; $i<$range+1; $i++){
			
				$forecast[$i] = ($alpha*$demand[$i-1])+((1-$alpha)*$forecast[$i-1]);
			}
		
		?>
        
        <div class="boxed curved" style="margin-top:5%; margin-right:5%; margin-left:3%; height:420px;">
        	
            <div class="minibox boxed curved" style="width:50%; margin-top:3%; height:300px;">
                <p align="center">
                    <?php echo $course_id; ?> DEMAND FORECAST
                    <br />( range: <?php echo $range; ?> sems | alpha: <?php echo $alpha; ?> )
                </p>
                <hr /><br />
                
                <div style="height: 150px; overflow: auto;">
                <table align="center">
                
                    <?php
                        
						for($i=0; $i<sizeof($demand); $i++){
							
							echo '<tr>';
								echo '<td>';
									echo "Forecast: ";
								echo '</td>';
								echo '<td>';
									echo nbs(2).$forecast[$i];
								echo '</td>';
								echo '<td>';
									echo nbs(3).$demand_labels[$i];
								echo '</td>';
								echo '<td>';
									echo nbs(2).$demand[$i];
								echo '</td>';
                        	echo '</tr>';
							
							
						}
                        
                    ?>
                     
               </table>
               </div>
               <br />
               <?php echo "FORECAST FOR THE NEXT TERM: ".$forecast[sizeof($forecast)-1]; ?>
               
               <br />
                <p align="center" style="margin-top:-5%;">
                <?php echo form_open('admin/manual/'.$course_id); ?>
			    <?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'NEW');?>
                <?php echo form_close();?>
            	</p>
           	</div>
            
        </div>
        
	</div>

	<p class="footer">
    	University of the Philippines Los Ba&ntilde;os<br />
    	All Rights Reserved. &copy; 2013 Created by Nesceal Delizo
    </p>
</div>

</body>
</html>