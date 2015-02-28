<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SP | Dashboard</title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>design/style/style.css" />
    <link href="<?php echo base_url();?>design/images/icon.jpg" rel="shortcut icon" type="image/x-icon">
    <script type="text/javascript" src=<?php echo base_url();?>"scripts/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<script type="text/javascript">
	
		google.load("visualization", "1", {packages:["corechart"]});
    	google.setOnLoadCallback(drawChart);
    	function drawChart() {
      		var data = google.visualization.arrayToDataTable([
        		['SEMESTER', 'Passed', 'Failed', 'Enlisted'],
				['First Sem', <?php echo $passed_first.", ".$failed_first.", ".($passed_first+$failed_first); ?>],
				['Second Sem', <?php echo $passed_second.", ".$failed_second.", ".($passed_second+$failed_second); ?>],
				['Summer', <?php echo $passed_summer.", ".$failed_summer.", ".($passed_summer+$failed_summer); ?>]
        		
		<!--		<?php
					$sem = "whut";
					for($i=0; $i<3; $i++){
						echo "['".$sem."', ".$passed_first.", ".$failed_first.", ".($for_removals+$for_completions);
						if($i==5) echo "]";
						else echo "],";
					}
				
				?>
		-->		
      		]);

      		var options = {
        		title: 'Course Demand',
        		hAxis: {title: '<?php echo $year; ?>', titleTextStyle: {color: 'black'}},
				backgroundColor: '#F8F8F8',
				colors: ['#CCCCFF','#C0C0C0','#A0A0A0'],
				fontName: 'Courier New'
      		};

      		var chart = new google.visualization.ColumnChart(document.getElementById('visualization'));
      		chart.draw(data, options);
    	}
	</script>
    
</head>
<body>

<div class="container">
	
    <h1>
    	UPLB Course Demand Prediction System :: Dashboard
        
    	<?php echo form_open('admin/logout'); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'LOGOUT');?>
		<?php echo form_close();?>
        
        <?php echo form_open('admin/search'); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'SEARCH');?>
		<?php echo form_close();?>
        
      <!--  <?php echo form_open('admin/piechart'); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'PIE CHART');?>
		<?php echo form_close();?>
      -->  
        <?php echo form_open('admin/edit/'.$course_id) ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'EDIT');?>
		<?php echo form_close();?>
        
        <?php echo form_open('admin/download/'.$course_id) ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'DOWNLOAD');?>
		<?php echo form_close();?>
    </h1>

	<div class="body">
        
        <div id="top_panel" class="boxed curved">
	       	<div id="visualization"></div>
            <table id="toptable">
            	
                <?php
                
					echo '<tr>';
						echo '<td width="30%">';
							echo "COURSE ID:";
						echo '</td>';
						echo '<td>';
							echo $course_id;
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td>';
							echo "COURSE TITLE:";
						echo '</td>';
						echo '<td>';
							echo $course_title;
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td>';
							echo "COURSE UNITS:";
						echo '</td>';
						echo '<td>';
							echo $course_units." Units";
						echo '</td>';
					echo '</tr>';
					
					
					echo '<tr>';
						echo '<td>';
							echo "DEPARTMENT:";
						echo '</td>';
						echo '<td>';
							echo $course_dept;
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td>';
							echo "TERMS OFFERED:";
						echo '</td>';
						echo '<td>';
						
							$semester = "";
							$first = false;
							$second = false;
							$summer = false;
							for($i=0; $i<strlen($course_term); $i++){
								
								if($course_term[$i]==1){
									$semester = "1st ";
									$first = true;
								}
								else if($course_term[$i]==2){
									$semester = "2nd ";
									$second = true;
								}
								else if($course_term[$i]=="S"){
									$semester = "Summer ";
									$summer = true;
								}
								echo $semester;
							}
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td>';
							echo "LECTURE HOURS:";
						echo '</td>';
						echo '<td>';
							echo $course_xhrs." Hours";
						echo '</td>';
					echo '</tr>';
					
					echo '<tr>';
						echo '<td>';
							echo "LAB HOURS:";
						echo '</td>';
						echo '<td>';
							echo $course_lhrs." Hours";
						echo '</td>';
					echo '</tr>';
					
					$prereqs = explode("+",$course_prereq);
					
					echo '<tr>';
						echo '<td>';
							echo "PREREQUISITE/S:";
						echo '</td>';
						echo '<td>';
							$size = sizeof($prereqs);
							if($size==1) echo $prereqs[0];
							else{
								for($i=0; $i<$size; $i++){
									if($prereqs[$i]=="OR"){
										if($prereqs[$i+2]!="AND" && $prereqs[$i+2]!="OR"){
											echo $prereqs[$i+1]." OR ".$prereqs[$i+2];
										}
										else{
											echo $prereqs[$i+1]." OR <br />";
										}
									}
									else if($prereqs[$i]=="AND"){
										if($prereqs[$i+2]!="AND" && $prereqs[$i+2]!="OR"){
											echo $prereqs[$i+1]." AND ".$prereqs[$i+2];
										}
										else{
											echo $prereqs[$i+1]." AND <br />";
										}
									}
								}
							}
							
						echo '</td>';
					echo '</tr>';
					
				?>
            </table>
        </div>
        
        <div id="bottom_panel" class="boxed curved">
        	<div id="dmd">
            <table id="bottomtable">
                <?php
                
					echo '<caption>';
						echo '<h4> '.$course_id.' COURSE DEMAND ( Year '.$year.', ';
						echo $semester;
						if($semester!="Summer ") echo ' Semester )</h4><hr />';
						else echo ')</h4><hr />';
					echo '</caption>';
					
					echo '<tr>';
						echo '<td>';
							echo "SECTION";
						echo '</td>';
						echo '<td>';
							echo "ENLISTED";
						echo '</td>';
						echo '<td>';
							echo "SLOTS";
						echo '</td>';
					echo '</tr>';
					
					$s = (sizeof($enlisted_section_ids)<sizeof($slots_section_ids))?sizeof($enlisted_section_ids):sizeof($slots_section_ids);
					for($i=0; $i<$s; $i++){
					
						echo '<tr>';
							echo '<td>';
								echo $enlisted_section_ids[$i];
							echo '</td>';
							echo '<td>';
								echo $enlisted_values[$i];
							echo '</td>';
							echo '<td>';
	
								for($j=0; $j<$s; $j++){
									
									if($enlisted_section_ids[$i]==$slots_section_ids[$j]){
										echo $section_slots[$j];
										break;
									}
								}
							echo '</td>';
						echo '</tr>';
					}
					
				?>
                
                
            </table>
            </div>
    
                <div id="in">
                    
                    <?php echo form_open('admin/forecast/'.$course_id) ?>
                    <p align="center">CREATE A FORECAST</p>
                   
                    <table>
                    
                    <tr>
                        <td>
                            RANGE (no. of semesters): 
                        </td>
                        <td>
                            <?php echo form_input(array('id'=> 'range', 'name'=>'range', 'class'=>'inputs curved', 'value'=>'5'));?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ALPHA (bet. 0.0 to 1.0):
                        </td>
                        <td>
                            <?php echo form_input(array('id'=> 'alpha', 'name'=>'alpha', 'class'=>'inputs curved', 'value'=>'0.9'));?>
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
                <p style="margin-top:-15%; float:right;">
                    <?php echo form_open('admin/manual/'.$course_id); ?>
					<?php echo form_submit(array('name'=>'submit','class'=>'submits curved'), 'MANUAL');?>
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