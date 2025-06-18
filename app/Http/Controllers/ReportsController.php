<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Kreait\Firebase\Factory;  // Firebase factory to create Firebase services
use Kreait\Firebase\Contract\Database;  // Firebase database contract
use Kreait\Firebase\Contract\Storage;
use GuzzleHttp\Client;  // Guzzle HTTP client for making HTTP requests

use App\Models\Report;  // Eloquent model for the 'reports' table

class ReportsController extends Controller
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



    public function view()
    {

        // Get a reference to the 'reports' child node under 'aac'
        $reportsSnapshot = $this->reference->getChild('reports');

        // Query to filter reports where the status is 0
        //$query = $reportsReference->orderByChild('status')->equalTo($status);

        // Get a snapshot of the query result
        $snapshot = $reportsSnapshot->getSnapshot();
        $reports = $snapshot->getValue();  // Get the value of the snapshot (the data at the 'reports' reference)

        // Initialize an empty array to hold the reports data
        $reportsArray = [];
        if (is_array($reports)) {
            // Iterate over the reports data if it's an array
            foreach ($reports as $reportId => $reportData) {
                $reportData['id'] = $reportId;

                $reportsArray[] = $reportData;  // Add the reeport data to the stores array
            }
        }

        // Return the 'administrator.store' view with the title and stores data
        return view('reports', ['reports' => $reportsArray]);
    }

    // private function getImageUrl($storeId, $fileName)
    // {
    //     $filePath = 'images/' . $storeId . '/' . $fileName;
    //     try {
    //         $imageReference = $this->storage->getBucket()->object($filePath);
    //         if ($imageReference->exists()) {
    //             return $imageReference->signedUrl(new \DateTime('tomorrow'));
    //         }
    //     } catch (\Exception $e) {
    //         // Handle the error if the file does not exist or there's another issue
    //         return null;
    //     }
    //     return null;
    // }

    // function approve($id)
    // {
    //     $status = [
    //         'status' => 1,
    //     ];
    //     $postRef = $this->database->getReference('ibuyit/stores/' . $id)->update($status);
    //     return redirect()->back()->with('success', 'Store application has been approved!');

    // }

    // function reject($id)
    // {
    //     $status = [
    //         'status' => 2,
    //     ];
    //     $postRef = $this->database->getReference('ibuyit/stores/' . $id)->update($status);
    //     return redirect()->back()->with('success', 'Store application has been rejected!');

    // }
}