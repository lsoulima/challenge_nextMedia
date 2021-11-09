<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Validator;
use Illuminate\Console\Command;
use App\Models\Category;

class CategoryDeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to delete a Category';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->option('id');

        $userInputs = [
            'id' => $id,
        ];

        $validator = Validator::make($userInputs, [
            'id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            $this->info('Category not deleted. See error messages below:');
        
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
        }
        else {
            $category = Category::findorFail($id); //searching for object in database using ID
            if($category->delete()){ //deletes the object
                $this->info('Category deleted successfully'); //shows a message when the delete operation was successful.
            }
        }
    }
}
