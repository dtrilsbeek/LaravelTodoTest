<?php

namespace App\Http\Controllers;

use App\TodoItem;
use Illuminate\Http\Request;

class TodoItemController extends Controller
{
    public function all()
    {
        return TodoItem::all();
    }

    public function find(TodoItem $item)
    {
        return $item;
    }

    public function create(Request $request)
    {
        $item = TodoItem::create($request->all());

        return response()->json($item, 201);
    }

    public function update(Request $request, TodoItem $item)
    {
        $item->update($request->all());

        return response()->json($item, 200);
    }

    public function delete(TodoItem $item) {
        $item->delete();

        return response()->json(null, 204);;
    }
}
