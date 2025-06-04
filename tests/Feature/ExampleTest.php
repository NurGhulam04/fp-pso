<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test the /dashboard route.
     *
     * @return void
     */
    public function test_dashboard_route()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }

    /**
     * Test the /authors route.
     *
     * @return void
     */
    public function test_authors_route()
    {
        $response = $this->get('/authors');
        $response->assertStatus(200);
    }

    /**
     * Test the /publishers route.
     *
     * @return void
     */
    public function test_publishers_route()
    {
        $response = $this->get('/publishers');
        $response->assertStatus(200);
    }

    /**
     * Test the /books route.
     *
     * @return void
     */
    public function test_books_route()
    {
        $response = $this->get('/books');
        $response->assertStatus(200);
    }

    /**
     * Test the /reports route.
     *
     * @return void
     */
    public function test_reports_route()
    {
        $response = $this->get('/reports');
        $response->assertStatus(200);
    }

    /**
     * Test the /students route.
     *
     * @return void
     */
    public function test_students_route()
    {
        $response = $this->get('/students');
        $response->assertStatus(200);
    }

    /**
     * Test the /book_issue route.
     *
     * @return void
     */
    public function test_book_issue_route()
    {
        $response = $this->get('/book_issue');
        $response->assertStatus(200);
    }
}
