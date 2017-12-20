<?php

namespace Tests\Feature;

use App\Author;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Book;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;

class EloquentTest extends TestCase
{
    use DatabaseMigrations; //Why?

    public function setUp()
    {
        parent::setUp();
        DB::setDefaultConnection(env('DB_CONNECTION_TEST'));
        Artisan::call('migrate'); //Need
    }

    public function test_if_active_record_works()
    {
        //TODO
        $this->assertInstanceOf(Book::class, $book);
        $this->assertEquals('Leviatán', $book->name);
        $saved = $book->save();
        $this->assertEquals(1, $book->id);
        $this->assertTrue($saved);
    }

    public function test_if_create_insert_works()
    {
        $book = Book::create(['name' => 'Bóvedas de acero']); //ONLY CHANGE THIS ROW
        $this->assertInstanceOf(Book::class, $book);
        $this->assertEquals('Bóvedas de acero', $book->name);
        $this->assertEquals(2017, $book->edition);
        $this->assertEquals(100, $book->pages);
    }


    public function test_if_firstorcreate_insert_works()
    {
        $book = new Book();
        $book->name = 'Bóvedas de acero';
        $book->save();
        $newBook = Book::create(['name' => 'Bóvedas de acero']); //ONLY CHANGE THIS ROW
        $this->assertFalse($newBook->wasRecentlyCreated);
        $this->assertInstanceOf(Book::class, $newBook);
        $savedRecord = Book::find(1);
        $this->assertEquals(1, $savedRecord->id);
    }

    public function test_if_firstornew_insert_works()
    {
        $book = new Book();
        $book->name = 'Bóvedas de acero';
        $book->save();
        $newBook = Book::create(['name' => 'Bóvedas de acero']); //TODO CHANGE THIS ROW
        $this->assertEquals(1, $newBook->id);
        $this->assertInstanceOf(Book::class, $newBook);
        $this->assertEquals('Bóvedas de acero', $book->name);
        $newBook->name = 'Bóvedas de acero - reloaded';
        $saved = 'TODO'; // TODO ACTIVE RECORD SAVING
        $this->assertTrue($saved);
        $record = Book::find(1);
        $this->assertEquals('Bóvedas de acero - reloaded', $record->name);
    }

    public function test_if_record_is_updated_with_active_record()
    {
        $book = new Book();
        $book->name = 'Bóvedas de acero';
        $book->save();
        $recordToUpdate = 'TODO'; //TODO
        $recordToUpdate->name = 'Yo robot';
        $recordToUpdate->save();
        $this->assertEquals('Yo robot', $recordToUpdate->name);
    }

    public function test_if_record_is_updated_with_db_update()
    {
        $book = new Book();
        $book->name = 'Bóvedas de acero';
        $book->save();

        $this->assertEquals(null, $book->edition);

        $updated = Book::where('id', 1); //TODO FIX THIS LINE

        $recordToUpdate = Book::find(1);

        $this->assertEquals('Fundación', $recordToUpdate->name);
        $this->assertEquals(1999, $recordToUpdate->edition);
    }

    public function test_if_record_is_deleted()
    {
        $book = new Book();
        $book->name = 'Bóvedas de acero';
        $book->save();

        $this->assertEquals(1, $book->id);

        $deleted = 'TODO'; //TODO DELETE

        $retrievedBook = 'TODO'; //TODO Record lookup

        $this->assertEquals(null, $retrievedBook);
        $this->assertTrue($deleted);

    }

    public function test_if_a_book_belongs_to_an_author()
    {
        $book = new Book();
        $book->name = 'Yo robot';
        $book->author()->associate(Author::create(['name' => 'Asimov']));
        $book->save();
        $this->assertEquals('Asimov', $book->author->name);
        $this->assertEquals(1, $book->id);
        $this->assertEquals(1, $book->author->id);
    }

    public function test_if_a_book_cab_be_deassociated_to_an_author()
    {
        $book = new Book();
        $book->name = 'Yo robot';

        $author = Author::create(); //TODO

        $book->author()->associate($author);
        $book->save();
        $this->assertEquals('Asimov', $book->author->name);
        $this->assertInstanceOf(Author::class, $book->author);
        $this->assertEquals(1, $book->id);
        $this->assertEquals(1, $book->author->id);

        $book->author()->dissociate($author);
        $this->assertNotInstanceOf(Author::class, $book->author);

    }

    public function test_if_book_can_be_appended_to_an_author_with_create()
    {
        $author = Author::create(['name' => 'Paul Auster']);

        $author->books()->create(); //TODO

        $books = $author->books;

        $this->assertEquals('Leviatán', $books[0]->name);
    }


    public function test_if_book_can_be_appended_to_an_author_with_createmany()
    {
        $author = Author::create(['name' => 'Paul Auster']);

        $author->books()->createMany(); //TODO

        $books = $author->books;

        $this->assertEquals('Leviatán', $books[0]->name);
        $this->assertEquals('Mr Vertigo', $books[1]->name);
    }

    public function test_if_book_instance_can_be_added_with_save()
    {
        $book = new Book(['name' => 'Las travesuras de la niña mala']);

        $author = Author::create(['name' => 'Mario Vargas Llosa']);

        $author->books()->save(); //TODO

        $books = ''; //TODO

        $this->assertEquals('Las travesuras de la niña mala', $books[0]->name);

    }

    public function test_if_book_instance_can_be_added_with_savemany()
    {
        $author = Author::create(['name' => 'Mario Vargas Llosa']);

        $book2 = new Book();
        $book2->name = 'La casa verde';

        $author->books()->saveMany(
            [new Book(['name' => 'Las travesuras de la niña mala']),
                '' //TODO
            ]
        );

        $books = ''; //TODO

        $this->assertEquals('Las travesuras de la niña mala', $books[0]->name);
        $this->assertEquals('La casa verde', $books[1]->name);

    }

}
