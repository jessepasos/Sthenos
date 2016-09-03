<?php

namespace App\Http\Controllers;

use App\Comments_Model;
use App\Http\Controllers\Auth_Controller;
use App\Http\Controllers\Portfolio_Controller;
use App\Http\Requests\Login_Request;
use App\Http\Requests\Password_Request;
use App\Http\Requests\Profile_Request;
use App\Http\Requests\Submit_Request;
use App\Http\Requests\Reset_Request;
use App\Images_Model;
use App\User;
use Auth;
use DB;
use Input;
use Request;
use Response;

class Show_Tell_Controller extends Controller
{

    static $objData;

    /**
     * @func    __construct
     * @desc    description
     */
    public function __construct()
    {
        static::$objData = Self::buildData();

        $objPortfolio = new Portfolio_Controller;
        view()->share('arrData', $objPortfolio::portfolio('show_tell'));
        view()->share('objData', static::$objData);
        view()->share('objFrontPage', Self::buildGalleryData());
    }

    /**
     * @func      buildData
     * @desc      description
     * @return    [type]         [description]
     */
    public static function buildData()
    {
        $objData            = (object) array();
        $objData->alert     = false;
        $objData->dashboard = 'dashboard';
        $objData->user      = Self::buildUserData($objData);
        $objData->album     = Self::buildAlbumData($objData);
        $objData->comments  = Self::buildCommentData($objData);
        $objData->status    = Self::buildStatusData($objData->user['id']);
        $objData->is_admin  = (Auth::user() && Auth::user()->role == 'admin') ? true : false;
        $objData->admin     = Self::buildAdminData($objData);

        return $objData;
    }

    /**
     * @func      func_name
     * @desc      description
     * @return    [type]         [description]
     */
    public static function buildUserData($objData)
    {
        if (Auth::user()) {
            return array(
                'id'       => Auth::user()->id,
                'email'    => Auth::user()->email,
                'name'     => Auth::user()->name,
                'role'     => Auth::user()->role,
                'flag'     => Auth::user()->flag,
                'status'   => Self::accountStatus((int) Auth::user()->flag),
                'gravatar' => array(
                    'sm' => Auth_Controller::get_gravatar(Auth::user()->email, 75),
                    'lg' => Auth_Controller::get_gravatar(Auth::user()->email, 250),
                ),
            );
        }

        return false;
    }

    /**
     * @func      func_name
     * @desc      description
     * @return    [type]         [description]
     */
    public static function buildAlbumData($objData)
    {
        if (!$objData->user) {
            return false;
        }

        return array(
            'uploads' => Images_Model::get()
                ->where('flag', '1')
                ->where('user_id', (String) Auth::user()->id),

            'pending' => Images_Model::get()
                ->where('flag', '2')
                ->where('user_id', (String) Auth::user()->id),
        );
    }

    /**
     * @func      func_name
     * @desc      description
     * @return    [type]         [description]
     */
    public static function buildCommentData($objData)
    {
        if (!$objData->user) {
            return false;
        }

        $intUserId = $objData->user['id'];

        $objUploads = DB::table('images')
            ->where('user_id', $intUserId)
            ->where('flag', 1)
            ->get();

        $arrComments['given'] = DB::table('comments')
            ->join('images', 'images.id', '=', 'comments.image_id')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('comments.user_id', $intUserId)
            ->where('comments.flag', 1)
            ->select('comments.*', 'images.name as image_name', 'images.resource', 'users.name as user_name')
            ->orderBy('comments.created_at', 'desc')
            ->get();

        $arrReceived = array();
        foreach ($objUploads as $intKey => $objValue) {
            $arrReceived[$objValue->id] = DB::table('comments')
                ->join('images', 'images.id', '=', 'comments.image_id')
                ->join('users', 'users.id', '=', 'comments.user_id')
                ->where('comments.image_id', $objValue->id)
                ->where('comments.flag', 1)
                ->where('comments.user_id', '!=', $intUserId)
                ->select('comments.*', 'images.name as image_name', 'images.resource', 'users.name as user_name')
                ->orderBy('comments.created_at', 'desc')
                ->get();
        }

        $arrComments['recieved'] = $arrReceived;


        return $arrComments;
    }

    /**
     * @func      func_name
     * @desc      description
     * @param     [type]         $objData      [description]
     * @param     array          $arrStatus    [description]
     * @return    [type]                       [description]
     */
    public static function buildStatusData($intUserId, $arrStatus = array())
    {
        if (!isset($intUserId)) {
            return false;
        }

        // Count active images:
        $objUploads = DB::table('images')
            ->where('user_id', $intUserId)
            ->where('flag', 1)
            ->get();

        $arrStatus['uploads'] = count($objUploads);

        // Count inactive images:
        $arrStatus['pending'] = DB::table('images')
            ->where('user_id', $intUserId)
            ->where('flag', 2)
            ->count();

        // Count given comments:
        $arrStatus['given'] = DB::table('comments')
            ->where('user_id', $intUserId)
            ->where('flag', 1)
            ->count();

        // Count recieved comments:
        $intCount = 0;
        foreach ($objUploads as $intKey => $objValue) {
            $intCount = DB::table('comments')
                ->where('image_id', $objValue->id)
                ->where('flag', 1)
                ->where('user_id', '!=', $intUserId)
                ->count();
        }

        $arrStatus['recieved'] = $intCount;

        return $arrStatus;
    }

    public static function buildAdminData($objData)
    {
        $arrAdmin = array();

        // Get user data:
        $arrAdmin['users'] = User::get()->where('flag', '1');

        // Get pending images:
        $arrAdmin['images'] = Images_Model::getPendingImages();

        return $arrAdmin;
    }

    /**
     * @func      func_name
     * @desc      description
     * @param     [type]         $intFlag    [description]
     * @return    [type]                     [description]
     */
    public static function accountStatus($intFlag)
    {
        switch ($intFlag) {
            case 1:
                return 'Active';

            case 0:
                return 'Suspended';

            default:
                return 'Active';
        }
    }

    public static function buildGalleryData()
    {

        $objFrontPage = (object) array();

        $objFrontPage->items = DB::table('images')
            ->where('flag', 1)
            ->get();

        $objFrontPage->comments = DB::table('comments')
            ->where('flag', 1)
            ->get();

        return $objFrontPage;
    }

    /**
     * @func      index
     * @desc      description
     * @return    [type]         [description]
     */
    public static function index()
    {
        return view('portfolio/show_tell/index');
    }

    /**
     * @func      dashboard
     * @desc      description
     * @return    [type]         [description]
     */
    public static function dashboard($strSource = null)
    {

        if (Auth::check()) {
            static::$objData->dashboard = $strSource;

            if ($strSource) {
                return redirect('/show_tell/dashboard')
                    ->with('dashboard', static::$objData->dashboard)
                    ->with('alert', static::$objData->alert);
            }
            static::$objData->dashboard = 'dashboard';

            return view('portfolio/show_tell/dashboard');
        }

        return view('portfolio/show_tell/index');
    }

    /**
     * @func      login
     * @desc      description
     * @param     Login_Request    $objRequest    [description]
     * @return    [type]                          [description]
     */
    public static function login(Login_Request $objRequest)
    {
        // Get form data:
        $strAction = $objRequest->input('action');

        // Try logging in:
        if ($strAction == 'Login') {

            static::$objData->alert = Auth_Controller::handleLogin($objRequest->input());
        }

        // Try registering:
        if ($strAction == 'Register') {

            static::$objData->alert = Auth_Controller::handleRegister($objRequest->input());
        }

        return redirect('/show_tell/')
            ->with('alert', static::$objData->alert);
    }

    public static function logout()
    {
        Auth::logout();

        return redirect('/show_tell/');
    }

    public static function reset(Reset_Request $objRequest)
    {
        static::$objData->alert = Auth_Controller::resetPassword($objRequest->input());

        return redirect('/show_tell/')
            ->with('alert', static::$objData->alert);
    }

    /**
     * @func      profile
     * @desc      description
     * @param     Profile_Request    $objRequest    [description]
     * @return    [type]                            [description]
     */
    public static function profile(Profile_Request $objRequest)
    {
        static::$objData->alert = Auth_Controller::updateProfile($objRequest->input());

        return Self::dashboard('profile');
    }

    /**
     * @func      password
     * @desc      description
     * @param     Password_Request    $objRequest    [description]
     * @return    [type]                             [description]
     */
    public static function password(Password_Request $objRequest)
    {
        static::$objData->alert = Auth_Controller::updatePassword($objRequest->input());

        return Self::dashboard('profile');
    }

    /**
     * @func      password
     * @desc      description
     * @param     Password_Request    $objRequest    [description]
     * @return    [type]                             [description]
     */
    public static function submit(Submit_Request $objRequest)
    {
        // Check file:
        if (!isset($_FILES)) {
            static::$objData->alert = array(
                'message' => 'An error has occured and we were unable to upload your image.',
                'status'  => 'danger',
                'heading' => 'Opps!',
            );
        }

        // Upload file:
        $arrFile     = $_FILES['image'];
        $strFilename = Auth::user()->id . '_' . rand() . '_' . basename($arrFile['name']);
        move_uploaded_file(
            $arrFile['tmp_name'],
            public_path() . '/uploads/show_tell/' . $strFilename
        );

        // Update database:

        $blnCheckSubmit = Images_Model::create(array(
            'name'     => $objRequest->input('name'),
            'resource' => $strFilename,
            'user_id'  => Auth::user()->id,
            'flag'     => 2,
        ));

        static::$objData->alert = array(
            'message' => 'Your image has been uploaded.',
            'status'  => 'success',
            'heading' => 'Success!',
        );

        return Self::dashboard('submit');
    }

    /**
     * @func      func_name
     * @desc      description
     * @param     [type]         $intImgId    [description]
     * @return    [type]                      [description]
     */
    public static function image_accept($intImgId)
    {
        Images_Model::find($intImgId)->update(['flag' => 1]);
        return Self::dashboard('admin');
    }

    /**
     * @func      func_name
     * @desc      description
     * @param     [type]         $intImgId    [description]
     * @return    [type]                      [description]
     */
    public static function image_deny($intImgId)
    {
        $objImageItem = Images_Model::find($intImgId);
        $objImageItem->update(['flag' => 3]);
        unlink(public_path('uploads/show_tell/' . $objImageItem->resource));
        return Self::dashboard('admin');
    }

    /**
     * @func      func_name
     * @desc      description
     * @param     Request        $objRequest    [description]
     * @return    [type]                        [description]
     */
    public static function ajax_removeImage(Request $objRequest)
    {
        if (Request::ajax()) {

            // Get image item:
            $objImageItem = Images_Model::find(Input::get('id'));

            // Update flag in DB:
            $objImageItem->update(['flag' => 3]);

            // Remove from assets:
            unlink(public_path('uploads/show_tell/' . $objImageItem->resource));

            return Response::json([$objImageItem]);
        }
    }

    /**
     * @func      ajax_getUserData
     * @desc      description
     * @param     Request        $objRequest    [description]
     * @return    [type]                        [description]
     */
    public static function ajax_getUserData(Request $objRequest)
    {
        if (Request::ajax()) {

            // Get image item:
            $objUser   = User::find(Input::get('id'));
            $objImages = DB::table('images')
                ->where('user_id', Input::get('id'))
                ->where('flag', 1)
                ->get();

            $arrReturn = array(
                'user'   => array(
                    'id'       => $objUser->id,
                    'name'     => $objUser->name,
                    'email'    => $objUser->email,
                    'role'     => ucfirst($objUser->role),
                    'gravatar' => Auth_Controller::get_gravatar($objUser->email, 150),
                ),
                'status' => Self::buildStatusData($objUser->id),
                'images' => $objImages,
            );

            return Response::json([$arrReturn]);
        }
    }

    /**
     * @func      ajax_getImageData
     * @desc      description
     * @param     Request        $objRequest    [description]
     * @return    [type]                        [description]
     */
    public static function ajax_getImageData(Request $objRequest)
    {
        if (Request::ajax()) {

            // Get image item:
            $objImage = DB::table('images')
                ->where('id', Input::get('id'))
                ->get();

            // Get user info:
            $objUser = User::find($objImage[0]->user_id);

            // Get comment info:
            $objComments = DB::table('comments')
                ->join('users', 'users.id', '=', 'comments.user_id')
                ->where('comments.image_id', Input::get('id'))
                ->where('comments.flag', 1)
                ->get();

            foreach($objComments as $intIndex => $objValues) {
                $objComments[$intIndex]->gravatar = Auth_Controller::get_gravatar($objComments[$intIndex]->email, 150);
            }

            $arrReturn = array(
                'image'    => $objImage,
                'user'     => $objUser,
                'comments' => $objComments,
            );

            return Response::json([$arrReturn]);
        }
    }

    /**
     * @func      func_name
     * @desc      description
     * @param     Request        $objRequest    [description]
     * @return    [type]                        [description]
     */
    public static function ajax_submitComment(Request $objRequest)
    {
        if (Request::ajax()) {

            $intUserId  = Input::get('user');
            $intImageId = Input::get('image');
            $strComment = Input::get('comment');

            $arrReturn = array();

            // Submit Comment:
            $arrComment = Comments_Model::create(array(
                'text'     => Input::get('comment'),
                'user_id'  => Input::get('user'),
                'image_id' => Input::get('image'),
                'flag'     => 1,
            ));

            $arrDate = DB::table('comments')
            ->select('created_at')
            ->where('id', $arrComment->id)
            ->get();

            $arrReturn['comment']    = $arrComment;
            $arrReturn['created_at'] = $arrDate[0]->created_at;
            $arrReturn['user']       = User::find(Input::get('user'));
            $arrReturn['gravatar']   = Auth_Controller::get_gravatar($arrReturn['user']->email, 150);

            return Response::json([$arrReturn]);
        }
    }
}
