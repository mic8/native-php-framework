<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Vendor\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $data = $this->user->all();

        return $this->response()->json($data);
    }

    public function store(Request $request)
    {
        $created = $this->user->create($request->all());

        if($created) {
            return $this->response()->json(['success' => true, 'message' => 'Success create new user', 'data' => $created], 200);
        } else {
            return $this->response()->json(['success' => false, 'message' => 'Failed create new user'], 200);
        }
    }

    public function show($id)
    {
        $find = $this->user->find($id);

        return $this->response()->json(['success' => true, 'data' => $find->get()], 200);
    }

    public function destroy($id)
    {
        $find = $this->user->find($id);
        $deleted = $find->delete();

        if($deleted) {
            return $this->response()->json(['success' => true, 'message' => 'Success delete user with id: ' . $id], 200);
        } else {
            return $this->response()->json(['success' => false, 'message' => 'Failed to delete user with id: ' . $id], 500);
        }
    }
}