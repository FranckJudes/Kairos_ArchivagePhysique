<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PasswordDefault;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'super')->get();
        return view('Users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try{
            $existingDefault = PasswordDefault::first();

            if (!$existingDefault) {
                toastr()->error("Veuilez definir le mot de passe par defaut pour la creation des utilisateurs");
                return redirect()->back();
            }

            $rules = [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:255',
                'role' => 'required|in:admin,user',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();

                $errorMessage = '';
                foreach ($errors->all() as $message) {
                    $errorMessage .= $message . '<br>';
                }

                toastr()->error($errorMessage);
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = new User();
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->password = Hash::make($existingDefault->valeur);
            $user->role = $request->input('role');


            if ($request->hasFile('profile_image')) {
                $imagePath = $request->file('profile_image')->store('profile_images', 'public'); // Store image
                $user->profile_image = $imagePath;
            }

            $user->save();

            toastr()->success('User created successfully.');
            return redirect()->back(); // Redirect with success message

       }catch(Exception $exception){
            toastr()->error($exception->getMessage());
            return back();
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
        try {
            $user = User::findOrFail($id);

            $rules = [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'bio' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'role' => 'nullable|string|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                toastr()->error('Validation error');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->bio = $request->input('bio');
            if ($request->has('role')) {
                $user->role = $request->input('role');
            }

            if ($request->hasFile('profile_image')) {
                $imagePath = $request->file('profile_image')->store('profile_images', 'public');
                $user->profile_image = $imagePath;
            }

            $user->save();

            toastr()->success('Utilisateur mis à jour avec succès.');
            return redirect()->back();
        } catch (Exception $exception) {
            toastr()->error($exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

           $user =  User::find($id);

           if ($user){

              $user->delete();
              return response()->json(['success'=> true]);

           }

           return response()->json(['success'=> false]);

        }catch(Exception $exception){

            return response()->json(['success'=> false,'message' => $exception->getMessage()]);

        }
    }


    public function update_theme(Request $request){
        try{
            $user = User::where('id',Auth::user()->id)->first();
            if($user){
                $user->theme_preference = $request->my_color_theme;
                $user->save();
                toastr()->success('Operation Reussi ! ');
                return redirect()->back();
            }else{
                toastr()->error('Utilisateur non authentifie');
                return redirect()->back();
            }

        }catch (\Exception $e){
            toastr()->error('Une erreur est survenue !');
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            $user = Auth::user();

            // Vérifier si l'ancien mot de passe est correct
            if (!Hash::check($request->old_password, $user->password)) {
                toastr()->error('Ancien mot de passe incorrect');
                return redirect()->back();
            }

            // Mettre à jour le mot de passe
            $user->password = Hash::make($request->new_password);
            $user->save();

            toastr()->success('Mot de passe mis à jour avec succès');
            return redirect()->back();
        } catch (Exception $th) {
            toastr()->error('Une erreur est survenue. Veuillez réessayer.');
            return redirect()->back();
        }
    }
}
