<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SP | Search</title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>design/style/style.css" />
    <link href="<?php echo base_url();?>design/images/icon.jpg" rel="shortcut icon" type="image/x-icon">
</head>
<body>

<div class="container">
	
    <h1>
    	UPLB Course Demand Prediction System :: Search
    	<?php echo form_open('admin/logout'); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'LOGOUT');?>
		<?php echo form_close();?>
    </h1>

	<div class="body">
        
        <div class="minibox boxed curved">
        	
            <?php echo form_open('admin/results'); ?>
            <?php echo form_label('ENTER COURSE ID:','course_id',array('class'=>'labels') ); ?>
            <?php echo form_input(array('id'=> 'course_id', 'name'=>'course_id', 'class'=>'inputs curved'));?>
            <br /><br />
            <?php echo nbs(20);?>
            <?php echo form_submit(array('name'=>'submit','class'=>'submits curved'), 'SUBMIT');?>
			<?php echo validation_errors();?>
            <?php echo form_close();?>
        	
        </div>
        
	</div>

	<p class="footer">
    	University of the Philippines Los Ba&ntilde;os<br />
    	All Rights Reserved. &copy; 2013 Created by Nesceal Delizo
    </p>
</div>

</body>
</html>