<?php

namespace App\Http\Controllers;


use Illuminate\Http\Response;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;


Class UserController extends Controller {

    use ApiResponser;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function getUsers()
    {
        $users = User::all();
        return response()->json(['data' => $users], 200);
        
        //return $this->successResponse($users);
    }

    public function index()
    {
        $users = User::all();
        
        return $this->successResponse($users);
    }



    public function add(Request $request)
    {
        
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
        ];

        $this->validate($request,$rules);

        $user = User::create($request->all());
        return $this->successResponse($user, Response::HTTP_CREATED);
        //return response()->json($user, 200);
    }


    public function show($id)
    {
        //$user =  User::findOrFail($id);
        $user = User::where('userid', $id)->first();

        if($user){
            return $this->successResponse($user);
        }
        else{
            return $this->errorResponse('User ID Does Not Exists', Response::HTTP_NOT_FOUND);
        }
        
    }

    /*public function deleteTeacher($id) {
        $teachers = Teacher::where('teacherid', $id)->delete();

        if($teachers){
            return $this->successResponse($teachers);
        }
        else{
            return $this->errorResponse('Teacher ID Does Not Exists', Response::HTTP_NOT_FOUND);
        }
    }*/

    /*// UPDATE
    public function updateTeacher(Request $request, $id)
    {

        $teachers = Teacher::where('teacherid', $id)->firstOrFail();
        $rules = [
            $this->validate($request, [
            'lastname' => 'required|max:20|alpha',
            'firstname' => 'required|max:20|alpha',
            'middlename' => 'required|max:20|alpha',
            'bday' => 'required|date',
            'age' => 'required|integer|min:18',
            ])  
        ];
        $this->validate($request, $rules);
        $teachers->fill($request->all());
        $teachers->save();
        
        return $teachers;
    } */

}


