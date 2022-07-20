<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Locale;
use App\Models\Meal;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $this->call([
            //TagSeeder::class,
            CategoriesSeeder::class,
            //IngredientsSeeder::class,
            MealsSeeder::class,
            LocaleSeeder::class,
        ]);

        $locales = Locale::all();
        $meals = Meal::all();
        $tags = Tag::all();
        $ingredients = Ingredient::all();
        $categories = Category::all();

        foreach ($locales as $locale){
            foreach ($meals as $meal){
                DB::table('meal_translations')->insert([
                    'title' => $locale->code . '-' . $faker->word,
                    'description' => $locale->code . '-' . $faker->text,
                    'locale' => $locale->id,
                    'meal_id' => $meal->id,
                ]);
            }
            foreach ($tags as $tag){
                DB::table('tag_translations')->insert([
                    'title' => $locale->code . '-' . $faker->word,
                    'locale' => $locale->id,
                    'tag_id' => $tag->id,
                ]);
            }
            foreach ($ingredients as $ingredient){
                DB::table('ingredient_translations')->insert([
                    'title' => $locale->code . '-' . $faker->word,
                    'locale' => $locale->id,
                    'ingredient_id' => $ingredient->id,
                ]);
            }
            foreach ($categories as $category){
                DB::table('category_translations')->insert([
                    'title' => $locale->code . '-' . $faker->word,
                    'locale' => $locale->id,
                    'category_id' => $category->id,
                ]);
            }

        }

    }
}
