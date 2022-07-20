<?php

namespace App\Http\Controllers;

use App\Filters\MealsFilter;
use App\Http\Resources\MealCollection;
use App\Http\Resources\TagResource;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Services\JsonDetailsService;


class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return MealCollection
     */
    public function index(Request $request)
    {

        $jsonService = new JsonDetailsService();
        $mealsFilter = new MealsFilter();

        $mealsFilterTags = $mealsFilter->getSelectedTagsList($request);

        $meals = Meal::where($mealsFilter->getSelectedCategory($request));

        if($mealsFilterTags !== null){
            $meals = $meals->whereHas('tags', function ($query) use($mealsFilterTags) {
                $query->WhereIn('meal_tag.tag_id',$mealsFilterTags);
            });
        }

        if($jsonService->expand($request) != null){
            $meals->with($jsonService->expand($request));
        }

        if($mealsFilter->getTimestamp($request) != null){
            $meals = $meals->withTrashed();
            $meals = $meals->whereOr([['created_at','>',$mealsFilter->getTimestamp($request)],['updated_at','>',$mealsFilter->getTimestamp($request)],['deleted_at','>',$mealsFilter->getTimestamp($request)]]);
        }

        return new MealCollection($meals->paginate($perPage = $jsonService->definePerPage($request))->appends($request->query()));


    }


}
