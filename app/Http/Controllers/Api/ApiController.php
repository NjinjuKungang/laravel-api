<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEmployeeRequest;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{

    /**
     * Create a new employee - POST
     */
    public function createEmployee(Request $request): JsonResponse
    {
        // dd($request->all());
        logger("THe request details ", $request->all());
        
        logger("The request ", [$request]);

        /*
         * Validation of inputs
         */
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone_no' => 'required',
            'gender' => 'required',
            'age' => 'required',
        ]);

        // $validated = $request->validated();

        /*
         * Creating data according to model structure
         */

        $employee = new Employee();

        $employee->name = $validated['name'];
        $employee->email = $validated['email'];
        $employee->phone_no = $validated['phone_no'];
        $employee->gender = $validated['gender'];
        $employee->age = $validated['age'];

        $employee->save();

        /*
        * Send response
        */

        return response()->json([
            'status' => 1,
            'message' => 'Employee created successfully',
        ]);

    }


    /**
     * List all employees - GET
     */

    public function listEmployees(): JsonResponse
    {
        $employees =  Employee::get();

        return response()->json([
           'status' => 1,
           'message' => 'Listing employees',
            'data' => $employees
        ], 201);
    }

    /**
     * Get single employee detail - GET
     */

    public function getSingleEmployee($id): JsonResponse
    {
        if(Employee::where('id', $id)->exists()){
            $employee = Employee::where('id', $id)->first();
            return response()->json([
               'status' => 1,
               'message' => 'Employee detail',
                'data' => $employee
            ], 202);
        } else {
            return response()->json([
            'status' => 0,
            'message' => 'Employee not found',
            ], 404);
        }
    }

    /**
     * Update an employee's detail - PUT
     */

    public function updateEmployee(Request $request, $id): JsonResponse
    {

        $validated = $request->validate([
            'name' => '',
            'email' => '',
            'phone_no' => '',
            'gender' => '',
            'age' => '',
        ]);
        if(Employee::where('id', $id)->exists()){
            $employee = Employee::find($id);

            $employee->name = !empty($validated['name']) ? $validated['name'] : $employee->name;
            $employee->email = !empty($validated['email']) ? $validated['email'] : $employee->email; 
            $employee->phone_no = !empty($validated['phone_no']) ? $validated['phone_no'] : $employee->phone_no;
            $employee->gender = !empty($validated['gender']) ? $validated['gender'] : $employee->gender;
            $employee->age = !empty($validated['age']) ? $validated['age'] : $employee->age;
        
            $employee->save();

            return response()->json([
                'status' => 1,
               'message' => 'Employee updated successfully',
            ], 203);

        } else {
            return response()->json([
            'status' => 0,
            'message' => 'Employee not found',
            ], 404);
        }
    }

    /**
     * Delete an employee's detail - DELETE
     */

     public function deleteEmployee($id)
     {
        if(Employee::where('id', $id)->exists()){
            
            $employee = Employee::find($id);

            $employee->delete();

            return response()->json([
                'status' => 1,
               'message' => 'Employee deleted successfully',
            ], 204);

        } else {
            return response()->json([
            'status' => 0,
            'message' => 'Employee not found',
            ], 404);
        }
     }
}


