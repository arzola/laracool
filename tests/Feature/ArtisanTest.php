<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArtisanTest extends TestCase
{

    /**
     * @test
     */
    public function check_if_artisan_command_works()
    {
        $command = '';
        $this->assertTrue(password_verify($command, '$2y$10$SpmZat5SJSU3P2UQwTVYuuwBbG89Do0dqXtP1xbTfVrvVkQCAUnKq'));
    }

    /**
     * @test
     */
    public function check_if_hellocontroller_is_created()
    {
        $command = ''; //Crear un controller HelloController
        $this->assertTrue(password_verify($command, '$2y$10$HShLvZToI73Zo/5WmejMMu1aUMDPlmtM7f8Bu9Mfv0j7cVkk2Jhe.'));
    }

    /**
     * @test
     */
    public function check_if_phonecontroller_is_created_with_an_associated_model_with_short_flag()
    {
        $command = ''; //Crear un Resource controller PhoneController con un modelo asociado por default llamado Phone
        $this->assertTrue(password_verify($command, '$2y$10$C0YhMXfUO.aQkWD6JebAjuWBR1H7yS7ktZnJf/4bPqi9z2JZl/zWW'));
    }

    /**
     * @test
     */
    public function check_if_phonecontroller_is_created_with_an_associated_model_with_large_flag()
    {
        $command = ''; //Crear un Resource controller PhoneController con un modelo asociado por default llamado Phone
        $this->assertTrue(password_verify($command, '$2y$10$RL8vvzkGaZ8fC/u/uwQf7ejX6da0nH.sYrI5FDZOWtQeE2tLWxOfO'));
    }


    /**
     * @test
     */
    public function check_if_videocontroller_is_created_as_a_resource_controller()
    {
        $command = ''; //Crear un Resource controller VideoController
        $this->assertTrue(password_verify($command, '$2y$10$boitgvAzJwXiMKM1w4yUmeN/6sV2p51TZT89ilZRZRcX8WBZCpq62'));
    }

    /**
     * @test
     */
    public function check_test_command_to_create_a_feature_test()
    {
        $command = ''; //Crear un Feature test llamado FeatureTest
        $this->assertTrue(password_verify($command, '$2y$10$OAiu0pYAeaCpy5OKXSQRIe7GI4/wydsZfK5bL0n1mKf2kJ4e1BOI6'));
    }

    /**
     * @test
     */
    public function check_test_command_to_create_a_unit_test()
    {
        $command = ''; //Crear un test unitario llamado FeatureTest
        $this->assertTrue(password_verify($command, '$2y$10$q/Sb4KX2YT3QAi978XVFS.0pOE5aYYKadBNnvD1cLM6ujKSocWHzu'));
    }



}
