<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SP | Confirm</title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>design/style/style.css" />
    <link href="<?php echo base_url();?>design/images/icon.jpg" rel="shortcut icon" type="image/x-icon">
</head>
<body>

<div class="container">
	
    <h1>
    	UPLB Course Demand Prediction System :: Confirm List of Demands
        
    	<?php echo form_open('admin/logout'); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'LOGOUT');?>
		<?php echo form_close();?>
        
        <?php echo form_open('admin/dashboard/'.$course_id); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'BACK');?>
		<?php echo form_close();?>
    </h1>

	<div id="results" class="body" style="height:390px; font-family:'Courier New', Courier, monospace;">
            
            <br />
            <table>
            
 				<td><label  style="border-bottom-style: solid; border-bottom-width: 1px"><?php echo ($ctr); ?> Demands on the List</label></td>
				<td><?php echo nbs(5); ?><label  style="border-bottom-style: solid; border-bottom-width: 1px">Demand Value</label></td>
                <td><?php echo nbs(10); ?><label  style="border-bottom-style: solid; border-bottom-width: 1px">ACTION</label></td>
                
                <?php
					
					for($i=0; $i<$ctr; $i++){
                        
						echo '<tr>';
						
							echo '<td>';
								echo $demand_labels[$i];
							echo '</td>';
							
							echo '<td>';
								echo nbs(10).$demand_array[$i];
							echo '</td>';
							
							echo '<td>';
								echo nbs(10).anchor('admin/delete_item/'.$course_id.'/'.$i, 'Delete', array('onClick'=>"return confirm('Are you sure you want to delete this item?')"));
							echo '</td>';
							
						echo '</tr>';
					}
            	?>
            </table>
            
            <br />
            <table>
            <?php echo form_open('admin/mforecast/'.$course_id); ?>
            
            <tr>
            	<td>
                	ALPHA:
                </td>
                <td>
                	<?php echo form_input(array('id'=> 'alpha', 'name'=>'alpha', 'class'=>'inputs curved', 'value'=>'0.9')); ?>
                </td>
            </tr>
            
			</table>
            <br />
            
			<?php echo form_submit(array('name'=>'submit','class'=>'submits curved'), 'FORECAST');?>
			<?php echo form_close();?>
        
	</div>

	<p class="footer">
    	University of the Philippines Los Ba&ntilde;os<br />
    	All Rights Reserved. &copy; 2013 Created by Nesceal Delizo
    </p>
</div>

</body>
</html>