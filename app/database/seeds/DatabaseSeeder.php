<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
        $this->call('AdminTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('DictTableSeeder');
        $this->call('CategoryTableSeeder');
        $this->call('ProductsTableSeeder');
        $this->command->info('All table seeded!');
	}

}
