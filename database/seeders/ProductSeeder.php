<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $sql = "INSERT INTO `products` (name, description, price, path, slug, stripe_product_id, stripe_price_id)
VALUES
 ('Dark_brown_sandal', 'brown_dark_sandal', 17.50, 'dark-brown-sandals_PNG9673.png', 'shoe', 'prod_RYmjj77TfZOEbB', 'price_1Qff9rEhjOvjo7Kh4TYn2NPe' ),
 ('Green_vans', 'green_vans', 15.00, 'green-vans_PNG30.png', 'shoe', 'prod_RYmhkP7ybYDDJy', 'price_1Qff7qEhjOvjo7Kh4qmF8krF'),
 ('Brown_vans', 'brown_van', 21.00, 'brown-vans_PNG29.png', 'shoe', 'prod_RYmfoEYxgIP8oV', 'price_1Qff6LEhjOvjo7KheH5o5fA6'),
 ('brown_sandal', 'brown_sandal', 20.00, 'brown-sandals_PNG9705.png', 'shoe', 'prod_RYmdoHSwsd0lDS', 'price_1Qff4QEhjOvjo7KhkDvqD7B5'),
 ('Blue_vans', 'Blue_vans', 13.00, 'blue-vans_PNG24.png', 'shoe','prod_RYmS3mooiA5PQu', 'price_1QfetVEhjOvjo7Kh3a2gnhrG'),
 ('Fitted_shirt', 'Fitted_shirt', 31.00, 'gold-dress_shirt_PNG8068.png', 'shirt', 'prod_RYlzQd739ZaMOi', 'price_1QfeRtEhjOvjo7Kh8uHmpLMG'),
 ('Stripe_shirt', 'Stripe_shirt', 29.00, 'dress_shirt_PNG8113.png', 'shirt', 'prod_RYlwWhkHSi2jgC', 'price_1QfeONEhjOvjo7KhH3ChM0uS'),
 ('Black_shirt', 'Black_shirt', 30.00, 'black-dress_shirt_PNG8117.png', 'shirt','prod_RYltTMYNh82ras', 'price_1QfeLsEhjOvjo7Kh2QS6noK0'),
 ('Prada', 'Prada', 15.03, 'brown-men_shoes_PNG7495.png', 'shoe', 'prod_RYlqlIUX0UvXu2', 'price_1QfeImEhjOvjo7KhxazP9Kju'),
 ('Sandal', 'Sandal', 19.00, 'grey-sandals_PNG9682.png', 'shoe', 'prod_RYllcY8fKZLOKN', 'price_1QfeE3EhjOvjo7KhM0xc2PjS' )" ;

        DB::statement($sql);
    }
}
