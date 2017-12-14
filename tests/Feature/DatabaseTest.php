<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;

class DatabaseTest extends TestCase
{
    use DatabaseMigrations; //Why?

    public function setUp()
    {
        parent::setUp();
        DB::setDefaultConnection(env('DB_CONNECTION_TEST'));
        Artisan::call('migrate'); //Need
    }

    public function test_if_insert_into_database_works()
    {
        DB::insert('');
        $rows = DB::select('select * from facturas');
        $this->assertEquals(1, $rows[0]->id);
        $this->assertTrue(is_array($rows));
        $this->assertInstanceOf(\stdClass::class, $rows[0]);
        $this->assertCount(1, $rows);
    }

    public function test_if_named_bindings_works_when_select()
    {
        DB::insert('');
        $rows = DB::select('');
        $this->assertEquals(1, $rows[0]->id);
        $this->assertEquals(100, $rows[0]->total);
        $this->assertTrue(is_array($rows));
        $this->assertInstanceOf(\stdClass::class, $rows[0]);
        $this->assertCount(5, $rows);
        $this->assertEquals(1, $rows[4]->id);
        $this->assertEquals(300, $rows[4]->total);
    }

    public function test_if_record_can_be_retrieved_by_id()
    {
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 100]);
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 100]);
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 100]);
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 100]);
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 100]);
        $rows = '';
        $this->assertInstanceOf(\stdClass::class, $rows[0]);
        $this->assertCount(1, $rows);
    }

    public function test_if_record_can_be_upated_with_bindings()
    {
        $firstQuery = DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 100]);
        $rows = DB::select();
        $this->assertEquals(1, $rows[0]->id);
        $this->assertEquals(100, $rows[0]->total);
        $updateQuery = '';
        $rows = DB::select();
        $this->assertEquals(1, $rows[0]->id);
        $this->assertEquals(300, $rows[0]->total);
    }

    public function test_if_database_transaction_works()
    {
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 100]);
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 100]);
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 100]);
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 100]);
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 100]);
        //TODO transaction
        $rows = DB::select('select * from facturas');
        $this->assertEquals(200, $rows[0]->total);
    }

    public function test_if_only_one_record_is_deleted()
    {
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 100]);
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 200]);
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 300]);
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 400]);
        DB::insert('insert into facturas(id,total) values (:id,:total)', ['id' => null, 'total' => 500]);
        //TODO DELETE
        DB::delete('');
        $rows = DB::select(''); //TODO SELECT
        $this->assertEquals(500, $rows[0]->total);
        $this->assertEquals(400, $rows[1]->total);
        $this->assertEquals(300, $rows[2]->total);
        $this->assertEquals(200, $rows[3]->total);
        $this->assertCount(4, $rows);
    }

}
