<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use DB;
use Hash;

/**
 *
 */
class Auth_Controller extends Controller
{

    /**
     * @func      func_name
     * @desc      description
     * @param     [type]         $arrRequest    [description]
     * @return    [type]                        [description]
     */
    public static function handleLogin($arrRequest)
    {
        $blnLoginAttempt = Auth::attempt([
            'email'    => $arrRequest['email'],
            'password' => $arrRequest['password'],
            'flag'     => 1,
        ]);

        if ($blnLoginAttempt) {
            return false;
        }

        return array(
            'message' => 'Your login information was incorrect. Please try again! <a  data-toggle="modal" data-target="#forgotModal">Click here</a> to reset your password.',
            'status'  => 'danger',
            'heading' => 'Opps!',
        );
    }

    /**
     * @func      func_name
     * @desc      description
     * @param     [type]         $arrRequest    [description]
     * @return    [type]                        [description]
     */
    public static function handleRegister($arrRequest)
    {
        // Check if Email Exists:
        if (Self::checkEmail($arrRequest)) {
            return array(
                'message' => 'We were unable to register your account. It seems that your email, ' . $arrRequest['email'] . ', is already in use.',
                'status'  => 'danger',
                'heading' => 'Opps!',
            );
        }

        $strToken = Self::generateToken();
        $arrParts = explode("@", $arrRequest['email']);

        $blnRegAttempt = User::create([
            'email'    => $arrRequest['email'],
            'name'     => $arrParts[0],
            'password' => Hash::make($strToken),
            'role'     => 'user',
            'flag'     => 1,
        ]);

        //co95C9OTmJ7URhc

        if ($blnRegAttempt && Self::sendRegEmail($arrRequest['email'], $strToken)) {
            $strMessage = 'Thank you for registering. You will recieve an email at ' . $arrRequest['email'] . ' sortly with your login information.';
            $strStatus  = 'success';
            $strHeading = 'Success!';

        } else {
            $strMessage = 'We were unable to register around account. Please try again.';
            $strStatus  = 'danger';
            $strHeading = 'Opps!';
        }

        return array(
            'message' => $strMessage,
            'status'  => $strStatus,
            'heading' => $strHeading,
        );
    }

    /**
     * @func      func_name
     * @desc      description
     * @param     [type]         $arrRequest    [description]
     * @return    [type]                        [description]
     */
    public static function checkEmail($arrRequest)
    {
        $objUser = DB::table('users')->where('email', $arrRequest['email'])->get();

        if (empty($objUser)) {return false;}

        return true;
    }

    /**
     * @func      func_name
     * @desc      description
     * @return    [type]         [description]
     */
    public static function generateToken()
    {

        $arrPassword = array();
        $strAlpha    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

        for ($intN = 0; $intN < 15; $intN++) {
            $arrPassword[] = $strAlpha[rand(0, (strlen($strAlpha) - 1))];
        }

        return implode($arrPassword);
    }

    /**
     * @func      func_name
     * @desc      description
     * @param     [type]         $strEmail    [description]
     * @param     [type]         $strToken    [description]
     * @return    [type]                      [description]
     */
    public static function sendRegEmail($strEmail, $strToken)
    {

        // send email:
        $mailHeader = 'MIME-Version: 1.0' . "\r\n";
        $mailHeader .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $mailHeader .= 'From: Admin <admin@sthenos.net>' . "\r\n";

        $mailTo      = $strEmail;
        $mailSubject = "Show and Tell Registration";
        $mailBody    = "Thank you for registering to URL. Your login information is as follows: <p><ul>";
        $mailBody   .= "<li>" . $strEmail . "</li>";
        $mailBody   .= "<li>" . $strToken . "</li>";
        $mailBody   .= "</ul>";

        if(mail($mailTo, $mailSubject, $mailBody, $mailHeader)) {

            return true;
        }

        return false;
    }

    /**
     * @func      func_name
     * @desc      description
     * @param     [type]         $strEmail    [description]
     * @param     [type]         $strToken    [description]
     * @return    [type]                      [description]
     */
    public static function sendResetEmail($strEmail, $strToken)
    {

        // send email:
        $mailHeader = 'MIME-Version: 1.0' . "\r\n";
        $mailHeader .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $mailHeader .= 'From: Admin <admin@sthenos.net>' . "\r\n";

        $mailTo      = $strEmail;
        $mailSubject = "Show and Tell Password Reset";
        $mailBody    = "Your password for Show and Tell has been reset. Your login information is as follows: <p><ul>";
        $mailBody   .= "<li>" . $strEmail . "</li>";
        $mailBody   .= "<li>" . $strToken . "</li>";
        $mailBody   .= "</ul>";

        if(mail($mailTo, $mailSubject, $mailBody, $mailHeader)) {

            return true;
        }

        return false;
    }

    /**
     * @func      func_name
     * @desc      description
     * @param     [type]         $arrRequest    [description]
     * @return    [type]                        [description]
     */
    public static function updateProfile($arrRequest)
    {
        // Confirm that email is unique
        $arrCheckEmail = DB::table('users')
            ->where('email', $arrRequest['email'])
            ->get();

        // Confirm that username is unique
        $arrCheckName = DB::table('users')
            ->where('name', $arrRequest['username'])
            ->get();

        if (!empty($arrCheckEmail) && $arrRequest['email'] != Auth::user()->email) {
            return array(
                'message' => 'The \'email\' (' . $arrRequest['email'] . ') you entered appears to already be in use.',
                'status'  => 'danger',
                'heading' => 'Opps!',
            );
        }

        if (!empty($arrCheckName) && $arrRequest['username'] != Auth::user()->name) {
            return array(
                'message' => 'The \'username\' (' . $arrRequest['username'] . ') you entered appears to already be in use.',
                'status'  => 'danger',
                'heading' => 'Opps!',
            );
        }

        // Update
        $blnUpdateUser = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'email' => $arrRequest['email'],
                'name'  => $arrRequest['username'],
            ]);

        if ($blnUpdateUser) {
            return array(
                'message' => 'Your profile information has been updated.',
                'status'  => 'success',
                'heading' => 'Success!',
            );
        }

        return array(
            'message' => 'An error has occured and we were unable to update your profile. Please try again.',
            'status'  => 'danger',
            'heading' => 'Opps!',
        );

    }

    /**
     * @func      func_name
     * @desc      description
     * @param     [type]         $arrRequest    [description]
     * @return    [type]                        [description]
     */
    public static function updatePassword($arrRequest)
    {
        // Check that old password matches existing password
        if (!Hash::check($arrRequest['old-password'], Auth::user()->password)) {

            // Old password does not match recorded password. Therefore, return alert:
            return array(
                'message' => 'The \'old password\' you entered did not match the password we have on record.',
                'status'  => 'danger',
                'heading' => 'Opps!',
            );
        }

        // Update the users password to match the
        $blnUpdateUser = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['password' => Hash::make($arrRequest['new-password'])]);

        // Return alert
        if ($blnUpdateUser) {
            return array(
                'message' => 'Your password has been updated.',
                'status'  => 'success',
                'heading' => 'Success!',
            );
        }

        return array(
            'message' => 'An error has occured and we were unable to upate your password. Please try again.',
            'status'  => 'danger',
            'heading' => 'Opps!',
        );
    }

    public static function resetPassword($arrRequest)
    {
        $strToken = Self::generateToken();

        // Update the users password to match the
        $blnUpdateUser = DB::table('users')
            ->where('email', $arrRequest['email'])
            ->update(['password' => Hash::make($strToken)]);

        // Return alert
        if ($blnUpdateUser && Self::sendResetEmail($arrRequest['email'], $strToken)) {
            return array(
                'message' => 'Your password has been reset. An email will be sent to ' . $arrRequest['email'] . ' with your new login information.',
                'status'  => 'success',
                'heading' => 'Success!',
            );
        }

        return array(
            'message' => 'An error has occured and we were unable to reset your password. Please try again.',
            'status'  => 'danger',
            'heading' => 'Opps!',
        );
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public static function get_gravatar($email, $s = 20, $d = 'mm', $r = 'g', $img = false, $atts = array())
    {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }

            $url .= ' />';
        }

        return $url;
    }
}
