<?php

namespace Tests\Feature;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class SellerTest extends TestCase
{

    /**
     * Test to get check /load endpoint.
     * 
     * POST: /api/load
     */
    public function test_upload()
    {
        //migrate csv code will come here.
    }

    /**
     * Test to get check /sellers endpoint.
     *
     * GET: /api/sellers
     */
    public function test_get_sellers()
    {
        $response = $this->get('/api/sellers');

        $response->assertStatus(200);
    }

    /**
     * Test to get check /sellers/uuid endpoint.
     *
     * GET: /api/sellers/uuid
     */
    public function test_get_seller()
    {
        $response = $this->get('/api/sellers/8a419b28-267f-49c4-b652-d0433d20fef4');

        $response->assertStatus(200);
    }

    /**
     * Test to get check /sellers/uuid/contacts endpoint.
     *
     * GET: /api/sellers/uuid/contacts
     */
    public function test_contacts()
    {
        $response = $this->get('/api/sellers/8a419b28-267f-49c4-b652-d0433d20fef4/contacts');

        $response->assertStatus(200);
    }

    /**
     * Test to get check /sellers/uuid/sales endpoint.
     *
     * GET: /api/sellers/uuid/sale
     */
    public function test_sales()
    {
        $response = $this->get('/api/sellers/8a419b28-267f-49c4-b652-d0433d20fef4/sales');

        $response->assertStatus(200);
    }
}
