<?php


use Illuminate\Support\Str;

if (!function_exists('get_uri')) {
    /**
     * Determine the requested url path name
     *
     * @return string
     */
    function get_uri() {
        return urldecode(
            parse_url($_SERVER['REQUEST_URI'] ?? null, PHP_URL_PATH)
        );
    }
}

if (!function_exists('test_uri')) {
    function test_uri() {
        $uri = get_uri();
        //return (substr($uri, 0, 7) === '/public' Or strtolower(substr($_SERVER['SERVER_SOFTWARE'], 0, 5)) == 'nginx');
        return (strpos($uri, 'public') Or strtolower(substr($_SERVER['SERVER_SOFTWARE'] ?? null, 0, 5)) == 'nginx');


    }
}

if (!function_exists('asset_url')) {

    /**
     * Return the assets folder url of this application
     *
     * @return string
     */
    function asset_url() {
        if (test_uri()) {
            return url("/") . '/assets';
        } else {
            return url("/") . '/public/assets';
        }
    }

}

if (!function_exists('public_url')) {

    /**
     * Return the public url of the application
     *
     * @return type string
     */
    function public_url() {
        return url("/");
    }

}

if (! function_exists('includeRouteFiles')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}


if (!function_exists('getFallbackLocale')) {

    /**
     * Get the fallback locale
     *
     * @return \Illuminate\Foundation\Application|mixed
     */
    function getFallbackLocale() {
        return config('app.fallback_locale');
    }

}

if (!function_exists('getLanguageBlock')) {

    /**
     * Get the language block with a fallback
     *
     * @param $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getLanguageBlock($view, $data = []) {
        $components = explode("lang", $view);
        $current = $components[0] . "lang." . app()->getLocale() . "." . $components[1];
        $fallback = $components[0] . "lang." . getFallbackLocale() . "." . $components[1];

        if (view()->exists($current)) {
            return view($current, $data);
        } else {
            return view($fallback, $data);
        }
    }

}


if (! function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function access()
    {
        return app('access');
    }
}

if (! function_exists('sysdef')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function sysdef()
    {
        return app('sysdef');
    }
}

if (! function_exists('code_value')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function code_value()
    {
        return app('code_value');
    }
}


if (! function_exists('sec_env')) {
    function sec_env($name, $fallback = '') {
        $env = require __DIR__. './../../config/env.php';
        $crypt  = new \Illuminate\Encryption\Encrypter($env["key"]);
        if (isset($_SERVER[$name])) {
            $password = $crypt->decrypt($_SERVER[$name]);
        } else {
            $password = $fallback;
        }
        return $password;
    }
}


/*
 * truncate to n characters of string
 */
if(! function_exists('truncateString')) {
    function truncateString($string, $stringLimit = 300){
        return str_limit($string, $stringLimit, $end = "...");
    }
}

/*
 * Generate random string with n number of characters, 3 is default, for reference [code_values]
 */
if(! function_exists('randomString')) {
    function randomString($chars = 3)
    {
        return strtoupper(Str::random($chars));
    }
}


/* Number format with 2 decimal places with thousands separator 10,000.00*/

if (! function_exists('number_2_format')) {
    function number_2_format($value)
    {
        return  number_format( $value , 2, '.' , ',' );
    }
}

if (! function_exists('number_2_format_check_null')) {
    function number_2_format_check_null($value)
    {

        if(($value)){
            return  number_format( $value , 2, '.' , ',' );
        }else{
            return null;
        }

    }
}


/* Number format with no decimal places with thousands separator 10,000 */

if (! function_exists('number_0_format')) {
    function number_0_format($value)
    {
        return  number_format( $value , 0, '.' , ',' );
    }
}

/*short date format D-M-Y*/
if (! function_exists('short_date_format')) {
    function short_date_format($date)
    {
        if($date){
            return \Carbon\Carbon::parse($date)->format('d-M-Y');
        }else{
            return '';
        }

    }
}


if (! function_exists('short_date_format_with_day')) {
    function short_date_format_with_day($date)
    {
        if($date){
            return \Carbon\Carbon::parse($date)->format('d-M-Y l');
        }else{
            return '';
        }

    }
}

/*Month Year date format D-M-Y*/
if (! function_exists('month_year_date_format')) {
    function month_year_date_format($date)
    {
        if($date){
            return \Carbon\Carbon::parse($date)->format('M-Y');
        }else{
            return '';
        }
    }
}

/*day month date format*/
if (! function_exists('day_month_date_format')) {
    function day_month_date_format($date)
    {
        if($date){
            return \Carbon\Carbon::parse($date)->format('d-M');
        }else{
            return '';
        }
    }
}

/*Day Month format D-M-Y*/
if (! function_exists('day_month_date_format')) {
    function day_month_date_format($date)
    {
        if($date){
            return \Carbon\Carbon::parse($date)->format('j-M');
        }else{
            return '';
        }
    }
}


/*Standard format date format Y-m-j for storing in the database*/
if (! function_exists('standard_date_format')) {
    function standard_date_format($date)
    {
        if($date){
            return \Carbon\Carbon::parse($date)->format('Y-n-j');
        }else{
            return '';
        }
    }
}


if (! function_exists('old_datepicker_format')) {
    function old_datepicker_format($date)
    {
        if($date){
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        }else{
            return '';
        }
    }
}

/*comparable date format D-M-Y*/
if (! function_exists('comparable_date_format')) {
    function comparable_date_format($date)
    {
        $standard_format = standard_date_format($date);
        return strtotime($standard_format);
    }
}

/*comparable date format D-M-Y*/
if (! function_exists('comparable_date_format_timezone')) {
    function comparable_date_format_timezone($date)
    {
        return strtotime($date);
    }
}


/*Today's date*/
if (! function_exists('getTodayDate')) {

    function getTodayDate()
    {
        return \Carbon\Carbon::now()->format('Y-n-j');

    }
}

/*System Launch date*/
if (! function_exists('getLaunchDate')) {
    function getLaunchDate()
    {
        $launch_date = organization()->start_date ??  '2021-01-01';
        return \Carbon\Carbon::parse($launch_date)->format('Y-n-j');
    }
}


/*convert int to date format long*/
if (! function_exists('convert_int_to_datetime')) {
    function convert_int_to_datetime($timestamp)
    {
        return idate('j', $timestamp) . '-' . idate('m', $timestamp) . '-' . idate('Y', $timestamp) . ' ' . idate('H', $timestamp) . ':' . idate('i', $timestamp) . ':' . idate('s', $timestamp);
    }
}


/*add - after 3 characters, for TIN*/
if (! function_exists('chunk_hyphen')) {
    function chunk_hyphen($string){
        return implode("-", str_split($string, 3));
    }
}

/*capture the first word after dot (.)*/
if (! function_exists('capture_first')) {
    function capture_first($string){
        $arr = explode(".", $string, 2);
        return $first = $arr[0];
    }
}


if (! function_exists('phone_255')) {
    function phone_255($phone)
    {
        return \Propaganistas\LaravelPhone\PhoneNumber::make($phone, 'TZ')->formatE164();
    }
}

if (! function_exists('phone_make')) {
    function phone_make($phone, $country_code)
    {
        return \Propaganistas\LaravelPhone\PhoneNumber::make($phone, $country_code)->formatE164();
    }
}


function renderVariable($text) {
    return preg_replace_callback('/@\(\"([^"]+)\"\)/', function($matches) {
        return $matches[1];
    }, $text);
}

function renderDescription($text) {
    //Evaluate all trans functions as PHP
    //We don't want to use eval() for security reasons so we're explicitly converting trans cases
    return preg_replace_callback('/trans\(\"([^"]+)\"\)/', function($matches) {
        return trans($matches[1]);
    }, $text);
}

/**
 * Exception $e
 */
if (! function_exists('log_error')) {
    function log_error(Exception $e)
    {
        \Illuminate\Support\Facades\Log::error('[' . $e->getCode() . '] ' . $e->getMessage() . ' on line ' . @$e->getTrace()[0]['line'] . ' of file ' . @$e->getTrace()[0]['file']);
    }
}



if (! function_exists('unix_to_excel_date')) {
    function unix_to_excel_date($unix_date)
    {
        $excel_date = 25569 + ($unix_date / 86400);
        return $excel_date;
    }
}




if (! function_exists('remove_thousands_separator')) {
    function remove_thousands_separator($value)
    {
        $value = str_replace(",", "",   $value);
        return $value;

    }
}

if (! function_exists("single_space")) {
    function single_space($input) {
        $input = preg_replace('!\s+!', ' ', trim($input));
        return $input;
    }
}


if (! function_exists("remove_all_white_spaces")) {
    function remove_all_white_spaces($value) {
        $value =  preg_replace('/\s+/', '', $value );
        return $value;
    }
}


if (! function_exists("remove_extra_white_spaces")) {
    function remove_extra_white_spaces($value) {
        $value =  preg_replace('/\s+/', ' ', $value );
        return $value;
    }
}

if (! function_exists('checksum')) {
    /**
     * @author Mathayo Mihayo
     * upgraded by Erick Chrysostom (To restrict the checksum repeated sequence)
     * Add a checksum and padding for a given ID
     * @param $id
     * @param $pad_length
     * @return string
     */
    function checksum($id, $pad_length)
    {
        $number = $id;
        $list = "542316798";
        $sum = 0;
        do {
            $sum += $number % 10;
        }
        while ($number = (int) $number / 10);
        $check = $sum % 10;
        $check = $check + 3;
        $check = $check % 10;
        if($check == 0)
        {
            //$check = 1;
        }
        if ($id % 2 == 0) {
            /* It is even */
            if($check == 0)
            {
                $check = 7;
            }
            $check = substr($list, $check - 1, 1);
        } else {
            /* It is odd */
            if($check == 0)
            {
                $check = -2;
            }
            $check = substr($list, $check * -1, 1);
        }
        $padding = str_pad($id, $pad_length, '00', STR_PAD_LEFT);
        return $check.$padding;
    }
}




if (! function_exists('months_diff')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function months_diff($from_date, $end_date)
    {
        /*end parts*/
        $end_day = \Carbon\Carbon::parse($end_date)->format('d');
        $end_month = \Carbon\Carbon::parse($end_date)->format('m');
        $end_year = \Carbon\Carbon::parse($end_date)->format('Y');
        /*from parts*/
        $from_day = \Carbon\Carbon::parse($from_date)->format('d');
        $from_month = \Carbon\Carbon::parse($from_date)->format('m');
        $from_year = \Carbon\Carbon::parse($from_date)->format('Y');

        $diff_months = 0;
        if ($end_year == $from_year ){
            $diff_months = $end_month - $from_month;
        };

        if ($end_year <> $from_year ){
            $diff_year = $end_year - $from_year;
            $get_months = $diff_year * 12;
            $end_month  = $end_month + $get_months;
            $diff_months = $end_month - $from_month;
        };
        return $diff_months;

    }

}



if (!function_exists('explode_parameter')) {
    /**
     * Return an array of the inputs string parameter
     * separated by commas e.g 1,2,3,4
     *
     * @param $parameter
     * @return array
     */
    function explode_parameter($parameter) {
        if (! isset($parameter)) {
            $output = [];
        } else {
            $output = explode(",", $parameter);
        }
        return $output;
    }

}


if (!function_exists('implode_collection_name')) {
    /**
     * Return an strings separated by commas
     * separated by commas e.g Dsm, Morogoro, Arusha
     *
     * @param $parameter
     * @return array
     */
    function implode_collection_name($collection, $column_name = 'name') {
        $output = [];
        foreach ($collection as $parameter) {
            array_push($output, $parameter->$column_name);
        }
        return implode(", ", $output);
    }

}


/*Base doc directory used for attaching document*/
if (!function_exists('base_doc_dir')) {

    function base_doc_dir() {
        return public_path() . '/storage';
    }

}

/*Base doc path for review attached file*/
if (!function_exists('base_doc_path')) {

    function base_doc_path() {
        /**
         *
         */
        if (test_uri()) {
            return asset('/storage');
        } else {
//            return asset('/public/storage');
            return asset('/storage');
        }
    }

}


/*Mb to kb*/
if (!function_exists('mb_to_kb')) {
    function mb_to_kb() {
        return  1024;
    }
}

/*General maximum file size upload i.e. max_size in MB*/
if (!function_exists('max_file_size_upload_kb')) {
    function max_file_size_upload_kb($max_size = 1) {
        return  mb_to_kb() * $max_size;
    }
}


/*General maximum file size upload i.e. max_size in MB*/
if (!function_exists('max_file_size')) {
    function max_file_size($max_size = 1) {
        return  $max_size;
    }
}


if (!function_exists('proper_case_word')) {
    function proper_case_word($string) {
        $string = strtolower(remove_extra_white_spaces($string));
        return  ucwords($string);
    }
}




/*display client type*/
//if (!function_exists('client_type')){
//    function client_type($iscompany){
//        switch ($iscompany){
//            case 1;
//            return '<span class="badge badge-info">Company</span>';
//            break;
//            case 0;
//                return '<span class="badge badge-info">Individual</span>';
//                break;
//
//            default:
//
//                break;
//
//        }
//    }
//}


if (! function_exists('short_name_month_from_int')) {
    function short_name_month_from_int()
    {
        return [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec',
        ];
    }
}


/*Set Side Bar Active link*/
if (!function_exists('setSideBarActive')) {
    function setSideBarActive($path)
    {
        return Request::is($path . '*') ? ' class=nav-expanded nav-active nav-collapsed' :  '';
    }
}

if (!function_exists('setSideBarActiveUrl')) {
    function setSideBarActiveUrl($path)
    {
        return (url($path) == URL::current()) ? ' class="nav-expanded nav-active""' :  '';
    }
}


if (!function_exists('setSideBarActiveUrlMultiple')) {
    function setSideBarActiveUrlMultiple(array $path_array)
    {
        foreach($path_array as $key => $path)
        {
            if(url($path) == URL::current()){
                return (url($path) == URL::current()) ? ' class="nav-expanded nav-active""' :  '';
            }

        }

    }
}


//if (!function_exists('setSideBarDashboardActiveUrl')) {
//    function setSideBarDashboardActiveUrl()
//    {
//        $current_url = URL::current();
//
//        switch(($current_url) )
//        {
//            case url('dashboard/station/analytics'):
//            case url('dashboard/executive/analytics'):
//            case url('dashboard/station/daily_analytics'):
//
//                return  ' nav-expanded nav-active"';
//                break;
//
//            default:
//                return '';
//                break;
//
//        }
//
//    }
//}


if (!function_exists('setSideBarChildActiveUrl')) {
    function setSideBarChildActiveUrl($parent_menu)
    {
        $current_url = URL::current();

        switch(($parent_menu) )
        {

            case 'dashboard':

                if($current_url == url('dashboard/station/analytic') || $current_url == url('dashboard/executive/analytics') || $current_url == url('dashboard/station/daily_analytics')) {

                    return  ' nav-expanded nav-active"';
                }
                break;

            case 'hr':

                if($current_url == url('hr/payroll/menu') || $current_url == url('hr/employee/menu') || $current_url == url('hr/staff_leave/index')  )
                {
                    return  ' nav-expanded nav-active"';
                }
                break;


            case 'taxes':

                if($current_url == url('hr/payroll/menu') )
                {
                    return  ' nav-expanded nav-active"';
                }
                break;


            case 'expense':

                if($current_url == url('operation/expense/index') || $current_url == url('operation/expense/calendar') || $current_url == url('operation/supplier/index') )
                {
                    return  ' nav-expanded nav-active"';
                }
                break;

            case 'sale':

                if(strpos($current_url, 'operation/sales/index') || strpos($current_url, 'operation/sales/pos/index') || $current_url == url('operation/sales/calendar')|| $current_url == url('operation/client/index'))
                {
                    return  ' nav-expanded nav-active"';
                }
                break;


            case 'offering':

                if(strpos($current_url, 'operation/stock/offering/index') || $current_url == url('operation/stock/offering/offering_index'))
                {
                    return  ' nav-expanded nav-active"';
                }
                break;

            case 'tax':

                if($current_url == url('operation/tax/index'))
                {
                    return  ' nav-expanded nav-active"';
                }
                break;

            case 'project':

                if($current_url == url('operation/project/index'))
                {
                    return  ' nav-expanded nav-active"';
                }
                break;

            case 'banking':

                if($current_url == url('accounting/banking/overview') || $current_url == url('admin/bank/index'))
                {
                    return  ' nav-expanded nav-active"';
                }
                break;
            default:
                return '';
                break;

        }

    }
}



/*Small helper to put description or instruction on form inputs*/
if (!function_exists('small_helper')) {
    function small_helper($helper, $color = 'grey', $tooltip = '')
    {
        return '<small   style="color:' . $color . ';">' . $helper . '</small>';
    }
}


/*Max file size helper */
if (!function_exists('max_file_size_helper')) {
    function max_file_size_helper($max_size = null)
    {
        $max_size = ($max_size) ? $max_size : 2;
        return '<small style="color:grey;">' . __('label.max_file_size_helper') . ' : ' . ($max_size . 'MB'). '</small>';
    }
}



/*Allow to edit object */
if (!function_exists('allow_to_edit_object')) {
    function allow_to_edit_object($created_at)
    {
        $created_at_parsed = \Carbon\Carbon::parse($created_at);
        $max_days = sysdef()->data('THMELIM');
        $today = getTodayDate();
        $last_date_to_edit = $created_at_parsed->addDays($max_days);
        if(comparable_date_format($last_date_to_edit) >= comparable_date_format($today)){
            return true;
        }else{
            return false;
        }
    }
}

if (!function_exists('allow_to_edit_general')) {
    function allow_to_edit_general($target_date, $cut_off_date)
    {

        if(comparable_date_format($target_date) <= comparable_date_format($cut_off_date)){
            return true;
        }else{
            return false;
        }
    }
}




if (!function_exists('accounting_number_format')) {
    function accounting_number_format($number)
    {
        if($number < 0)
        {
            $number = number_2_format((-1 * $number));
            return '(' . $number . ')';
        }else{
            return number_2_format($number);
        }
    }
}


if (!function_exists('company_logo_base64')) {
    function company_logo_base64()
    {

        return (sysdef()->data('DATSYTELOG')) ? sysdef()->data('DATSYTELOG') : code_value()->companyLogo();


    }
}

if (!function_exists('company_logo_url')) {
    function company_logo_url()
    {

        return sysdef()->getDocFullPathUrl('DATSYTELOG');


    }
}

if (!function_exists('company_stamp_url')) {
    function company_stamp_url()
    {

        return sysdef()->getDocFullPathUrl('DATSYTSTMP');


    }
}


if (!function_exists('company_header_base64')) {
    function company_header_base64()
    {
        return code_value()->companyHeader();
    }
}

if (!function_exists('company_header_url')) {
    function company_header_url()
    {
        return sysdef()->getDocFullPathUrl('DATSYCHD64');
    }
}



if (!function_exists('company_footer_base64')) {
    function company_footer_base64()
    {
        return code_value()->companyFooter();
    }
}



if (!function_exists('company_footer_url')) {
    function company_footer_url()
    {
        return sysdef()->getDocFullPathUrl('DATSYCFT64');
    }
}

if (!function_exists('company_watermark_base64')) {
    function company_watermark_base64()
    {
        return code_value()->companyWatermark();
    }
}


if (!function_exists('company_watermark_url')) {
    function company_watermark_url()
    {
        return sysdef()->getDocFullPathUrl('DATSYCWT64');
    }
}


if (!function_exists('system_logo_base64')) {
    function system_logo_base64()
    {

        return code_value()->systemLogo();
    }
}

if (!function_exists('leading_zero')) {
    function leading_zero($string, $pad_length)
    {

        return str_pad($string,$pad_length,"0", STR_PAD_LEFT);

    }
}

/*Today's date*/
if (! function_exists('boolean_label')) {

    function boolean_label($val)
    {
        return ($val == 1) ? __('label.yes') : __('label.no');

    }
}

if (! function_exists('boolean_badge')) {

    function boolean_badge($val)
    {
        return ($val == 1) ?  "<span class='badge badge-pill badge-success'>" .  trans('label.yes') .  "</span>" : "<span class='badge badge-pill badge-warning'>" .  trans('label.no') .  "</span>";

    }
}


if (! function_exists('badge_label')) {

    function badge_label($label, $color = 'success')
    {
        $color = 'badge-' . $color;
        return "<span class='badge badge-pill " . $color. "'>" .  $label .  "</span>";

    }
}


if (! function_exists('colored_label')) {

    function colored_label($label, $color = 'green')
    {

        return "<label style='" .'color:'. $color. "' >" .  $label .  "</label>";

    }
}


/*Optional Required Request*/
if (! function_exists('optionalRequiredRequest')) {

    function optionalRequiredRequest($key, $input)
    {
        if(array_key_exists($key, $input)) {
            $array = [
                $key => 'required'
            ];
        }else{
            $array = [];
        }
        return $array;

    }
}



/*Remove last this char*/
if (!function_exists('remove_last_this_char')) {
    function remove_last_this_char($string, $char) {
        $last_char = substr($string, -1, 1);
        if($last_char == $char){
            $string = substr($string, 0, -1);
        }
        return $string;
    }
}


/*Remove first this char*/
if (!function_exists('remove_first_this_char')) {
    function remove_first_this_char($string, $char) {
        $first_char = substr($string, 0, 1);
        if($first_char == $char){
            $string = substr($string, 1);
        }
        return $string;
    }
}

/*get chars from the last of word*/
if (!function_exists('get_char_from_last')) {
    function get_char_from_last($string, $no_of_char) {
        $char_from_last = substr($string, (-1 * $no_of_char), $no_of_char);
        return $char_from_last;
    }
}


/*get chars from the first of the word*/
if (!function_exists('get_char_from_first')) {
    function get_char_from_first($string, $no_of_char) {
        $char_from_first = substr($string, 0, $no_of_char);
        return $char_from_first;
    }
}

/*Get string after last occurence of this char*/
if (!function_exists('get_string_after_last_char')) {
    function get_string_after_last_char($string, $char) {

        return substr(strrchr($string, $char), 1);
    }
}

/*Get rand alphabetic and number*/
if (!function_exists('get_rand_letter_number')) {
    function get_rand_letter_number($length, $characters = null) {
        $characters = ($characters) ? $characters : '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}

/*Get OTP*/
if (!function_exists('get_otp')) {
    function get_otp($length) {
        $characters ='123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand_5 = get_rand_letter_number(5, $characters);
        return $rand_5;
    }
}

if (!function_exists('get_table_columns_for_select')) {
    function get_table_columns_for_select($table_name, $exclude_cols =[]) {
        $col_arr = [];
        $cols =  \Illuminate\Support\Facades\DB::getSchemaBuilder()->getColumnListing($table_name);

        foreach ($cols as $col){

            if(!in_array($col, $exclude_cols)){
                $arr = [ $col => $col];
                $col_arr = array_merge($arr, $col_arr);
            }

        }
        return $col_arr;
    }
}

if (!function_exists('get_table_columns_array')) {
    function get_table_columns_array($table_name) {
        $col_arr = [];
        $cols =  \Illuminate\Support\Facades\DB::getSchemaBuilder()->getColumnListing($table_name);
        return $cols;
    }
}


if (!function_exists('get_without_data_col_sql')) {
    function get_without_data_col_sql($table_name, $col_name) {
        $col = "pg_typeof(" . $col_name. ") as data_type";
        $data = \Illuminate\Support\Facades\DB::table($table_name)->select(
            \Illuminate\Support\Facades\DB::raw($col)
        )->limit(1)->first();

        $data_type = $data->data_type;

        switch ($data_type){
            case 'numeric':
            case 'integer':
            case 'biginteger':
            case 'smallinteger':
            case 'float':
            case 'decimal':

                $sql =  0.00  . ' = coalesce(' .$col_name. ','. 0.00 . ')';
                break;

            case 'date':
            case 'datetime':
                $sql =  ' \'2020-01-01\'' . ' = coalesce(' .$col_name. ','. '\'2020-01-01\'' . ')';
                break;

            default:
                $sql =  'coalesce(' .$col_name. ','. 'null' . ')' . 'is null';
                break;
        }


        return $sql;
    }
}

if (!function_exists('check_if_is_non_number_column')) {
    function check_if_is_non_number_column($column_name) {
        $column_name = remove_extra_white_spaces($column_name);
        $column_name = remove_first_this_char($column_name, ' ');
        $column_name = remove_last_this_char($column_name, ' ');
        $column_name = strtolower($column_name);
        $non_number_headers =[ 'tin', 'employee\'s tin', 'social security number','social_fund_no', 'nssf no.', 'nssf number','nssf','national','national_id','wcf_no', 'wcf no', 'accountno', 'bank accountno', 'bank account no.', 'ref no.', 'phone'];
        $check = in_array($column_name, $non_number_headers);

//        dd($check);
        if($check == true)
        {
            return true;
        }else{
            return false;
        }
    }
}



if (!function_exists('log_info')) {
    function log_info($output) {
        \Illuminate\Support\Facades\Log::info(print_r($output,true));

    }
}



if (!function_exists('ahref_link')) {
    function ahref_link($route_url, $label, $color = 'blue;', $class = '', $id ='', $icon = null, $target='_self') {



        if($icon){
            /*with icon*/
            $label =  '<i  title="'. $label . '"  class="' . $icon . '" >' . '' . '</i>';
        }else{
            /*Without icon*/
            $label = $label;
        }

        $ahref = '<a style="'.'color:'. $color.'"  id="' . $id . '" class="' . $class. '" target="' . $target. '" href="'. $route_url. '">' . $label . ' </a>';
        return $ahref;

    }
}



if (!function_exists('alert_label')) {
    function alert_label($label, $image_url = 'img/alert.gif') {

        $alert = '<img  data-toggle="tooltip" data-placement="top" title="'  . $label .' " style="width: 20px;height: 20px;" class="img-fluid" src="'. url($image_url) .  '">';
        return $alert;

    }
}



if (!function_exists('check_in_negative_positive_range')) {
    function check_in_negative_positive_range($value, $comparable_value) {

        $min = -1 * $comparable_value;
        $max = $comparable_value;
        if($value >= $min && $value <= $max){
            return true;
        }else{
            return false;
        }


    }
}


if (!function_exists('document_url')){
    function documentUrl($doc_id){
        return (new \App\Repositories\System\DocumentResourceRepository())->getDocFullPathUrl($doc_id);

    }
}



if (!function_exists('integerToRoman')){
    function integerToRoman($integer){

        // Convert the integer into an integer (just to make sure)
        $integer = intval($integer);
        $result = '';

        // Create a lookup array that contains all of the Roman numerals.
        $lookup = array('M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1);

        foreach($lookup as $roman => $value){
            // Determine the number of matches
            $matches = intval($integer/$value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman,$matches);

            // Set the integer to be the remainder of the integer and the value
            $integer = $integer % $value;
        }

        // The Roman numeral should be built, return it
        return $result;
    }


}

//Array merge sum
if (!function_exists('array_merge_sum')){
    function array_merge_sum($array1, $array2){
        $sums = [];
//        dd(array_keys($array1 + $array2));
        foreach (array_keys($array1 + $array2) as $array_key) {

            $sums[$array_key]=  (array_key_exists($array_key, $array1) ? $array1[$array_key] : 0) + (array_key_exists($array_key, $array2)  ? $array2[$array_key] : 0);
        }

        return $sums;

    }
}


//Array merge sum
if (!function_exists('station_non_posted_days_alert')){
    function station_non_posted_days_alert(){
        return sysdef()->data('THRSSTSHDA');
    }
}

/**
 * Autoselect first option if there is only one option
 */
if (!function_exists('autoselect_first_option')){
    function autoselect_first_option($select_options){
        return(count($select_options) == 1) ? array_keys($select_options->toArray())[0] : null;
    }
}


/**
 * Due days alert
 */
if (!function_exists('due_days_alert')){
    function due_days_alert($target_date, $limit_date, $with_badge = 0, $only_overdue = 0){

        $target_date = \Carbon\Carbon::parse($target_date);
        $limit_date = \Carbon\Carbon::parse($limit_date);
        $days_diff  = $limit_date->diffInDays($target_date);
        $days_left = (comparable_date_format($target_date) >= comparable_date_format($limit_date)) ? $days_diff : (-1 * $days_diff);
        $days_left_label = ($days_left >= 0) ? ($days_left . ' ' . __('label.days_left')) : (__('label.overdue_by_days', ['days' => (-1 * $days_left)]));
        if($with_badge){

            $color = $days_left >= 0 ? 'success' : 'warning';
            $days_left_badge = badge_label($days_left_label, $color);
        }

        if($only_overdue == 1){
            $days_left_badge = $days_left < 0 ? $days_left_badge : null;
            $days_left_label =$days_left < 0 ? $days_left_label : null;
        }

        return ['days_left' => $days_left, 'days_left_label' =>$days_left_label ,'days_left_badge' => $days_left_badge ?? null];
    }
}

/**
 * General check if date locked
 */
if (!function_exists('check_if_date_locked')){
    function check_if_date_locked($target_date, $lock_date){
        if(comparable_date_format($target_date) < comparable_date_format($lock_date)){
            return true;
        }else{
            return false;
        }
    }
}



/**
 * Check if accounting transaction date locked
 */
if (!function_exists('check_if_transaction_date_locked')){
    function check_if_transaction_date_locked($target_date){
        $return = false;
        if(sysdef()->data('ACCNCLODAT')){

            if(check_if_date_locked($target_date, sysdef()->data('ACCNCLODAT'))){
                $return = true;
            }
        }

        return $return;
    }
}

/**
 * Check if accounting transaction date locked
 */
if (!function_exists('check_with_exception_transaction_date_locked')) {
    function check_with_exception_transaction_date_locked($target_date)
    {
        if (check_if_transaction_date_locked($target_date)) {
            throw new \App\Exceptions\GeneralException(__('exceptions.accounting.transaction_date_is_locked', ['transaction_close_date' => short_date_format(sysdef()->data('ACCNCLODAT'))]));
        }

    }
}


/*Check if date valid from uploaded excel*/
if (!function_exists('check_date_valid_upload_excel')) {
    function check_date_valid_upload_excel($target_date)
    {
        $default_excel_date = '1970-01-01';
        $return = true;
        /*check if insert default - 1970-01-01*/
        if (comparable_date_format($target_date) == comparable_date_format($default_excel_date)) {
            $return = false;
        }
        return $return;
    }
}


/**
 * Check if ckeditor is filled or return null
 */
if (!function_exists('ckeditor_data_format')) {
    function ckeditor_data_format($value)
    {
        return ((strip_tags(preg_replace('/\s+/', '', str_replace('&nbsp;',"", $value)))) ? $value : null);
    }
}


/**
 * Check if station_page_header
 */
if (!function_exists('station_page_header')) {
    function station_page_header()
    {
        return ((access()->allow('manage_all_stations')) ? '' : (': ' .access()->user()->station_in_use->name));
    }
}
if (!function_exists('station_in_use_id')) {
    function station_in_use_id()
    {
        return access()->user()->station_in_use->id ?? null;
    }
}


if (!function_exists('main_station_id')) {
    function main_station_id()
    {
        return access()->user()->mainStation->id ?? null;
    }
}


if (!function_exists('station_hq_id')) {
    function station_hq_id()
    {
        $hq =  \App\Models\Operation\Station\Station::query()->where('ishq',1)->first();
        return $hq->id ?? null;
    }
}


if (!function_exists('stations_for_select')) {
    function stations_for_select()
    {
        $stations_for_select =  \App\Models\Operation\Station\Station::query()->orderBy('name')->pluck('name', 'id');
        return $stations_for_select;
    }
}


if (!function_exists('organization')) {
    function organization()
    {
        return code_value()->getOrganization();
    }
}



if (!function_exists('country')) {
    function country()
    {
        $organization = code_value()->getOrganization();
        return $organization->country ?? null;
    }
}

if (!function_exists('country_code')) {
    function country_code()
    {
        $country = country();
        return $country->code ?? 'TZ';
    }
}


if (!function_exists('check_is_admin')) {
    function checkIsAdmin($user)
    {
        $check = $user->roles()->where('roles.id',1)->count();

        if ($check > 0)
        {
            return true;
        }

        return false;
    }
}


if (!function_exists('check_roles')) {
    function check_roles($roles)
    {
        $check = access()->user()->roles()->whereIn('name',$roles)->get();
        return $check->count();
    }
}

