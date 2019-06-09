<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class RestaurantsController extends Controller {

    const MODEL = "App\Restaurant";

    use RESTActions;

    /**
     * Show a list of all restaurants
     * Orderby openings state desc, popularity desc, name asc 
     *
     * @return Response
     */
    public function index()
    {
        $restaurants = DB::table('restaurants')->orderByRaw("open desc, popularity desc, name")->get();

        return $this->respond(Response::HTTP_OK, $restaurants);
    }
}
