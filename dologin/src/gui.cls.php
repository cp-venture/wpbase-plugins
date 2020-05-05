<?php
/**
 * GUI class
 *
 * @since 1.0
 */
namespace dologin;

defined( 'WPINC' ) || exit;

class GUI extends Instance
{
	protected static $_instance;

	/**
	 * Init
	 *
	 * @since  1.3
	 * @access public
	 */
	public function init()
	{
		add_action( 'login_message', array( $this, 'login_message' ) );

		add_action( 'login_enqueue_scripts', array( $this, 'login_enqueue_scripts' ) );

		// Register injection for phone number
		add_action( 'register_form', array( $this, 'register_form' ) );

		add_action( 'lostpassword_form', array( $this, 'lostpassword_form' ) );

		// Append js and set ajax url
		add_action( 'login_form', array( $this, 'login_form' ) );

		add_action( 'woocommerce_login_form', array( $this, 'login_enqueue_scripts' ) );
		add_action( 'woocommerce_login_form', array( $this, 'login_form' ) );
	}

	/**
	 * Enqueue js
	 *
	 * @since  1.3
	 * @access public
	 */
	public function login_enqueue_scripts()
	{
		if ( ! Util::is_login_page() ) {
			// return;
		}

		$this->enqueue_style();

		// JS is only for sms code
		if ( ! Conf::val( 'sms' ) ) {
			return;
		}

		wp_register_script( 'dologin', DOLOGIN_PLUGIN_URL . 'assets/login.js', array( 'jquery' ), Core::VER, false );

		$localize_data = array();
		$localize_data[ 'login_url' ] = get_rest_url( null, 'dologin/v1/sms' );
		wp_localize_script( 'dologin', 'dologin', $localize_data );

		wp_enqueue_script( 'dologin' );
	}

	/**
	 * Load style
	 *
	 * @since 1.3
	 */
	public function enqueue_style()
	{
		wp_enqueue_style( 'dologin', DOLOGIN_PLUGIN_URL . 'assets/login.css', array(), Core::VER, 'all');
	}

	/**
	 * Load css/js for admin
	 *
	 * @since 2.0
	 */
	public function enqueue_admin()
	{
		// Only enqueue on dologin pages
		if( empty( $_GET[ 'page' ] ) || strpos( $_GET[ 'page' ], 'dologin' ) !== 0 ) {
			return;
		}

		$this->enqueue_style();

		wp_register_script( 'dologin_admin', DOLOGIN_PLUGIN_URL . 'assets/admin.js', array( 'jquery' ), Core::VER, false );

		$localize_data = array();
		$localize_data[ 'url_test_sms' ] = get_rest_url( null, 'dologin/v1/test_sms' );
		$localize_data[ 'url_myip' ] = get_rest_url( null, 'dologin/v1/myip' );
		$localize_data[ 'current_user_phone' ] = SMS::get_instance()->current_user_phone();
		wp_localize_script( 'dologin_admin', 'dologin_admin', $localize_data );

		wp_enqueue_script( 'dologin_admin' );

	}

	/**
	 * Display login form
	 *
	 * @since  1.3
	 * @access public
	 */
	public function login_form()
	{
		if ( Conf::val( 'sms' ) ) {
			echo '	<p id="dologin-process">
						Dologin Security:
						<span id="dologin-process-msg"></span>
					</p>
					<p id="dologin-dynamic_code">
						<label for="dologin-two_factor_code">' . __( 'Dynamic Code', 'dologin' ) . '</label>
						<br /><input type="text" name="dologin-two_factor_code" id="dologin-two_factor_code" autocomplete="off" />
					</p>
				';
		}

		if ( Conf::val( 'gg' ) ) {
			Captcha::get_instance()->show();
		}
	}

	/**
	 * Inject register form
	 *
	 * @since  1.9
	 * @access public
	 */
	public function register_form()
	{
		if ( Conf::val( 'sms_force' ) ) {
			echo '	<p>
						<label for="phone_number">' . __( 'Dologin Security Phone', 'dologin' ) . '</label>
						<input type="text" name="phone_number" id="phone_number" class="input" size="25" required />
					</p>
			';
		}

		if ( Conf::val( 'gg' ) && Conf::val( 'recapt_register' ) ) {
			Captcha::get_instance()->show();
		}
	}

	/**
	 * Inject lost password form
	 *
	 * @since  1.9
	 * @access public
	 */
	public function lostpassword_form()
	{
		if ( Conf::val( 'gg' ) && Conf::val( 'recapt_forget' ) ) {
			Captcha::get_instance()->show();
		}
	}

	/**
	 * Show admin msg
	 *
	 * @since  2.0
	 */
	public static function show_admin_msg( $msg )
	{
		$color = 'notice notice-success';
		echo '<div class="' . $color . ' is-dismissible"><p>'. $msg . '</p></div>';
	}

	/**
	 * Login default display messages
	 *
	 * @since  1.1
	 * @access public
	 */
	public function login_message( $msg )
	{
		if ( defined( 'DOLOGIN_ERR' ) ) {
			return;
		}

		$msg .= '<div class="success">' . Lang::msg( 'under_protected' ) . '<img src="' . DOLOGIN_PLUGIN_URL . 'assets/shield.svg" class="dologin-shield"></div>';

		return $msg;
	}

	/**
	 * Register this setting to save
	 *
	 * @since  2.0
	 * @access public
	 */
	public function enroll( $id )
	{
		echo '<input type="hidden" name="_settings-enroll[]" value="' . $id . '" />';
	}

	/**
	 * Build a textarea
	 *
	 * @since 2.0
	 * @access public
	 */
	public function build_textarea( $id, $cols = false, $val = null )
	{
		if ( $val === null ) {
			$val = Conf::val( $id );

			if ( is_array( $val ) ) {
				$val = implode( "\n", $val );
			}
		}

		if ( ! $cols ) {
			$cols = 80;
		}

		$this->enroll( $id );

		echo "<textarea name='$id' rows='9' cols='$cols'>" . esc_textarea( $val ) . "</textarea>";
	}

	/**
	 * Build a text input field
	 *
	 * @since 2.0
	 * @access public
	 */
	public function build_input( $id, $cls = null, $val = null, $type = 'text' )
	{
		if ( $val === null ) {
			$val = Conf::val( $id );
		}

		$label_id = preg_replace( '|\W|', '', $id );

		if ( $type == 'text' ) {
			$cls = "regular-text $cls";
		}

		$this->enroll( $id );

		echo "<input type='$type' class='$cls' name='$id' value='" . esc_textarea( $val ) ."' id='input_$label_id' /> ";
	}


	/**
	 * Build a switch div html snippet
	 *
	 * @since 2.0
	 * @access public
	 */
	public function build_switch( $id )
	{
		$this->enroll( $id );

		echo '<div class="dologin-switch">';

		$this->build_radio( $id, 0, null, true );
		$this->build_radio( $id, 1, null, true );

		echo '</div>';
	}

	/**
	 * Build a radio input html codes and output
	 *
	 * @since 2.0
	 * @access public
	 */
	public function build_radio( $id, $val, $txt = null, $bypass_enroll = false )
	{
		$id_attr = 'input_radio_' . preg_replace( '|\W|', '', $id ) . '_' . $val;

		if ( ! $txt ) {
			if ( $val ) {
				$txt = __( 'ON', 'dologin-cache' );
			}
			else {
				$txt = __( 'OFF', 'dologin-cache' );
			}
		}

		if ( ! is_string( Conf::$_default_options[ $id ] ) ) {
			$checked = (int) Conf::val( $id ) === (int) $val ? ' checked ' : '';
		}
		else {
			$checked = Conf::val( $id ) === $val ? ' checked ' : '';
		}

		if ( ! $bypass_enroll ) {
			$this->enroll( $id );
		}

		echo "<input type='radio' autocomplete='off' name='$id' id='$id_attr' value='$val' $checked /> <label for='$id_attr'>$txt</label>";
	}


}