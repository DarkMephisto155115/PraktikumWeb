<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Fetch all customers
        $customers = Customer::all();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Customer list retrieved successfully.',
            'data'    => $customers
        ], 200);
    }

    /**
     * Store a newly created customer in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:customers,email',
            'address' => 'required|string',
            'phone'   => 'nullable|string|max:15',
        ]);

        // Create a new customer
        $customer = Customer::create($request->all());

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Customer created successfully.',
            'data'    => $customer
        ], 201);
    }
    

    /**
     * Display the specified customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Find customer by ID
        $customer = Customer::find($id);

        // If customer not found
        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found.',
            ], 404);
        }

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Customer retrieved successfully.',
            'data'    => $customer
        ], 200);
    }

    /**
     * Update the specified customer in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Find customer by ID
        $customer = Customer::find($id);

        // If customer not found
        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found.',
            ], 404);
        }

        // Validate request
        $request->validate([
            'name'    => 'sometimes|required|string|max:255',
            'email'   => 'sometimes|required|email|unique:customers,email,' . $id,
            'address' => 'sometimes|required|string',
            'phone'   => 'nullable|string|max:15',
        ]);

        // Update customer
        $customer->update($request->all());

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Customer updated successfully.',
            'data'    => $customer
        ], 200);
    }

    /**
     * Remove the specified customer from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find customer by ID
        $customer = Customer::find($id);

        // If customer not found
        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found.',
            ], 404);
        }

        // Delete customer
        $customer->delete();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Customer deleted successfully.'
        ], 200);
    }
}
