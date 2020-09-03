<?php

namespace App\Http\Controllers;

use App\TodoItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class TodoItemController
 * @package App
 * @mixin \Eloquent
 */
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
        $item->user = $request->getUser();



        return response()->json($item, Response::HTTP_CREATED);
    }

    public function update(Request $request, TodoItem $item)
    {
        $item->update($request->all());

        return response()->json($item, Response::HTTP_OK);
    }

    public function delete(TodoItem $item) {
        $item->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
