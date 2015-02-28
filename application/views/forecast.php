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
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'BACK');?>
		<?php echo form_close();?>
    </h1>

	<div class="body">
        
        <?php
			
			if($checkFirst == "on" || $checkSecond == "on" || $checkSummer == "on"){

				$ctr = 0;
				for($i=$indx; $i>=0; $i--){
					
					$asdf[0] = 0;
					$asdf[1] = 0;
					$asdf[2] = 0;
					
					for($j=0; $j<sizeof($recommended_years[$i]); $j++){
						
						if($recommended_terms[$i][$j] == "FIRST"){
							$asdf[0]++;
						}
						else if($recommended_terms[$i][$j] == "SECOND"){
							$asdf[1]++;
						}
						else if($recommended_terms[$i][$j] == "SUMMER"){
							$asdf[2]++;
						}
					}
					$demand_count[$indx-$i][0] = $asdf[0];
					$demand_count[$indx-$i][1] = $asdf[1];
					$demand_count[$indx-$i][2] = $asdf[2];
					
					if($checkFirst == "on" && $asdf[0] != 0){
						$demand[$ctr] = $asdf[0];
						$demand_label[$ctr] = "Demand for 1st Sem ".$recommended_years[$i][0].": ";
						$ctr++;
						if($checkSecond == "on" && $asdf[1] != 0){
							$demand[$ctr] = $asdf[1];
							$demand_label[$ctr] = "Demand for 2nd Sem ".$recommended_years[$i][0].": ";
							$ctr++;
							if($checkSummer == "on" && $asdf[2] != 0){
								$demand[$ctr] = $asdf[2];
								$demand_label[$ctr] = "Demand for Summer ".$recommended_years[$i][0].": ";
								$ctr++;
							}
						}
						else if($checkSummer == "on" && $asdf[2] != 0){
							$demand[$ctr] = $asdf[2];
							$demand_label[$ctr] = "Demand for Summer ".$recommended_years[$i][0].": ";
							$ctr++;
						}
					}
					else if($checkSecond == "on" && $asdf[1] != 0){
						$demand[$ctr] = $asdf[1];
						$demand_label[$ctr] = "Demand for 2nd Sem ".$recommended_years[$i][0].": ";
						$ctr++;
						if($checkSummer == "on" && $asdf[2] != 0){
							$demand[$ctr] = $asdf[2];
							$demand_label[$ctr] = "Demand for Summer ".$recommended_years[$i][0].": ";
							$ctr++;
						}
					}
					else if($checkSummer == "on" && $asdf[2] != 0){
						$demand[$ctr] = $asdf[2];
						$demand_label[$ctr] = "Demand for Summer ".$recommended_years[$i][0].": ";
						$ctr++;
					}
				}
				
			}
			else echo '<h5>NOTE: NO COURSE TERM WAS SELECTED</h5>';
			
			/** exponential smoothing method */
			$forecast[0] = $demand[sizeof($demand)-1];
			$range = (sizeof($demand)<$range)?(sizeof($demand)-1):$range;
			for($i=1; $i<=$range+1; $i++){
			
				$forecast[$i] = ($alpha*$demand[(sizeof($demand)-1)-($i-1)])+((1-$alpha)*$forecast[$i-1]);
			}
		
		?>
        
        <div class="boxed curved" style="margin-top:5%; margin-right:5%; margin-left:3%; height:420px;">
        	
            <div class="minibox boxed curved" style="float:left; width:50%; margin-top:3%; margin-left:1%; height:300px;">
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
									echo nbs(3).$demand_label[(sizeof($demand)-1)-$i];
								echo '</td>';
								echo '<td>';
									echo nbs(2).$demand[(sizeof($demand)-1)-$i];
								echo '</td>';
                        	echo '</tr>';
							
							
						}
                        
                    ?>
                     
               </table>
               </div>
               <br />
               <?php echo "FORECAST FOR THE NEXT TERM: ".$forecast[sizeof($forecast)-1]; ?>
           	</div>
            
            <?php
			
				$first = false;
				$second = false;
				$summer = false;
				for($i=0; $i<strlen($course_term); $i++){
					
					if($course_term[$i]==1) $first = true;
					else if($course_term[$i]==2) $second = true;
					else if($course_term[$i]=="S") $summer = true;
				}
			
			?>
            
            <div class="minibox boxed curved" style="width: 32%; margin-top:3%; margin-right:1%;">
				<?php echo form_open('admin/forecast/'.$course_id); ?>
                
                <p align="center">CREATE ANOTHER FORECAST</p>
                
                <table align="center">
                    
                    <tr>
                        <td>
                            RANGE: 
                        </td>
                        <td>
                            <?php echo form_input(array('id'=> 'range', 'name'=>'range', 'class'=>'inputs curved', 'value'=>$range));?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ALPHA:
                        </td>
                        <td>
                            <?php echo form_input(array('id'=> 'alpha', 'name'=>'alpha', 'class'=>'inputs curved', 'value'=>$alpha));?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	TERMS CONSIDERED:
                        </td>
                        <td>
                        	<?php	
								if($first)
								echo '<input type="checkbox" name="checkFirst" '.set_checkbox('checkFirst','1').'/>'.nbs(2)."First Semester";
							?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        </td>
                        <td>
                        	<?php	
								if($second)
								echo '<input type="checkbox" name="checkSecond" '.set_checkbox('checkSecond','2').'/>'.nbs(2)."Second Semester";
							?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        </td>
                        <td>
                        	<?php	
								if($summer)
								echo '<input type="checkbox" name="checkSummer" '.set_checkbox('checkSummer','3').'/>'.nbs(2)."Summer";
							?>
                        </td>
                    </tr>
                    
                </table>
                
                <p align="center">
                    <?php echo validation_errors(); ?>
                    <?php echo form_submit(array('name'=>'submit','class'=>'submits curved'), 'FORECAST');?>
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