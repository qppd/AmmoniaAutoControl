<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Kreait\Firebase\Factory;  // Firebase factory to create Firebase services
use Kreait\Firebase\Contract\Database;  // Firebase database contract
use Kreait\Firebase\Contract\Storage;
use GuzzleHttp\Client;  // Guzzle HTTP client for making HTTP requests

use App\Models\Report;  // Eloquent model for the 'reports' table

class HelpController extends Controller
{
    function view()
    {

        return view('help');
    }

}
