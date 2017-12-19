<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EloquentTest extends TestCase
{
    public function test_if_active_record_works()
    {
        //TODO
        $book = '';
        $this->assertInstanceOf(App\Book::class, $book);
        $this->assertEquals(1, $book->id);
        $this->assertEquals('Leviatán', $book->name);
    }
}
