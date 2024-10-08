<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){
        $students = Student::get();
        if($students->count() > 0){
        $data =[
            'status' => 200,
            'students' => $students
        ];
        return response()->json($data, 200);
        }
        else{
            $data =[
            'status' => 404,
            'students' => "No Records Found"
        ];
        return response()->json($data, 404);
        }

    }
    public function store(Request $request){
        $validator =Validator::make($request->all(),[
            'name' => 'required | max:255',
            'email' => 'required | max:255',
            'phone' => 'required | max:255',
            'course' => 'required | max:255',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ],422);
        }
        else{
            $student = Student::create([
                'name' =>$request->name,
                'email' => $request->email,
                'course' => $request->course,
                'phone' => $request->phone
            ]);
        }
        if($student){
            return response()->json([

                'status' => 200,
                'messege' => "Student Create Successfully"
            ],200);
        }
        else{
             return response()->json([

                'status' => 500,
                'messege' => "Something Went Wrong"
            ],500);
        }
    }

    public function show($id){
        $student = Student::find($id);
                if($student){
            return response()->json([

                'status' => 200,
                'student' => $student
            ],200);
        }
        else{
             return response()->json([

                'status' => 404,
                'messege' => "Not Found"
            ],404);
        }


   }
       public function edit($id){
        $student = Student::find($id);
                if($student){
            return response()->json([

                'status' => 200,
                'student' => $student
            ],200);
        }
        else{
             return response()->json([

                'status' => 404,
                'messege' => "Not Found"
            ],404);
        }


   }

   public function update(Request $request , $id){

        $validator =Validator::make($request->all(),[
                    'name' => 'required | max:255',
                    'email' => 'required | max:255',
                    'phone' => 'required | max:255',
                    'course' => 'required | max:255',
                ]);
                if($validator->fails()){
                    return response()->json([
                        'status' => 422,
                        'errors' => $validator->messages()
                    ],422);
                }
                else{
                    $student = Student::find($id);
                    $student->update([
                        'name' =>$request->name,
                        'email' => $request->email,
                        'course' => $request->course,
                        'phone' => $request->phone
                    ]);
                }
                if($student){
                    return response()->json([

                        'status' => 200,
                        'messege' => "Student Update Successfully"
                    ],200);
                }
                else{
                    return response()->json([

                        'status' => 404,
                        'messege' => "Student Not Found"
                    ],404);
                }
   }

   public function destroy($id){
     $student = Student::find($id);

     if($student){
                    $student->delete();
                    return response()->json([

                        'status' => 200,
                        'messege' => "Student Deleted Successfully"
                    ],200);
                }
                else{
                    return response()->json([

                        'status' => 404,
                        'messege' => "Student Not Found"
                    ],404);
                }
   }
}