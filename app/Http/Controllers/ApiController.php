<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;

/**
 * Class ApiController
 * @package App\Http\Controllers
 * This is a base controller
 * All other controllers (except Auth controllers) will be exteding from APIController
 * Auth controllers are not related directly with api controllers
 */

class ApiController extends Controller
{
    use ApiResponser;
}
