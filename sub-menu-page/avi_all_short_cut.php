<?php 

if ( !current_user_can( 'manage_options' ) )  {
	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
?>
<div>
	<h2>This code will create three fields form in your page are blog</h2>
	<h3>[avi_three_fields]</h3>
</div>
<hr>
<div>
	<h2>Second Short code</h2>
	<?php 

	$str = '&lt;a href=&quot;https://www.w3schools.com&quot;&gt;w3schools.com&lt;/a&gt;';
	echo 	$str ;
	?>
</div>