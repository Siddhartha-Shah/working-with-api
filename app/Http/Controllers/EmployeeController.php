<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Http\Requests\StorePostRequest;

class EmployeeController extends Controller
{
    public function add(Request $request)
    {
        $employee = new Employee();
        $employee->id = $request->id;
        $employee->name = $request->name;
        $employee->department = $request->department;
        $result = $employee->save();
        if ($result) {
            return ['data' => 'inserted'];
        } else {
            return ['data' => 'not inserted'];
        }
    }
    public function getAll($id = null)
    {
        return $id ? Employee::find($id) : Employee::all();
    }

    public function update(Request $request)
    {
        $employee = Employee::find($request->id);
        $employee->name = $request->name;
        $employee->department = $request->department;
        $result = $employee->save();
        if ($result) {
            return ["result" => "data has been updated"];
        } else {
            return ["result" => "data has not been updated"];
        }
    }

    public function search($name)
    {
        return Employee::where('name', $name)->get();
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        $result = $employee->delete();
        if ($result) {
            return ["result" => "Data has ben deleted"];
        } else {
            return ["result" => "Data has not been deleted"];
        }
    }

    public function testData(Request $req)
    {
       // dd($req->);
        // $rules = array(
        //     "id" => "required|min:2|max:4|unique:employees,id",
        //     "name" => "required|min:4|max:20|unique:employees,name"
        // );

        $validator = Validator::make($req->all(), StorePostRequest::rules());
       // dd($validator->errors());

        if ($validator->fails()) {

            return $validator->errors();
        } else {
            $emp=new Employee();
            $emp->id=$req->id;
            $emp->name=$req->name;
            $emp->department=$req->department;
            $emp->save();
        }
    }
    function index(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ];
        
             return response($response, 201);
    }
}