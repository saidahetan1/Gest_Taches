<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $todos = Auth::user()->todos()->latest()->paginate(6);

        return view('users.dashboard', ['todos' => $todos]);
    }

    public function userTodos(User $user)
    {

        $userTodos = $user->todos()->latest()->paginate(6);

        return view('users.todos', [
            'todos' => $userTodos,
            'user' => $user
        ]);
    }
}
