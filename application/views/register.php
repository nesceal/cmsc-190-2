<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SP | Register</title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>design/style/style.css" />
    <link href="<?php echo base_url();?>design/images/icon.jpg" rel="shortcut icon" type="image/x-icon">
</head>
<body>

<div class="container">
	<h1>UPLB Course Demand Prediction System :: Register</h1>

	<div class="body">
        
        <div id="register" class="boxed curved">
        	
            <?php echo form_open('admin/reg_admin'); ?>
            <?php echo form_label('Enter ADMIN ID:','admin_id',array('class'=>'labels') ); ?>
            <?php echo nbs(3);?>
            <?php echo form_input(array('id'=> 'admin_id', 'name'=>'admin_id', 'class'=>'inputs curved'));?>
            <br /><br />
            <?php echo form_label('Enter USERNAME:','username',array('class'=>'labels') ); ?>
            <?php echo nbs(3);?>
            <?php echo form_input(array('id'=> 'admin_username', 'name'=>'admin_username', 'class'=>'inputs curved'));?>
            <br /><br />
            <?php echo form_label('Enter PASSWORD:','password',array('class'=>'labels') ); ?>
            <?php echo nbs(3);?>
            <?php echo form_password(array('id'=> 'admin_password', 'name'=>'admin_password', 'class'=>'inputs curved'));?>
            <br /><br />
            <?php echo nbs(25);?>
            <?php echo form_submit(array('name'=>'submit','class'=>'submits curved'), 'REGISTER');?>
            
            <?php echo validation_errors(); ?>
            
            <?php echo form_close();?>
            
            <br />
            <?php echo nbs(60);?>
        	<?php echo anchor('admin/index','GO BACK',array('class'=>'anchors')) ?>
        	
        </div>
        
	</div>

	<p class="footer">
    	University of the Philippines Los Ba&ntilde;os<br />
    	All Rights Reserved. &copy; 2013 Created by Nesceal Delizo
    </p>
</div>

</body>
</html>