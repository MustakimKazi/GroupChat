<?php

namespace App\Http\Controllers;

use App\Models\Message; 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function index()
{
    // Get latest 50 messages with user data
    $messages = Message::with('user')->latest()->take(50)->get()->reverse();

    // All users who ever sent a message
    $messageUsers = User::whereIn('id', $messages->pluck('user_id')->unique())->get();

    // Current logged-in user
    $currentUser = Auth::user();

    // Pass all data to the view
    return view('index', compact('messages', 'messageUsers', 'currentUser'));
}


    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->route('chat.index');
    }
    public function clearChat()
{
    Message::truncate(); // delete all messages
    return redirect()->route('chat.index')->with('success', 'All messages deleted.');
}

    // Display form to create user
    public function create()
    {
        return view('viii');
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'phone' => 'string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
        ]);

        return redirect()->route('users_create')->with('success', 'User created successfully.');
    }
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    // Check plain password directly (⚠️ not secure)
    if ($user && $user->password === $request->password) {
        \Auth::login($user);
        return redirect()->route('index.page');
    }

    return redirect()->back()->with('error', 'Invalid email or password');
}




    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
    
}
