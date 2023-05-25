<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller
{
    public function add(Request $request){
        $employee=new Employee();
        $employee->id=$request->id;
        $employee->name=$request->name;
        $employee->department=$request->department;
        $result=$employee->save();
        if($result){
            return ['data'=>'inserted'];
        }else{
            return ['data'=>'not inserted'];
        }
    }
    public function getAll($id=null){
        return $id?Employee::find($id):Employee::all();
    }

    public function update(Request $request){
       $employee=Employee::find($request->id);
       $employee->name=$request->name;
       $employee->department=$request->department;
       $result=$employee->save();
       if($result){
        return ["result"=>"data has been updated"];
       }else{
        return ["result"=>"data has not been updated"];
       }
    }

    public function search($name){
        return Employee::where('name',$name)->get();
    }

    public function delete($id){
        $employee=Employee::find($id);
        $result=$employee->delete();
        if($result){
            return ["result"=>"Data has ben deleted"];
        }else{
            return ["result"=>"Data has not been deleted"];
        }
    }
}
