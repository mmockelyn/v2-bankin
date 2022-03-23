<?php

namespace Database\Factories\Customer;

use App\Models\Core\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = rand(0,1);
        $open = ["open", "completed", "accepted", "declined", "terminated"];
        $count_packages = Package::all()->count();
        return [
            "type_account" => $type == 0 ? 'INDIVIDUAL' : 'BUSINESS',
            "package_id" => rand(1, $count_packages),
            "status_open_account" => $open[rand(0,4)],
            "auth_code" => base64_encode(1234)
        ];
    }
}
