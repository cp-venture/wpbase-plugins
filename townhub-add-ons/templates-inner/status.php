<?php
/* add_ons_php */
if( !isset($hide_status) ) $hide_status = 'no';
if( !isset($show_counter) ) $show_counter = 'no';
$working_hours = Esb_Class_Listing_CPT::parse_wkhours(get_the_ID()); 
// var_dump($working_hours);
if( !empty($working_hours) ):
	if( $hide_status != 'yes' ):
	    $sicon = 'fal fa-lock';
	    if($working_hours['status'] == 'opening') $sicon = 'fal fa-lock-open';
	    if( isset($working_hours['for_event']) && $working_hours['for_event'] ) $sicon = 'fal fa-clock'; 
?>
	<div class="geodir_status_date lstatus-<?php echo esc_attr( $working_hours['status'] ); ?>"><i class="<?php echo esc_attr( $sicon ); ?>"></i><?php echo $working_hours['statusText']; ?></div>
	<?php 
	endif;
	if( $show_counter == 'yes' && isset($working_hours['for_event']) && $working_hours['for_event'] ): 

	?>
	<div class="box-widget countdown-widget" data-countdate="<?php echo Esb_Class_Date::format($working_hours['event_dates']['start_date'],'m/d/Y H:i:s');  ?>">
	    <div class="countdown flex-items-center">
	        <div class="countdown-item">
	            <span class="days rot">00</span>
	            <p><?php _e( 'days', 'townhub-add-ons' ); ?></p>
	        </div>
	        <div class="countdown-item">
	            <span class="hours rot">00</span>
	            <p><?php _e( 'hours', 'townhub-add-ons' ); ?></p>
	        </div>
	        <div class="countdown-item">
	            <span class="minutes rot2">00</span>
	            <p><?php _e( 'minutes', 'townhub-add-ons' ); ?></p>
	        </div>
	        <div class="countdown-item">
	            <span class="seconds rot2">00</span>
	            <p><?php _e( 'seconds', 'townhub-add-ons' ); ?></p>
	        </div>
	    </div>
	</div>
<?php 
	endif;
endif;

