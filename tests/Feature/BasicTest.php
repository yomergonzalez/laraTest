<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class BasicTest extends TestCase
{
    /**
     * Root route must redirect to publication
     *
     * @return void
     */
    public function test_redirect_to_publication()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/publication');
    }

    
    /**
     * Publication route must redirect to  publications
     *
     * @return void
     */
    public function test_user_logged()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->get('/');

        $response->assertRedirect('/publication');

    }

    /**
     * test validation
     *
     * @return void
     */
    public function test_new_publication_error_validation()
    {
        $response = $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->post('/publication', ['titldde' => 'titulo']);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'content']);

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->post('/publication', ['content' => 'titulo']);

        $response->assertSessionDoesntHaveErrors(['content']);

    }

    /**
     * store a new publication without error
     *
     * @return void
     */
    public function test_new_publication_success()
    {
        $response = $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->post('/publication', ['title' => 'titulo', 'content'=>'asasas']);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/publication');

    }
}
