<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch data from MockAPI with Guzzle
        $client = new \GuzzleHttp\Client();
        $request = $client->get(env('MOCKAPI_ENDPOINT') . 'users');
        $response = $request->getBody()->getContents();
        $users = json_decode($response, true);

        // Return view with data
        return view('dashboard', ['users' => $users]);
    }

    // Method to update user data
    public function update(Request $request)
    {
        // Post data to MockAPI with Guzzle
        // $client = new \GuzzleHttp\Client();
        // $request = $client->put(env('MOCKAPI_ENDPOINT') . 'users/' . $request->id, [
        //     'json' => [
        //         'name' => $request->name,
        //         'dateOfBirth' => $request->dateOfBirth,
        //         'gender' => $request->gender,
        //         'address' => $request->address,
        //         'number' => $request->number,
        //         'state' => $request->state,
        //         'city' => $request->city,
        //     ]
        // ]);
        // $response = $request->getBody()->getContents();
        // $user = json_decode($response, true);

        // Set session status if user data updated successfully
        // if ($user) {
        //     $success = 'User data updated successfully!';
        // } else {
        //     $error = 'User data failed to update!';
        // }
        

        // Return view with data
        return dd($request->all());
        // return redirect('/dashboard', ['success' => $success, 'error' => $error]);
    }
}
