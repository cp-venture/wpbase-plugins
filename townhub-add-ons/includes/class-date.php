<?php
/* add_ons_php */

class Esb_Class_Date
{

    public static function timezone()
    {
        $tz = get_option('timezone_string');
        if ($tz) {
            return $tz;
        } else if ( $offset = get_option('gmt_offset') ) {
            return self::tz_offset__name( $offset );
        }
        return 'UTC';
    }

    public static function tz_offset__name($offset)
    {
        $offset *= 3600; // convert hour offset to seconds
        $abbrarray = timezone_abbreviations_list();
        if($abbrarray){
            foreach ($abbrarray as $abbr)
            {
                foreach ($abbr as $city)
                {
                    if ($city['offset'] == $offset)
                    {
                        return $city['timezone_id'];
                    }
                }
            }
        }
            

        return 'UTC';
        // return false;
    }

    public static function tz_details($tz = ''){
        if( empty($tz) ) $tz = self::timezone();
        $listingTimezone = new DateTimeZone( $tz );
        
        $utcTimezone        = new DateTimeZone('UTC');
        $utcDateTime        = new DateTime('now', $utcTimezone);
        $utcPrevDateTime    = new DateTime('now-1day', $utcTimezone);
        // $currentDateTime = new DateTime('now', $listingTimezone);
        // $prevDateTime    = new DateTime('now-1day', $listingTimezone);
        // change utc time to listing time zone
        $utcDateTime->setTimezone($listingTimezone);
        $utcPrevDateTime->setTimezone($listingTimezone);
        return array(
            // 'tz_offset'     => $listingTimezone->getOffset($utcDateTime),
            'tz_offset'     => $utcDateTime->format('Z'),
            // 'day'           => $utcDateTime->format('l'), //Sunday - Saturday 
            'day'           => $utcDateTime->format('D'), // Mon - Sun
            // 'hour'          => $utcDateTime->format('G.i'),
            'hour'          => $utcDateTime->format('His'),
            'date'          => $utcDateTime->format('Y-m-d H:i:s'),

            // 'prev_day'      => $utcPrevDateTime->format('l'), //Sunday - Saturday 
            'prev_day'      => $utcPrevDateTime->format('D'), // Mon - Sun
        );
    }
    // get utc offset from listing timezone -> for mysql CONVERT_TZ
    public static function utc_tz_offset($tz=''){
        if( empty($tz) ) $tz = self::timezone();
        $listingTimezone = new DateTimeZone( $tz );

        $date = new DateTime('now', $listingTimezone);

        // create a new date offset by the timezone offset
        // gets the interval as hours & minutes
        $offset = $listingTimezone->getOffset($date) . ' seconds';
        $dateOffset = clone $date;
        $dateOffset->sub(DateInterval::createFromDateString($offset));

        $interval = $dateOffset->diff($date);
        return $interval->format('%R%H:%I');
    }

    public static function week_days(){
        $days = array(
            'Mon' => __( 'Monday',  'townhub-add-ons' ),
            'Tue' => __( 'Tuesday',  'townhub-add-ons' ),
            'Wed' => __( 'Wednesday',  'townhub-add-ons' ),
            'Thu' => __( 'Thursday',  'townhub-add-ons' ),
            'Fri' => __( 'Friday',  'townhub-add-ons' ),
            'Sat' => __( 'Saturday',  'townhub-add-ons' ),
            'Sun' => __( 'Sunday',  'townhub-add-ons' ),
        );
        return $days;
    }

    public static function wkhours_select()
    {
        $hours = array(
            '00:00:00' => __('12:00 AM', 'townhub-add-ons'),
            '00:30:00' => __('12:30 AM', 'townhub-add-ons'),

            '01:00:00' => __('1:00 AM', 'townhub-add-ons'),
            '01:30:00' => __('1:30 AM', 'townhub-add-ons'),

            '02:00:00' => __('2:00 AM', 'townhub-add-ons'),
            '02:30:00' => __('2:30 AM', 'townhub-add-ons'),

            '03:00:00' => __('3:00 AM', 'townhub-add-ons'),
            '03:30:00' => __('3:30 AM', 'townhub-add-ons'),

            '04:00:00' => __('4:00 AM', 'townhub-add-ons'),
            '04:30:00' => __('4:30 AM', 'townhub-add-ons'),

            '05:00:00' => __('5:00 AM', 'townhub-add-ons'),
            '05:30:00' => __('5:30 AM', 'townhub-add-ons'),

            '06:00:00' => __('6:00 AM', 'townhub-add-ons'),
            '06:30:00' => __('6:30 AM', 'townhub-add-ons'),

            '07:00:00' => __('7:00 AM', 'townhub-add-ons'),
            '07:30:00' => __('7:30 AM', 'townhub-add-ons'),

            '08:00:00' => __('8:00 AM', 'townhub-add-ons'),
            '08:30:00' => __('8:30 AM', 'townhub-add-ons'),

            '09:00:00' => __('9:00 AM', 'townhub-add-ons'),
            '09:30:00' => __('9:30 AM', 'townhub-add-ons'),

            '10:00:00' => __('10:00 AM', 'townhub-add-ons'),
            '10:30:00' => __('10:30 AM', 'townhub-add-ons'),

            '11:00:00' => __('11:00 AM', 'townhub-add-ons'),
            '11:30:00' => __('11:30 AM', 'townhub-add-ons'),

            '12:00:00' => __('12:00 PM', 'townhub-add-ons'),
            '12:30:00' => __('12:30 PM', 'townhub-add-ons'),

            '13:00:00' => __('1:00 PM', 'townhub-add-ons'),
            '13:30:00' => __('1:30 PM', 'townhub-add-ons'),

            '14:00:00' => __('2:00 PM', 'townhub-add-ons'),
            '14:30:00' => __('2:30 PM', 'townhub-add-ons'),

            '15:00:00' => __('3:00 PM', 'townhub-add-ons'),
            '15:30:00' => __('3:30 PM', 'townhub-add-ons'),

            '16:00:00' => __('4:00 PM', 'townhub-add-ons'),
            '16:30:00' => __('4:30 PM', 'townhub-add-ons'),

            '17:00:00' => __('5:00 PM', 'townhub-add-ons'),
            '17:30:00' => __('5:30 PM', 'townhub-add-ons'),

            '18:00:00' => __('6:00 PM', 'townhub-add-ons'),
            '18:30:00' => __('6:30 PM', 'townhub-add-ons'),

            '19:00:00' => __('7:00 PM', 'townhub-add-ons'),
            '19:30:00' => __('7:30 PM', 'townhub-add-ons'),

            '20:00:00' => __('8:00 PM', 'townhub-add-ons'),
            '20:30:00' => __('8:30 PM', 'townhub-add-ons'),

            '21:00:00' => __('9:00 PM', 'townhub-add-ons'),
            '21:30:00' => __('9:30 PM', 'townhub-add-ons'),

            '22:00:00' => __('10:00 PM', 'townhub-add-ons'),
            '22:30:00' => __('10:30 PM', 'townhub-add-ons'),

            '23:00:00' => __('11:00 PM', 'townhub-add-ons'),
            '23:30:00' => __('11:30 PM', 'townhub-add-ons'),

            // '24:00:00' => __( '12:00 PM',  'townhub-add-ons' ),

        );
        return (array) apply_filters('cth_wkhours_select', $hours);
    }
    public static function reformat($date = '', $time = false, $format = '' ){
        if($date == 'NEVER') return esc_html__( 'NEVER', 'townhub-add-ons' ); // return $date;
        $dateObj = new DateTime($date);
        if($format == ''){
            $format = get_option('date_format');
            if($time) $format .= ' '.get_option( 'time_format' );
        }
        return $dateObj->format($format);
    }
    public static function i18n($date = '', $time = false, $format = '' ){
        if($date == 'NEVER') return esc_html__( 'NEVER', 'townhub-add-ons' ); // return $date;
        $timestamp = strtotime($date);
        if($format == ''){
            $format = get_option('date_format');
            if($time) $format .= ' '.get_option( 'time_format' );
        }
        if( $timestamp ){
            return date_i18n($format, $timestamp);
        }else{
            return $date;
        }
    }
    public static function format($date = 'now', $format = 'Ymd'){
        $dateObj = new DateTime($date);
        return $dateObj->format($format);
    }
    public static function format_new($date = '', $format = '', $time = false ){
        if($date == 'NEVER') return $date;
        $dateObj = new DateTime($date);
        if($format == ''){
            $format = get_option('date_format');
            if($time) $format .= ' '.get_option( 'time_format' );
        }
        return $dateObj->format($format);
    }

    public static function modify($date = 'now', $modify = 0, $format = 'Ymd'){
        $dateObj = new DateTime($date);
        if($dateObj){
            $dateObj->modify($modify .' days');
            return $dateObj->format($format);
        }
        return false; 
    }
    public static function compare($date_one = '', $date_two = '', $compare = '<'){
        $date_one = new DateTime($date_one);
        $date_two = new DateTime($date_two);

        switch ($compare) {
            case '<=':
                return $date_one <= $date_two;
                break;
            case '=':
                return $date_one == $date_two;
                break;
            case '>=':
                return $date_one >= $date_two;
                break;
            case '<':
                return $date_one < $date_two;
                break;
            case '>':
                return $date_one > $date_two;
                break;
            default:
                return $date_one < $date_two;
                break;
        }
    }
}
