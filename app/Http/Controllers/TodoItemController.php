<?php

namespace App\Http\Controllers;

use App\TodoItem;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class TodoItemController
 * @package App
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
        return TodoItem::all();
    }

    public function find(TodoItem $item)
    {
        return $item;
    }

    public function create(Request $request)
    {
        $item = TodoItem::create($request->all());

//        dd(Auth::user());
//        $item->user = Auth::user();


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
