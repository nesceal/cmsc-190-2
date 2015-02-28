<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SP | Index</title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>design/style/style.css" />
    <link href="<?php echo base_url();?>design/images/icon.jpg" rel="shortcut icon" type="image/x-icon">
</head>
<body>

<div class="container">
	<h1>UPLB Course Demand Prediction System</h1>

	<div class="body">
        
        <div class="minibox boxed curved">
        	
            <?php echo form_open('admin/login'); ?>
            <?php echo form_label('USERNAME:','username',array('class'=>'labels') ); ?>
            <?php echo nbs(3);?>
            <?php echo form_input(array('id'=> 'username', 'name'=>'username', 'class'=>'inputs curved'));?>
            <br /><br />
            <?php echo form_label('PASSWORD:','password',array('class'=>'labels') ); ?>
            <?php echo nbs(3);?>
            <?php echo form_password(array('id'=> 'password', 'name'=>'password', 'class'=>'inputs curved'));?>
            <br /><br />
            <?php echo nbs(10);?>
            <?php echo form_submit(array('name'=>'submit','class'=>'submits curved'), 'LOGIN');?>
            <?php echo form_close();?>
        	
			<?php echo validation_errors(); ?>
            <br />
            <?php echo nbs(25);?>
        	<?php echo anchor('admin/register','REGISTER',array('class'=>'anchors')) ?>
        </div>
        
	</div>

	<p class="footer">
    	University of the Philippines Los Ba&ntilde;os<br />
    	All Rights Reserved. &copy; 2013 Created by Nesceal Delizo
    </p>
</div>

</body>
</html>