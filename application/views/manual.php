<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SP | Add Semester</title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>design/style/style.css" />
    <link href="<?php echo base_url();?>design/images/icon.jpg" rel="shortcut icon" type="image/x-icon">
</head>
<body>

<div class="container">
	
    <h1>
    	UPLB Course Demand Prediction System :: Add Semester
    	
		<?php echo form_open('admin/logout'); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'LOGOUT');?>
		<?php echo form_close();?>
        
        <?php echo form_open('admin/dashboard/'.$course_id); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'BACK');?>
		<?php echo form_close();?>
        
        <?php echo form_open('admin/confirm_set/'.$course_id); ?>
        <?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'CONFIRM');?>
        <?php echo form_close();?>
    </h1>

	<div class="body minibox boxed curved" style="width: 500px;">
        	
        <?php echo form_open('admin/add_item/'); ?>
        <br /><br />
        <table align="center">
            
        	<tr>
                <td>
            		<label>Enter YEAR: </label>
                </td>
                <td>
                	<?php echo form_input(array('id'=>'item_year', 'name'=>'item_year', 'class'=>'inputs curved'));?>
                    <br /><?php echo form_error('item_year'); ?>
                </td>
                <td>
            </tr>
            
            <tr>
            	<td>
                    <label>Enter Semester: </label>
                </td>
                <td>
                    <?php echo form_input(array('id'=>'item_term', 'name'=>'item_term', 'class'=>'inputs curved'));?>
                        <br /><?php echo form_error('item_term'); ?>
                </td>
            </tr>
                
        </table>
            
        <br />
        
        <p align="center">
        <?php
			if($item_year != 0 && $item_term != ""){
				if($item_count == 0) echo "The data for ".$item_term." Semester, Year ".$item_year." is not Available.";
				else echo "Demand for ".$item_term." Semester, Year ".$item_year." is successfully added.";
			}
			echo '<br />TOTAL: '.$counter;
		?>
        </p>
        
        <p align="center">
        
            <?php echo form_input(array('id'=>'course_id', 'name'=>'course_id', 'type'=>'hidden', 'value'=>$course_id));?>
        	<?php echo form_submit(array('name'=>'submit','class'=>'submits curved'), 'ADD TERM');?>
        	<?php echo form_close();?>
        </p>
        
	</div>

	<p class="footer">
    	University of the Philippines Los Ba&ntilde;os<br />
    	All Rights Reserved. &copy; 2013 Created by Nesceal Delizo
    </p>
</div>

</body>
</html>