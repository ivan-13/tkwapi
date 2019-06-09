<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RestaurantsController extends Controller
{
    const MODEL = "App\Restaurant";

    use RESTActions;

    /**
     * Show a list of all restaurants
     * Orderby openings state desc, popularity desc, name asc 
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $query = DB::table('restaurants');
        
        if($request->has('open') && $request->filled('open') && is_numeric($request->get('open'))) {
            $query = $query->where('open', (int) $request->get('open'));
        }
        
        $query = $query->orderByRaw("open desc, popularity desc, name");
        
        $restaurants = $query->get();

        return $this->respond(Response::HTTP_OK, $restaurants);
    }
}
