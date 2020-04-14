<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Product;
use App\UseCases\Product\DTO\ParseResult;
use App\UseCases\Product\Exception\CollectionNotMatchedException;
use App\UseCases\Product\ProductParserService;
use App\UseCases\Product\ProductManageService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class ProductParserServiceTest
 * @package Tests\Unit
 */
class ProductParserServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @dataProvider providerProducts
     *
     * @param $product
     */
    public function testParsingProducts($product)
    {
        // Parse features
        /** @var ParseResult $result */
        try {
            $result = app(ProductParserService::class)->parse($product);
            $this->assertInstanceOf(ParseResult::class, $result);
            app(ProductManageService::class)->saveParsedProducts($product, $result);

            $this->assertDatabaseHas('products', ['name' => $product, 'status' => Product::IMPORT_SUCCESS]);
            $this->assertDatabaseHas('attributes', $result->getAttributes());
            $this->assertNotNull($result->getAttributes());

            foreach ($result->getAttributes() as $attribute) {
                $this->assertStringContainsString($attribute, $product);
            }
        } catch (CollectionNotMatchedException $e) {
            app(ProductManageService::class)->saveParsedProducts($product);
            $this->assertDatabaseHas('products', ['name' => $product, 'status' => Product::IMPORT_FAILURE]);
        }
    }

    /**
     * @return array
     */
    public function providerProducts(): array
    {
        return [
            1  => ['Nokian Hakkapeliitta R2 SUV 205/70 R15 100R TT  Летние'],
            2  => ['Toyo H08 195/75R16C 107/105S TL Летние'],
            3  => ['Pirelli Winter SnowControl serie 3 175/70R14 84T TL Зимние (нешипованные)'],
            4  => ['BFGoodrich Mud-Terrain T/A KM2 235/85R16 120/116Q TL Внедорожные'],
            5  => ['Pirelli Scorpion Ice & Snow 265/45R21 104H TL Зимние (нешипованные)'],
            6  => ['Pirelli Winter SottoZero Serie II 245/45R19 102V XL Run Flat * TL Зимние (нешипованные)'],
            7  => ['Nokian Hakkapeliitta R2 SUV/Е 245/70R16 111R XL TL Зимние (нешипованные)'],
            8  => ['Pirelli Winter Carving Edge 225/50R17 98T XL TL Зимние (шипованные)'],
            9  => ['Continental ContiCrossContact LX Sport 255/55R18 105H FR MO TL Всесезонные'],
            10 => ['BFGoodrich g-Force Stud 205/60R16 96Q XL TL Зимние (шипованные)'],
            11 => ['BFGoodrich Winter Slalom KSI 225/60R17 99S TL Зимние (нешипованные)'],
            12 => ['Continental ContiSportContact 5 245/45R18 96W SSR FR TL Летние'],
            13 => ['Continental ContiWinterContact TS 830 P 205/60R16 92H SSR * TL Зимние (нешипованные)'],
            14 => ['Continental ContiWinterContact TS 830 P 225/45R18 95V XL SSR FR * TL Зимние (нешипованные)'],
            15 => ['Hankook Winter I*Cept Evo2 W320 255/35R19 96V XL TL/TT Зимние (нешипованные)'],
            16 => ['Mitas Sport Force+ 120/65R17 56W TL Летние'],
        ];
    }
}
