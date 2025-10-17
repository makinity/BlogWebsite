<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('show.home')->with('success', 'Logged in Success!!');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Sorry, Incorrect Credentials'
        ]);
    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'profile' => 'required|mimes:jpg,jpeg,png|max:2048',
                'bio' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|confirmed',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            $profilePath = $request->file('profile')->store('profiles', 'public');

            Profile::create([
                'user_id' => $user->id,
                'bio' => $validated['bio'],
                'profile' => $profilePath,
            ]);

            Auth::login($user);

            return redirect()->route('show.home')->with('success', 'Account Registered Successfully!!');

        } catch (ValidationException $e) {
            return redirect()->back()
                            ->withErrors($e->errors())
                            ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Something went wrong, please try again.')
                            ->withInput();
        }
    }


    public function showEdit($id){
        $user = User::findOrFail($id);

        return view('auth.edit', ['user' => $user]);
    }

    public function edit(Request $request, $id)
    {
        $user = User::with('profile')->findOrFail($id);

        $validated = $request->validate([
            'new_profile' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', 
            'bio' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'current_password' => 'required',
            'password' => 'nullable|string|confirmed|min:8' 
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
        }

        $profileUpdateRequired = false;

        // --- 1. HANDLE PROFILE PICTURE UPLOAD (Conditional) ---
        if ($request->hasFile('new_profile')) {
            $file = $request->file('new_profile');
            $oldProfile = $user->profile;

            $path = 'profiles/'; 
            $extension = $file->getClientOriginalExtension();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $newStorageName = Str::slug($originalName) . '-' . time() . '.' . $extension;

            // Store the new file
            $file->storeAs($path, $newStorageName, 'public');

            // Data for profile record: NEW IMAGE + CURRENT BIO
            $fileData = [
                'profile' => $newStorageName,
                'bio' => $validated['bio'], // Include bio for atomic update
            ];
            
            if ($oldProfile) {
                // FIX: Robust Deletion Logic
                if ($oldProfile->profile) {
                    $fullOldPath1 = $path . $oldProfile->profile; 
                    $fullOldPath2 = $oldProfile->profile;
                    
                    if (Storage::disk('public')->exists($fullOldPath1)) {
                        Storage::disk('public')->delete($fullOldPath1);
                    } elseif (Storage::disk('public')->exists($fullOldPath2)) {
                        Storage::disk('public')->delete($fullOldPath2);
                    }
                }
                
                // Update the existing profile record with both NEW file and BIO data.
                $oldProfile->update($fileData); 
                
            } else {
                // If NO profile exists, create it now, with both NEW file and BIO data.
                $user->profile()->create($fileData);
            }
            
            // Since we updated/created the profile here, we mark bio update as handled
            $profileUpdateRequired = true; 
        }

        // --- 2. HANDLE BIO UPDATE ONLY (If no file was uploaded) ---
        if (!$profileUpdateRequired) {
            if ($user->profile) {
                // Update the bio field on the existing profile record
                $user->profile->bio = $validated['bio'];
                $user->profile->save();
            } else {
                // If no file was uploaded AND no profile record exists, create profile ONLY for bio.
                $user->profile()->create(['bio' => $validated['bio']]);
            }
        }

        // --- 3. HANDLE USER MODEL UPDATE (Always Update) ---
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save(); 

        return redirect()->route('show.home')->with('success', 'Account Info Updated...');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.home');
    }

    public function showProfile($id){
        $user = User::findOrFail($id);

        return view('auth.profile', ["user" => $user]);
    }

    public function blogUsers(){
        $users = User::count();

        return view('blog.blog', compact('users'));
    }

    public function showChatUsers()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('blog.chat', compact('users'));
    }

    public function userChat($id)
    {
        $users = User::where('id', '!=', auth()->id())->get();
        $receiver = User::findOrFail($id);

        return view('blog.chatForm', compact('users', 'receiver'));
    }


}
