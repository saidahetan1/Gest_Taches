<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

//use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public static function middleware(): array
    {
        return [
            new Middleware(['auth', 'verified'], except: ['index', 'show']),
        ];
    }
    public function index()
    {
        //
        
        $todos = Todo::latest()->paginate(6);

        return view('todos.index', ['todos' => $todos]);
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
        // Validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required'],
          
        ]);

    
      
        // Create a post
        $todo = Auth::user()->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
           
        ]);

        // Send email when users create a post (for practice)
        // Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(), $post));

        // Redirect back to dashboard
        return back()->with('success', 'Your post was created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return view('todos.show', ['todo' => $todo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
         // Authorizing the action
         Gate::authorize('modify', $todo);

         return view('todos.edit', ['todo' => $todo]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
         // Authorizing the action
         Gate::authorize('modify', $todo);

         // Validate
         $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required'],
         ]);
 
        
         // Update the post
         $todo->update([
            'title' => $request->title,
            'description' => $request->description,
         ]);
 
         // Redirect to dashboard
         return redirect()->route('dashboard')->with('success', 'Your task was updated.');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
         // Authorizing the action
         Gate::authorize('modify', $todo);

         
        
 
         // Delete the todo$todo
         $todo->delete();
 
         // Redirect back to dashboard
         return back()->with('delete', 'Your $todo was deleted!');
        //
    }
}
