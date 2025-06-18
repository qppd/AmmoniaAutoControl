<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Factory;  // Firebase factory to create Firebase services
use Kreait\Firebase\Contract\Storage;
use GuzzleHttp\Client;

use App\Models\User;
use App\Models\Monitor;

use Carbon\Carbon;


class DashboardController extends Controller
{
    protected $database;  // Firebase database instance
    protected $reference;  // Firebase reference to a specific node

    public function __construct()
    {
        // Initialize Firebase with the service account and database URI
        $factory = (new Factory)
            ->withServiceAccount('../firebase.json')  // Path to the Firebase service account JSON file
            ->withDatabaseUri('https://ammoniaautocontrol-default-rtdb.firebaseio.com/');  // Firebase database URL

        $this->database = $factory->createDatabase();  // Create a Firebase database instance
        $this->reference = $this->database->getReference('aac');  // Get a reference to the 'aac' node in the database
        $this->storage = $factory->createStorage(); // Initialize Firebase Storage
    }

    function view()
    {
        $monitorSnapshot = $this->reference->getChild('monitor');
        $snapshot = $monitorSnapshot->getSnapshot();
        $monitor = $snapshot->getValue();

        $settingSnapshot = $this->reference->getChild('settings');
        $settingSnapshot = $settingSnapshot->getSnapshot();
        $settings = $settingSnapshot->getValue();



        return view('/dashboard', [
            'settings' => $settings
        ]);
    }

    function fetchDashboardData()
    {

        $monitorSnapshot = $this->reference->getChild('monitor');
        $snapshot = $monitorSnapshot->getSnapshot();
        $value = $snapshot->getValue();

        return response()->json($value);
    }

    public function saveAmmoniaLimit(Request $request)
    {
        $request->validate([
            'ammonia_limit' => 'required|numeric|min:0', // Ensure it's a number
        ]);

        $ammoniaLimit = (int) $request->input('ammonia_limit'); // Explicitly cast to integer

        // Save the limit in Firebase under 'settings' node
        $this->database->getReference('aac/settings')->update([
            'ammonia_limit' => $ammoniaLimit
        ]);

        return redirect()->back()->with('success', 'Ammonia limit saved successfully!');
    }

    public function updateMode(Request $request)
    {
        $mode = (int) $request->input('automatic'); // Ensure it's saved as an integer (1 or 0)

        $this->database->getReference('aac/settings/automatic')->set($mode); // Save to Firebase

        return response()->json(['success' => true, 'automatic' => $mode]);
    }



}
