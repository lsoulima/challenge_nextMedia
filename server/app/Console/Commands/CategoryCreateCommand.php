<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Validator;
use Illuminate\Console\Command;
use App\Models\Category;

class CategoryCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create {--name=} {--parent=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a new Category';


    public function handle()
    {
        $name = $this->option('name');
        $parent = $this->option('parent');

        $userInputs = [
            'name' => $name,
            'parent_category' => $parent,
        ];

        $validator = Validator::make($userInputs, [
            'name' => ['required', 'unique:categories', 'max:255'],
            'parent_category' => 'nullable|exists:categories,id'
        ]);

        if ($validator->fails()) {
            $this->info('Category not created. See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
        } else {
            $category = new Category;
            $category->name = $name; //retrieving user inputs
            $category->parent_category = $parent;  //retrieving user inputs
            $category->save(); //storing values as an object
            $this->info('Category created successful!');
        }
    }
}
