<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Services\Business\SecurityService;

class OrderController extends Controller
{
    // To obtain an instance of the current HTTP request from a post
    public function index(Request $request)
    {
        $customerData = new CustomerModel($request->input('firstName'), $request->input('lastName'));
        
        
        // Since wwe are not using a model
        $product = request()->get('product');
        // This is more efficient since it is not calling a method
        $customerID = $request->input('customerID');
        
        // Instantiate the Business Logic Layer
        $serviceCustomer = new SecurityService();
        // Pass all data to the Business Layer
        $isValid = $serviceCustomer->addAllInformation($product, $customerID, $customerData);
        
        // Determine which view to display
        if ($isValid)
        {
            echo("Order Data Committed Successfully");
        }
        else
        {
            echo("Order Data Was Rolled Back");
        }
        return view('order');
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
