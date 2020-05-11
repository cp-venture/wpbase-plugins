<?php
namespace dologin;
defined( 'WPINC' ) || exit;

?>
<h3 class="dologin-title-short">
	<?php echo __( 'Login Attempts Log', 'dologin' ); ?>
</h3>

<table class="wp-list-table widefat striped">
	<thead>
	<tr>
		<th>#</th>
		<th><?php echo __( 'Date', 'dologin' ); ?></th>
		<th><?php echo __( 'IP', 'dologin' ); ?></th>
		<th><?php echo __( 'GeoLocation', 'dologin' ); ?></th>
		<th><?php echo __( 'Login As', 'dologin' ); ?></th>
		<th><?php echo __( 'Gateway', 'dologin' ); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ( $this->log() as $v ) : ?>
		<tr>
			<td><?php echo $v->id; ?></td>
			<td><?php echo Util::readable_time( $v->dateline ); ?></td>
			<td><?php echo $v->ip; ?></td>
			<td><?php echo $v->ip_geo; ?></td>
			<td><?php echo $v->username; ?></td>
			<td><?php echo $v->gateway; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
