<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TodoResource;
use App\Models\Category;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = auth()->user()
            ->todos()
            ->latest()
            ->with('category')      // executes only 2 Querys
            ->where(function ($query) {
                if ($search = request()->search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('category', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                }
            })
            ->paginate(5)
            ->withQueryString();

        return inertia('Todo/Index', [
          'todos' => TodoResource::collection($todos),
          'query' => (object) request()->query()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Todo/Create', [
          'categories' => CategoryResource::collection(Category::orderBy('name')->get())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $request->user()->todos()->create([
            'name' => $request->name,
            'prior' => $request->prior,
            'erledigt' => $request->erledigt ? 1 : 0,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);
        return redirect()
          ->route('todos.index')
          ->with('message', 'Todo has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return inertia('Todo/Show', [
          'todo' => TodoResource::make($todo)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return inertia('Todo/Edit', [
          'categories' => CategoryResource::collection(Category::orderBy('name')->get()),
          'todo' => TodoResource::make($todo)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo->update([
            'name' => $request->name,
            'prior' => $request->prior,
            'erledigt' => $request->erledigt ? 1 : 0,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);
        return redirect()
          ->route('todos.index')
          ->with('message', 'Todo has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()
          ->route('todos.index')
          ->with('message', 'Todo has been deleted successfully.');
    }
}
