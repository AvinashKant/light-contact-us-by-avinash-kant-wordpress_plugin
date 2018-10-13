<?php 

if ( !current_user_can( 'manage_options' ) )  {
	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}

global $wpdb;
$allDataFromDb = $wpdb->get_results( 
	"SELECT * FROM `avi_light_post_data` ORDER BY create_at DESC;"
);

?>
<style type="text/css">
.pagehandling{
	background-color: #fff;
	margin: 5px;
	padding: 5px;
	border-radius: 5px;
	text-align: center;
}
.maintable table{
	width: 100%;
	border-spacing: 0;
	border-collapse: collapse;
	border-radius: 5px;	
}
.maintable td,th {
	padding: 0
}

.maintable table thead tr{
	background-color: #fff;
	color: #000;
	border-bottom: 1px solid lightblue;
}
.maintable table thead tr th{
	padding: 10px;
	font-size: 14px;
	/*font-style: italic;*/
}
.maintable table tbody tr td{
	background-color: #fff;
	border-bottom: 1px solid lightblue;
	padding: 5px;
	font-size: 16px;
	text-align: center;
}
.maintable .showAllContent{
	display: none;
}
</style>
<div class="pagehandling">
	<h1>
		Query by users.
	</h1>
</div>
<div class="maintable">
	<table>
		<thead>
			<tr>
				<th>SN.</th>
				<th>Name</th>
				<th>Email</th>
				<th>Message</th>
				<th>Time</th>
			</tr>
		</thead>
		<?php 
		if(!empty($allDataFromDb)){ ?>
			<tbody>
				<?php $i=1;	foreach ($allDataFromDb as $id ){  ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $id->user_name; ?></td>
						<td><?php echo $id->user_email; ?></td>
						<td class="userMsgReadMoreOpeation"><?php echo $id->user_message; ?></td>
						<td><?php echo date('d/m/y H:i:s A',strtotime($id->create_at)); ?></td>
					</tr>
				</tbody>


				<?php	$i++; } ?>

			<?php }else{ ?>
				<tr>
					<td colspan="5">
						<div style="padding: 5px;margin: 10px 10px;">
							No record Found.
						</div>
					</td>
				</tr>
				
			<?php }?>
		</table>
	</div>
	<script type="text/javascript">
		var $aviLightPlugin = jQuery.noConflict();		

		$aviLightPlugin(".userMsgReadMoreOpeation").each(function() {
			var tdText = $aviLightPlugin(this).text();
			if(tdText.length > 80){
				var readMoreTextContent =  '<div class="showLessContent">'+ tdText.substring(0,80)+' <b><i class="readMoreText"> readmore.... </i></b>'+'</div>';
				var readlessTextContent = '<div class="showAllContent">'+ tdText+' <b><i class="readLessText"> readless.... </i></b>'+' </div>';
				$aviLightPlugin(this).html(readlessTextContent + ' '+readMoreTextContent);
			}
		});

		$aviLightPlugin('.readMoreText').click(function(){
			$aviLightPlugin(this).parent().parent().hide();
			$aviLightPlugin(this).parent().parent().prev().show();
		});
		$aviLightPlugin('.readLessText').click(function(){
			$aviLightPlugin(this).parent().parent().hide();
			$aviLightPlugin(this).parent().parent().next().show();
		});
	</script>
