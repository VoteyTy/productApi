<h2>HI List User</h2>

<table>
	<tr>
		<td>id</td>
		<td>FirstName</td>
		<td>LastName</td>
		<td>Email</td>
		<td>Location</td>
		<td>Created</td>
	</tr>
	<tr>
		<?php foreach($users as $var) //print_r($var); ?>
		<td><?php echo $var['users']['id']; ?></td>
		<td><?php echo $var['users']['firstname']; ?></td>
		<td><?php echo $var['users']['lastname']; ?></td>	
		<td><?php echo $var['users']['email']; ?></td>
		<td><?php echo $var['users']['location']; ?></td>
		<td><?php echo $var['users']['created']; ?></td>
		<php endforeach ?>

	</tr>
</table>
