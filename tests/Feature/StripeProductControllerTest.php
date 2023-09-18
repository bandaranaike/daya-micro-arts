<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\StripeProductController;
use App\Models\Art;
use App\Services\StripeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Stripe\Collection as StripeCollection;
use Stripe\Exception\ApiErrorException;
use Stripe\Product;
use Stripe\Price;
use Mockery;
use Mockery\MockInterface;

class StripeProductControllerTest extends TestCase
{
    /**
     * @var MockInterface|StripeService
     */
    private $stripeServiceMock;

    /**
     * @var StripeProductController
     */
    private $stripeProductController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->stripeServiceMock = Mockery::mock(StripeService::class);
        $this->stripeProductController = new StripeProductController($this->stripeServiceMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testSaveInDatabaseAllProductsFromStripeSuccess(): void
    {
        $stripeProducts = new StripeCollection([
            new Product([
                'id' => 'product_id_1',
                'name' => 'Product 1',
                'description' => 'Description 1',
                'default_price' => new Price(['id' => 'price_id_1', 'amount' => 1000]),
            ]),
            // Add more products as needed
        ]);

        $this->stripeServiceMock
            ->shouldReceive('make')
            ->once()
            ->andReturn(Mockery::self());

        $this->stripeServiceMock->products = Mockery::mock();
        $this->stripeServiceMock->products
            ->shouldReceive('all')
            ->once()
            ->andReturn($stripeProducts);

        Art::shouldReceive('upsert')
            ->once()
            ->with(Mockery::type('array'), ['product_id', 'price_id']);

        $response = $this->stripeProductController->saveInDatabaseAllProductsFromStripe();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('The price list was successfully updated', $response->getData());
    }

    public function testSaveInDatabaseAllProductsFromStripeError(): void
    {
        $this->stripeServiceMock
            ->shouldReceive('make')
            ->once()
            ->andReturn(Mockery::self());

        $this->stripeServiceMock->products = Mockery::mock();
        $this->stripeServiceMock->products
            ->shouldReceive('all')
            ->once()
            ->andThrow(ApiErrorException::class, 'Stripe API error message');

        $response = $this->stripeProductController->saveInDatabaseAllProductsFromStripe();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(500, $response->getStatusCode());
        $this->assertSame('Stripe API error message', $response->getData());
    }
}
