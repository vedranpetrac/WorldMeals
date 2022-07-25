<?php

namespace App\Http\Controllers;

use App\Filters\MealsFilter;
use App\Http\Requests\MealIndexRequest;
use App\Http\Resources\MealCollection;
use App\Http\Resources\TagResource;
use App\Models\Meal;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Services\JsonDetailsService;
use Carbon\Carbon;


class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param MealIndexRequest $request
     * @return MealCollection
     */
    public function index(MealIndexRequest $request)
    {

        $validated = $request->validated();

        $langServiceLocale = new LanguageService();
        App::setLocale($langServiceLocale->getLanguage($request));

        $jsonService = new JsonDetailsService();
        $mealsFilter = new MealsFilter();

        $mealsFilterTags = $mealsFilter->getSelectedTagsList($request);

        $meals = Meal::where($mealsFilter->getSelectedCategory($request));

        if($mealsFilterTags !== null){
            $meals = $meals->whereHas('tags', function ($query) use($mealsFilterTags) {
                $query->where('meal_tag.tag_id',$mealsFilterTags);
            });
        }

        if($jsonService->expand($request) != null){
            $meals->with($jsonService->expand($request));
        }

        if($mealsFilter->getTimestamp($request) != null){
            $meals = $meals->withTrashed();
            Log::info($mealsFilter->getTimestamp($request));
            $cDate = Carbon::createFromTimestamp($mealsFilter->getTimestamp($request))->toDateTimeString();
            $meals = $meals->where(function ($query) use ($cDate) {
                $query->whereDate('created_at','>',$cDate)
                    ->orWhereDate('updated_at','>',$cDate)
                    ->orWhereDate('deleted_at','>',$cDate);
            });

        }

        return new MealCollection($meals->paginate($perPage = $jsonService->definePerPage($request))->appends($request->query()));


    }


}
