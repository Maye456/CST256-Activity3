<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Services\Business\SecurityService;

class CustomerController extends Controller
{
    // To obtain an instance of the current HTTP request from a post
    public function index(Request $request)
    {
        // This is from the next step d in the activity
        // Create a CustomerModel w/ firstName and lastName
        //$customerData = new CustomerModel(request()->get('firstName'), request()->get('lastName'));
        
        // Instantiate the Business Logic Layer
        //$serviceCustomer = new SecurityService();
        // Pass the credentials to the Business Layer
        //$isValid = $serviceCustomer->addCustomer($customerData);
        
        // Determine which view to display
        //if ($isValid)
        //{
        //    echo("Customer Data Added Successfully");
        //}
        //else
        //{
        //    echo("Customer Data Was Not Added");
        //}
        $nextID = 0;
        return redirect('neworder')->with('nextID', $nextID)
                                   ->with('firstName', request()->get('firstName'))
                                   ->with('lastName', request()->get('lastName'));
        
        // Put all the form values in an array called 'formValues'
        //$formValues = $request->all();
        
        // Get just the username from the form
        //$userName = request()->get('user_name');
        
        // The get can be replaced by the input
        // $userName = request()->input('user_name');
        //return $request->all();
    }
    
    // Validation added for Activity3
    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for Login Form
        $rules = ['user_name' => 'Required | Between:4,10 | Alpha', 'password' => 'Required | Between:4,10'];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}
