<?php

namespace Tests\Feature;

use App\Events\ProductsImported;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Class ProductTest
 * @package Tests\Feature
 */
class ProductTest extends TestCase
{
    public function testProductsImport()
    {
        Storage::fake('public');
        Event::fake();
        $response = $this->postJson('/products/import', ['file' => $file = UploadedFile::fake()->create('test.txt')]);
        $response->assertStatus(Response::HTTP_NO_CONTENT);

        Storage::disk('public')->assertExists('import/' . $file->hashName());
        Storage::disk('public')->assertMissing('missing.txt');

        Event::assertDispatched(ProductsImported::class, function ($event) use ($file) {
            return $event->getPath() === 'import/' . $file->hashName();
        });
    }
}
