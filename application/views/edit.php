<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SP | Edit</title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>design/style/style.css" />
    <link href="<?php echo base_url();?>design/images/icon.jpg" rel="shortcut icon" type="image/x-icon">
</head>
<body>

<div class="container">
	
    <h1>
    	UPLB Course Demand Prediction System :: Edit Course Info
    	
		<?php echo form_open('admin/logout'); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'LOGOUT');?>
		<?php echo form_close();?>
        
        <?php echo form_open('admin/dashboard/'.$course_id); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'BACK');?>
		<?php echo form_close();?>
    </h1>

	<div id="editable" class="body boxed curved">
        	
        <?php echo form_open('admin/update'); ?>
        <br /><br />
        <table align="center">
            
        	<tr>
                <td>
            		<label>COURSE ID: </label>
                </td>
                <td>
                	<?php echo form_input(array('id'=>'course_id', 'name'=>'course_id', 'value'=>$course_id, 'class'=>'inputs curved'));?>
                    <br /><?php echo form_error('course_id'); ?>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;<label>COURSE TITLE: </label>
                </td>
                <td>
                    <?php echo form_input(array('id'=>'course_title', 'name'=>'course_title', 'value'=>$course_title, 'class'=>'inputs curved'));?>
                        <br /><?php echo form_error('course_title'); ?>
                </td>
            </tr>
            
            <tr>
            	<td>
                    <label>COURSE UNITS: </label>
                </td>
                <td>
                    <?php echo form_input(array('id'=>'course_units', 'name'=>'course_units', 'value'=>$course_units, 'class'=>'inputs curved'));?>
                        <br /><?php echo form_error('course_units'); ?>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;<label>DEPARTMENT: </label>
                </td>
                <td>
                    <?php echo form_input(array('id'=>'course_dept', 'name'=>'course_dept', 'value'=>$course_dept, 'class'=>'inputs curved'));?>
                        <br /><?php echo form_error('course_dept'); ?>
                </td>
            </tr>
            
            <tr>
            	<td>
                    <label>TERMS OFFERED: </label>
                </td>
                <td>
                    <?php echo form_input(array('id'=>'course_term', 'name'=>'course_term', 'value'=>$course_term, 'class'=>'inputs curved'));?>
                        <br /><?php echo form_error('course_term'); ?>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;<label>PREREQUISITE/S: </label>
                </td>
                <td>
                    <?php echo form_input(array('id'=>'course_prereq', 'name'=>'course_prereq', 'value'=>$course_prereq, 'class'=>'inputs curved'));?>
                        <br /><?php echo form_error('course_prereq'); ?>
                </td>
            </tr>
            
            <tr>
            	<td>
                    <label>LECTURE HOURS: </label>
                </td>
                <td>
                    <?php echo form_input(array('id'=>'course_xhrs', 'name'=>'course_xhrs', 'value'=>$course_xhrs, 'class'=>'inputs curved'));?>
                        <br /><?php echo form_error('course_xhrs'); ?>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;<label>LAB HOURS: </label>
                </td>
                <td>
                    <?php echo form_input(array('id'=>'course_lhrs', 'name'=>'course_lhrs', 'value'=>$course_lhrs, 'class'=>'inputs curved'));?>
                        <br /><?php echo form_error('course_lhrs'); ?>
                </td>
            </tr>
                
        </table>
            
        <br />
        
        <p align="center">
        	<?php echo form_submit(array('name'=>'submit','class'=>'submits curved'), 'UPDATE');?>
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