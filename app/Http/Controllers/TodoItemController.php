<?php

namespace App\Http\Controllers;

use App\TodoItem;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class TodoItemController.
 * @mixin Eloquent
 * @mixin Builder
 */
class TodoItemController extends Controller
{
    public function __construct()
    {
    }

    public function all()
    {
        return TodoItem::with('user')->get();
    }

    public function find(TodoItem $item)
    {
        return $item;
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'max:255',
            'body'=> 'required',
        ]);

        $item = new TodoItem($request->all());
        $item->user()->associate(Auth::user());
        $item->save();
        $item->refresh();

        return response()->json($item, Response::HTTP_CREATED);
    }

    public function update(Request $request, TodoItem $item)
    {
        $item->update($request->all());

        return response()->json($item, Response::HTTP_OK);
    }

    public function delete(TodoItem $item)
    {
        $item->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
