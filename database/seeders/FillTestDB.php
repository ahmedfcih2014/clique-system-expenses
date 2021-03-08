<?php
namespace Database\Seeders;

use App\Models\User;
use Exception;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FillTestDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->fill_users();
        $this->fill_expenses();
    }

    private function fill_users()
    {
        // create a manager
        try {
            User::create([
                'name' => 'Test Manager',
                'username' => 'test-manager',
                'password' => 'manager',
                'role' => 'manager'
            ]);
        } catch (Exception $e) {
            echo "Test Manager created before" . PHP_EOL;
        }

        // create an employee
        try {
            User::create([
                'name' => 'Test Employee',
                'username' => 'test-employee',
                'password' => '123456'
            ]);
        } catch (Exception $e) {
            echo "Test Employee created before" . PHP_EOL;
        }
    }

    private function fill_expenses()
    {
        $emp_id = User::where('username', 'test-employee')->first()->id;
        $base_path = storage_path('/app/public/attachments');
        $file_content = 'this only for automation tests';
        $attachments = [
            'attach-1.txt' => file_put_contents($base_path.'/attach-1.txt' ,$file_content),
            'attach-2.txt' => file_put_contents($base_path.'/attach-2.txt' ,$file_content),
            'attach-3.txt' => file_put_contents($base_path.'/attach-3.txt' ,$file_content),
            'attach-4.txt' => file_put_contents($base_path.'/attach-4.txt' ,$file_content),
            'attach-5.txt' => file_put_contents($base_path.'/attach-5.txt' ,$file_content),
        ];
        foreach($attachments as $attch_name => $copy_result) {
            DB::table('expenses')->insert([
                'employee_id' => $emp_id,
                'name' => 'Test Expense ' . rand(10000 ,99999),
                'date' => date('Y-m-d'),
                'attachment' => $attch_name,
                'amount' => rand(100 ,3000)
            ]);
        }
    }
}
