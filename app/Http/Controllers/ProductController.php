<?php

namespace App\Http\Controllers;

use App\Events\ProductsImported;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * @param Request $request
     *
     * @return ResponseFactory|Response
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimetypes:text/plain'
        ]);

        $path = request()->file('file')->store('import', 'public');

        event(new ProductsImported($path));

        return response([], Response::HTTP_NO_CONTENT);
    }
}
