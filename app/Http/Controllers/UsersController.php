<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;

class UsersController extends Controller
{
    public function index()
    {
        return User::with('role')->get();;
    }

    /**
     * @method store
     * @description Método para guardar un nuevo usuario
     * @param (array) $request
     * @return (json)
     **/
    public function store(StoreUserRequest $request)
    {
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $fileName);       
        }
    	$user 			= new User;
        $user->email 	= $request->email;
        $user->name 	= $request->name;
        $user->role_id 	= $request->role_id;
        $user->password = bcrypt($request->password);
        $user->profile  = $fileName;
        $user->save();

        return response([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    /**
     * @method edit
     * @description Método para obtener el usuario
     * @param (int) $id
     * @return (json)
     **/
    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => true, 'message' => 'Unable to find Ingredient with ID ' . $id], 400);
        }
        return response()->json($user);
    }

    /**
     * @method update
     * @description Nétodo para actualizar un usuario
     * @param (array) $request
     * @param (int) $id
     * @return (json)
     **/
    public function update(UpdateUserRequest $request, $id)
    {
        $fileName = null;
        $user = User::find($id);

        if (!$user) {
    		return response()->json(['error' => true, 'message' => 'Unable to find Ingredient with ID ' . $id], 400);
    	}
        $user->email 	= $request->email;
        $user->name 	= $request->name;
        $user->role_id 	= $request->role_id;
        if ($request->password) {
        	$user->password = bcrypt($request->password);
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $fileName);
            $user->profile  = $fileName;      
        }
        $user->save();
        return response()->json('Usuario editado correctamente', 200);
    }

    /**
     * @method destroy
     * @description Método para eliminar un usuario
     * @param (int) $id
     * @return (json)
     **/
    public function destroy($id)
    {
    	$user = User::find($id);

    	if (!$user) {
    		return response()->json(['error' => true, 'message' => 'Unable to find Ingredient with ID ' . $id], 400);
    	}

    	$user->delete();
        return response()->json('Usuario elimiando correctamente', 200);
    }
}
