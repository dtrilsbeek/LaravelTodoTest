<?php

namespace Http\Controllers;

use App\Http\Controllers\TodoItemController;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class TodoItemControllerTest extends TestCase
{
    public function testCreate()
    {
        Event::fake();

        $request = Request::create('/todo-items', 'POST', [
            'title' => 'Test Request from Unit Test',
            'body' => 'Test request from unit tests body content',
            'user_id' => '1'
        ]);

        $controller = new TodoItemController();

        try {
            $response = $controller->create($request);
        } catch (ValidationException $exception) {
            echo $exception->getMessage();
        }
        $json = json_decode($response->content());

        $this->assertSame($request->get('title'), $json->title);
    }
}
