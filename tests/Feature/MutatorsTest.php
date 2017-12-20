<?php

namespace Tests\Feature;

use App\Invoice;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class MutatorsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        DB::setDefaultConnection(env('DB_CONNECTION_TEST'));
        Artisan::call('migrate'); //Need
    }

    public function test_if_total_is_retrieved_as_number_format()
    {
        $invoice = new Invoice();
        $invoice->total = 1000;
        $invoice->save();

        $savedInvoice = Invoice::find(1);

        $this->assertEquals('$ 1,000', $savedInvoice->total);
    }

    public function test_if_total_is_saved_as_clean_float()
    {
        $invoice = new Invoice();
        $invoice->subtotal = "$ 1,000";
        $invoice->save();

        $savedInvoice = Invoice::find(1);

        $this->assertSame(1000.0, $savedInvoice->subtotal);
    }

    public function test_if_valueobject_is_returned_instead_of_raw_value()
    {
        $invoice = new Invoice();
        $invoice->price = 1000;
        $invoice->save();

        $savedInvoice = Invoice::find(1);

        $this->assertInstanceOf(\App\Money::class, $savedInvoice->price);
        $this->assertEquals("1,000", $savedInvoice->price);

        $this->assertEquals('$ 1,000', $savedInvoice->price->formatted());
        $this->assertEquals('Expensive', $savedInvoice->price->evaluation());

        $invoice = new Invoice();
        $invoice->price = 500;
        $invoice->save();

        $savedInvoice = Invoice::find(2);

        $this->assertEquals('$ 500', $savedInvoice->price->formatted());
        $this->assertEquals('Cheap', $savedInvoice->price->evaluation());

    }

    public function test_if_scope_works()
    {
        $invoice = new Invoice();
        $invoice->price = 600;
        $invoice->save();
        $invoice2 = new Invoice();
        $invoice2->price = 501;
        $invoice2->save();
        $invoice3 = new Invoice();
        $invoice3->price = 400;
        $invoice3->save();
        $invoice4 = new Invoice();
        $invoice4->price = 500;
        $invoice4->save();
        $invoices = Invoice::expensive()->get();
        $this->assertCount(2, $invoices);
    }

    public function test_if_scope_with_param_works()
    {
        $invoice = new Invoice();
        $invoice->price = 600;
        $invoice->save();
        $invoice2 = new Invoice();
        $invoice2->price = 501;
        $invoice2->save();
        $invoice3 = new Invoice();
        $invoice3->price = 400;
        $invoice3->save();
        $invoice4 = new Invoice();
        $invoice4->price = 500;
        $invoice4->save();
        $invoices = Invoice::expensive(600)->get();
        $this->assertCount(1, $invoices);
    }

    public function test_if_event_is_triggered()
    {
        User::create(['name' => 'Oscar', 'email' => 'os@icode.mx', 'password' => 12345]);
    }

}
