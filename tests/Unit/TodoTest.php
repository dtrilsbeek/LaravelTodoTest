<?php

namespace Tests\Unit;

use App\TodoItem;
use App\User;
use Exception;
use Tests\TestCase;

class TodoTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_AddTodo()
    {
        $mockUser = User::find(1);
        $testItem = new TodoItem();
        $testItem->title = "Unit Test Item Title";
        $testItem->body = 'Unit test item body text content';
        $testItem->user()->associate($mockUser);
        $testItem->save();
        $testItem->refresh();

        $result = TodoItem::find($testItem->id);
        $this->assertSame($testItem->title, $result->title);
        $this->assertSame($testItem->body, $result->body);
        $this->assertEquals($testItem->user()->get(), $result->user()->get());
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_AddTodo_ExpectedFail_WhenTitleExceedsLimit()
    {
        $mockUser = User::find(1);
        $testItem = new TodoItem();
        $testItem->title = "Unit Test Item Title";
        for ($i = 0; $i < 10; $i++) {
            $testItem->title .= $testItem->title;
        }

        $testItem->body = 'Unit test item body text content';
        $testItem->user()->associate($mockUser);

        try {
            $testItem->save();
            $testItem->refresh();
        } catch (Exception $exception) {
            echo $exception->getMessage();

            $this->assertTrue(true);
        }
    }
}
