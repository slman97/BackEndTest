<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\productUserDataTable;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(productUserDataTable $dataTable)
    {
        
        return $dataTable->render("product.index");
    }

}
