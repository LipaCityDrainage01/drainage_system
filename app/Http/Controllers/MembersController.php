<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewAccountNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Role;

class MembersController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->wantsJson()) {
            $members = User::where('type', 'Admin')
                ->with('role')
                ->latest()
                ->get();

            return response()->json($members);
        }

        return view('secure.members.index');
    }

    public function fetchRole(Request $request)
    {

        $role = Role::latest()
            ->get();

        return response()->json($role);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //

        return view('secure.members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


        DB::beginTransaction();

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'contact_no' => 'required',
        ]);

        try {

            $password = \Str::password(8);

            $request->merge([
                'password' => \Hash::make($password)
            ]);

            $user = User::create($request->all());

            \Notification::send($user, new NewAccountNotification([
                'username' => $user->username ,
                'name' => $user->name,
                'password' => $password,
                'email' => $user->email,
            ]));

            DB::commit();

            $notification = array(
                'message' => 'User created successfully',
                'type' => 'success'
            );

            return response()->json($notification);

        }
        catch (\Exception $exception) {
            \DB::rollback();

            \Log::error('Unable to create record', [
                'exception' => $exception,
                'message'=> $exception->getMessage(),
                'line'=> $exception->getLine(),
                'code' => $exception->getCode(),
                'headers' => $request->headers,
                'form_data' => $request->all()
            ]);

            return response()->json([
                'exception' => $exception->getMessage(),
                'message'=> 'There was an error with your action, please contact administrator',
                'type' => 'danger'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        \DB::beginTransaction();

        try {

            if ($request->post('password') !== null) {

                $request->merge([
                    'password' => \Hash::make($request->post('password'))
                ]);

                User::find($id)
                    ->update($request->all());
            } else {

                User::find($id)
                    ->update($request->except('password'));
            }

            $notification = array(
                'message' => 'Record updated successfully',
                'type' => 'success',
            );

            \DB::commit();

            return response()->json($notification);

        }
        catch (\Exception $exception) {
            \Log::error('Unable to Update Member Record', [
                'exception' => $exception,
                'message'=> $exception->getMessage(),
                'line'=> $exception->getLine(),
                'code' => $exception->getCode(),
                'headers' => $request->headers,
                'form_data' => $request->all()
            ]);

            return response()->json([
                'message'=> 'There was an error with your action, please contact administrator',
                'type' => 'danger'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //

        \DB::beginTransaction();

        try {

            User::find($id)->delete();

            $notification = array(
                'message' => 'Record deleted successfully',
                'type' => 'success',
            );

            \DB::commit();

            return response()->json($notification);

        }
        catch (\Exception $exception) {
            \Log::error('Unable to delete record', [
                'exception' => $exception,
                'message'=> $exception->getMessage(),
                'line'=> $exception->getLine(),
                'code' => $exception->getCode(),
                'headers' => $request->headers,
                'form_data' => $request->all()
            ]);

            return response()->json([
                'message'=> 'There was an error with your action, please contact administrator',
                'type' => 'danger'
            ]);
        }
    }
}
