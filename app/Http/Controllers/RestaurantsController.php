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
                if(!Schema::hasColumn('restaurants', ltrim($column, '-'))) continue;
                if('open' == ltrim($column)) $open = true;
                $direction = $column[0] == '-' ? 'desc' : 'asc';
                $query->orderBy(ltrim($column, '-'), $direction);
            }
        } else {
            $query = $query->orderByRaw("open desc, popularity desc, name");
        }
        
        $restaurants = $query->get();

        return $this->respond(Response::HTTP_OK, $restaurants);
    }
}
