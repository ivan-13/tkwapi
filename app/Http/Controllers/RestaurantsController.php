<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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

        if($request->has('s') && $request->filled('s')) {
            $query = $query->where('name', 'like', '%' . $request->get('s') . '%');
        }

        if($request->has('sort') && $request->filled('sort')) {
            $columns = explode(',', $request->get('sort'));

            if(!in_array('open', $columns)) $query->orderBy('open', 'desc');
            
            foreach($columns as $column) {
                $direction = $column[0] == '-' ? 'desc' : 'asc';
                $column = ltrim($column, '-');
                if(!Schema::hasColumn('restaurants', $column)) continue;
                if(in_array($column, ['averageProductPrice', 'deliveryCosts', 'minimumOrderAmount'])) {
                    // we need this to properly sort float values which had to be imported as string
                    $column = $column . '+0.0';
                }
                $query->orderByRaw("$column $direction");
            }
        } else {
            $query = $query->orderByRaw("open desc, popularity desc, name");
        }
        
        $restaurants = $query->get();

        // this logic assumes Android app version is sent via request header so it can be used to change the 'name' tag in the response
        if(false !== strpos($request->header('User-Agent'), 'Android') && false !== strpos($request->header('User-Agent'), '5.12.300')) {
            $restaurants = $restaurants->toArray();
            foreach($restaurants as &$restaurant) {
                $keys = array_keys((array) $restaurant);
                if(false != $nameTag = array_search('name', $keys)) {
                    $keys[$nameTag] = 'restaurantName';
                    $restaurant = array_combine($keys, (array) $restaurant);
                }
            }
        }

        return $this->respond(Response::HTTP_OK, $restaurants);
    }
}
