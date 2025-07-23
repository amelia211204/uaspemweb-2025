<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Menu::all()
        ]);
    }
}
