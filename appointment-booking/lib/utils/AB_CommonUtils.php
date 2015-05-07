<?php

/**
 * Class AB_CommonUtils
 *
 */
class AB_CommonUtils {

    /**
     * Get e-mails of wp-admins
     *
     * @return array
     */
    public static function getAdminEmails() {
        return array_map(
            create_function( '$a', 'return $a->data->user_email;' ),
            get_users( 'role=administrator' )
        );
    } // getAdminEmails

    /**
     * Generates email's headers FROM: Sender Name < Sender E-mail >
     *
     * @return string
     */
    public static function getEmailHeaderFrom() {
        $from_name  = get_option( 'ab_settings_sender_name' );
        $from_email = get_option( 'ab_settings_sender_email' );
        $from = $from_name . ' <' . $from_email . '>';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: '.$from . "\r\n";

        return $headers;
    } // getEmailHeaderFrom

    /**
     * Format price based on currency settings (Settings -> Payments).
     *
     * @param  string $price
     * @return string
     */
    public static function formatPrice( $price ) {
        $price  = floatval( $price );
        switch ( get_option( 'ab_paypal_currency' ) ) {
            case 'AUD' : return 'A$' . number_format_i18n( $price, 2 );
            case 'BRL' : return 'R$ ' . number_format_i18n( $price, 2 );
            case 'CAD' : return 'C$' . number_format_i18n( $price, 2 );
            case 'CHF' : return number_format_i18n( $price, 2 ) . ' CHF';
            case 'CLP' : return 'CLP $' . number_format_i18n( $price, 2 );
            case 'COP' : return '$' . number_format_i18n( $price ) . ' COP';
            case 'CZK' : return number_format_i18n( $price, 2 ) . ' Kč';
            case 'DKK' : return number_format_i18n( $price, 2 ) . ' kr';
            case 'EUR' : return '€' . number_format_i18n( $price, 2 );
            case 'GBP' : return '£' . number_format_i18n( $price, 2 );
            case 'GTQ' : return 'Q' . number_format_i18n( $price, 2 );
            case 'HKD' : return number_format_i18n( $price, 2 ) . ' $';
            case 'HUF' : return number_format_i18n( $price, 2 ) . ' Ft';
            case 'IDR' : return number_format_i18n( $price, 2 ) . ' Rp';
            case 'INR' : return number_format_i18n( $price, 2 ) . ' ₹';
            case 'ILS' : return number_format_i18n( $price, 2 ) . ' ₪';
            case 'JPY' : return '¥' . number_format_i18n( $price, 2 );
            case 'KRW' : return number_format_i18n( $price, 2 ) . ' ₩';
            case 'KZT' : return number_format_i18n( $price, 2 ) . ' тг.';
            case 'MXN' : return number_format_i18n( $price, 2 ) . ' $';
            case 'MYR' : return number_format_i18n( $price, 2 ) . ' RM';
            case 'NOK' : return number_format_i18n( $price, 2 ) . ' kr';
            case 'NZD' : return number_format_i18n( $price, 2 ) . ' $';
            case 'PHP' : return number_format_i18n( $price, 2 ) . ' ₱';
            case 'PLN' : return number_format_i18n( $price, 2 ) . ' zł';
            case 'RON' : return number_format_i18n( $price, 2 ) . ' lei';
            case 'RMB' : return number_format_i18n( $price, 2 ) . ' ¥';
            case 'RUB' : return number_format_i18n( $price, 2 ) . ' руб.';
            case 'SAR' : return number_format_i18n( $price, 2 ) . ' SAR';
            case 'SEK' : return number_format_i18n( $price, 2 ) . ' kr';
            case 'SGD' : return number_format_i18n( $price, 2 ) . ' $';
            case 'THB' : return number_format_i18n( $price, 2 ) . ' ฿';
            case 'TRY' : return number_format_i18n( $price, 2 ) . ' TL';
            case 'TWD' : return number_format_i18n( $price, 2 ) . ' NT$';
            case 'UGX' : return 'UGX ' . number_format_i18n( $price );
            case 'USD' : return '$' . number_format_i18n( $price, 2 );
            case 'ZAR' : return 'R ' . number_format_i18n( $price, 2 );
        }

        return number_format_i18n( $price, 2 );
    }

    /**
     * @return string
     */
    public static function getCurrentPageURL() {
        return ($_SERVER['REQUEST_SCHEME'] ? $_SERVER['REQUEST_SCHEME'] : 'http') . "://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    /**
     * @return mixed|string|void
     */
    public static function getTimezoneString() {
        // if site timezone string exists, return it
        if ( $timezone = get_option( 'timezone_string' ) ) {
            return $timezone;
        }

        // get UTC offset, if it isn't set then return UTC
        if ( 0 === ( $utc_offset = get_option( 'gmt_offset', 0 ) ) ) {
            return 'UTC';
        }

        // adjust UTC offset from hours to seconds
        $utc_offset *= 3600;

        // attempt to guess the timezone string from the UTC offset
        if ( $timezone = timezone_name_from_abbr( '', $utc_offset, 0 ) ) {
            return $timezone;
        }

        // last try, guess timezone string manually
        $is_dst = date( 'I' );

        foreach ( timezone_abbreviations_list() as $abbr ) {
            foreach ( $abbr as $city ) {
                if ( $city['dst'] == $is_dst && $city['offset'] == $utc_offset )
                    return $city['timezone_id'];
            }
        }

        // fallback to UTC
        return 'UTC';
    }

} // AB_CommonUtils