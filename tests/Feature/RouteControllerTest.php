<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RouteControllerTest extends TestCase
{
    public function test_if_controller_instance_is_setup()
    {
        $response = $this->get('/photos');
        $response->assertStatus(200);
        $currentAction = Route::currentRouteAction();
        $this->assertTrue(str_contains($currentAction,'Photos@'));
    }

}
