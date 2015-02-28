<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SP | Results</title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>design/style/style.css" />
    <link href="<?php echo base_url();?>design/images/icon.jpg" rel="shortcut icon" type="image/x-icon">
</head>
<body>

<div class="container">
	
    <h1>
    	UPLB Course Demand Prediction System :: Search Results
        
    	<?php echo form_open('admin/logout'); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'LOGOUT');?>
		<?php echo form_close();?>
        
        <?php echo form_open('admin/search'); ?>
		<?php echo form_submit(array('name'=>'submit','class'=>'submits topnav curved'), 'SEARCH');?>
		<?php echo form_close();?>
    </h1>

	<div id="results" class="body">
        	
            <?php
            	
				$count = 0;
				$search_results_query = $this->admin_model->search_courses($course_id);
				foreach ($search_results_query->result() as $row ){ $count = $count + 1; };
			
			?>
            
            <br />
            <table>
            
 				<td><label  style="border-bottom-style: solid; border-bottom-width: 1px"><?php echo $count; ?> Result(s) for "<?php echo $course_id; ?>"</label></td>
				<td><?php echo nbs(5); ?><label  style="border-bottom-style: solid; border-bottom-width: 1px">Course Title</label></td>
                <td><?php echo nbs(1); ?><label  style="border-bottom-style: solid; border-bottom-width: 1px">Units</label></td>
                <td><?php echo nbs(17); ?><label  style="border-bottom-style: solid; border-bottom-width: 1px">ACTIONS</label></td>
                
                <?php
					
					foreach ($search_results_query -> result() as $row ){
						
                        $course_id = $row->course_id;
                        $course_dept = $row->course_dept;
                        $course_units = $row->course_units;
                        $course_term = $row->course_term;
                        $course_title = $row->course_title;
                        
						echo '<tr>';
						
							echo '<td>';
								echo nbs(8).$course_id;
							echo '</td>';
							
							echo '<td>';
								echo nbs(5).$course_title;
							echo '</td>';
                            
                            echo '<td>';
								echo nbs(3)."(".$course_units.")";
							echo '</td>';
							
							echo '<td>';
								echo nbs(11).anchor('admin/dashboard/'.$course_id, '<img src="http://127.0.0.1/MM/images/img_view.png" title="View Course Profile" width="24px" />').nbs(1).anchor('admin/edit/'.$course_id, '<img src="http://127.0.0.1/MM/images/img_edit.png" title="Edit Course Info" width="24px" />').nbs(1).anchor('admin/download/'.$course_id, '<img src="http://127.0.0.1/MM/images/img_download.png" title="Download Course Info" width="24px" />').nbs(1).anchor('admin/delete/'.$course_id, '<img src="http://127.0.0.1/MM/images/img_delete.png" title="Delete Course" width="24px", />', array('onClick'=>"return confirm('Are you sure you want to delete this?')"));
							echo '</td>';
							
						echo '</tr>';
					}
            	?>
            </table>
        
	</div>

	<p class="footer">
    	University of the Philippines Los Ba&ntilde;os<br />
    	All Rights Reserved. &copy; 2013 Created by Nesceal Delizo
    </p>
</div>

</body>
</html>