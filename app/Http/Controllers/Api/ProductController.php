<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserToken;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Show the form to create a new blog post.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return response()->json(array(
            ['id' => 1, 'name' => 'Product Name 1'],
            ['id' => 2, 'name' => 'Product Name 2'],
            ['id' => 3, 'name' => 'Product Name 3'],
            ['id' => 4, 'name' => 'Product Name 4'],
            ['id' => 5, 'name' => 'Product Name 5'],
            ['id' => 6, 'name' => 'Product Name 6'],
            ['id' => 7, 'name' => 'Product Name 7'],
            ['id' => 8, 'name' => 'Product Name 8'],
            ['id' => 9, 'name' => 'Product Name 9'],
            ['id' => 10, 'name' => 'Product Name 10'],
            ['id' => 11, 'name' => 'Product Name 11'],
            ['id' => 12, 'name' => 'Product Name 12'],
            ['id' => 13, 'name' => 'Product Name 13'],
            ['id' => 14, 'name' => 'Product Name 14'],
            ['id' => 15, 'name' => 'Product Name 15'],
        ));
    }
}
