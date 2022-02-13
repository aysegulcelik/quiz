<?php

namespace Database\Factories;
use App\Models\quiz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class QuizFactory extends Factory
{

    protected $model=quiz::class;
    public function definition()
    {  $title=$this->faker->sentence(rand(3,7));
        return [
           'title'=>$title,
            'slug'=>Str::slug($title),
            'description'=>$this->faker->text(200),

        ];
    }
}
