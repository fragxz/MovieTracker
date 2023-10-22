<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class FilmControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_read_method_returns_dashboard_view()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
    }

    public function test_search_method_returns_search_results()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/search-film/', ['search_film' => 'Inception']);

        $response->assertStatus(200);
        $response->assertViewIs('search');
    }

    public function test_create_method_creates_new_film_and_redirects()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $title = 'Inception';
        $imdbID = 'tt1375666';

        $filmData = [
            'imdbID' => $imdbID,
            'title' => $title,
            'year' => '2023',
            'type' => 'movie',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_SX300.jpg'
        ];

        $response = $this->post('/add-film', $filmData);

        $response->assertRedirect();
        $response->assertSessionHas('success_create', $title);

        $this->assertDatabaseHas('films', ['imdb_id' => $imdbID]);
    }
}
