<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class HttpMethodsTest extends TestCase
{º
    public function test_if_get_method_works()
    {
        $response = $this->get('/helloworld');
        $response->assertStatus(200);
        $response->assertDontSee('<body>');
        $response->assertSeeText('Hello World');
    }

    public function test_if_get_method_with_one_param_works()
    {
        $str = str_random(10);
        $response = $this->get("/helloworld/$str");
        $response->assertStatus(200);
        $response->assertDontSee('<body>');
        $response->assertSeeText("Hello $str");
    }

    public function test_if_post_method_works()
    {
        Session::start();
        $response = $this->post('/hellopost',
            [
                'name' => 'os',
                '_token' => csrf_token()
            ]);
        $response->assertStatus(200);
        $response->assertSeeText('Hello new os');
    }

    public function test_if_put_method_works()
    {
        Session::start();
        $response = $this->put('/users/1', [], ['X-CSRF-TOKEN' => csrf_token()]);
        $response->assertStatus(200);
        $response->assertSeeText('Updated 1');
    }

    public function test_if_delete_method_works()
    {
        $this->withoutMiddleware();
        $response = $this->delete('/users/1');
        $response->assertStatus(200);
        $response->assertSeeText('Bye put 1');
    }

}
