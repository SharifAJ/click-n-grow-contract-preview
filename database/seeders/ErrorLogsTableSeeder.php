<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ErrorLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('error_logs')->delete();

        \DB::table('error_logs')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'user_id' => 1,
                    'error_type' => 'API_Error',
                    'error_message' => 'The first and last coordinates are not matching',
                    'request_data' => '{"name":"Another farm success","coordinates":[[77.57887210696936,13.6],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]],"croptype":"Apple","category":"farm","sowingdate":"01-08-2024","crop_variety":"Cherry Tomato"}',
                    'api_response' => '{"exception":"Invalid Input","message":"The first and last coordinates are not matching","status":"error"}',
                    'farm_id' => NULL,
                    'created_at' => '2025-02-06 10:12:50',
                    'updated_at' => '2025-02-06 10:12:50',
                ),
            1 =>
                array(
                    'id' => 2,
                    'user_id' => 1,
                    'error_type' => 'API_Error',
                    'error_message' => 'HTTP request returned status code 404:
                    <h1>404</h1><p>The resource could not be found.</p>
                    ',
                    'request_data' => '{"name":"Another farm success","coordinates":[[77.57887210696936,13.6],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]],"croptype":"Apple","category":"farm","sowingdate":"01-08-2024","crop_variety":"Cherry Tomato"}',
                    'api_response' => NULL,
                    'farm_id' => NULL,
                    'created_at' => '2025-02-06 10:15:47',
                    'updated_at' => '2025-02-06 10:15:47',
                ),
            2 =>
                array(
                    'id' => 3,
                    'user_id' => 1,
                    'error_type' => 'API_Error',
                    'error_message' => 'The first and last coordinates are not matching',
                    'request_data' => '{"name":"Another farm success","coordinates":[[77.57887210696936,13.6],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]],"croptype":"123","category":"farm","sowingdate":"01-08-2024","crop_variety":"Cherry Tomato"}',
                    'api_response' => '{"exception":"Invalid Input","message":"The first and last coordinates are not matching","status":"error"}',
                    'farm_id' => NULL,
                    'created_at' => '2025-02-06 10:17:12',
                    'updated_at' => '2025-02-06 10:17:12',
                ),
            3 =>
                array(
                    'id' => 4,
                    'user_id' => 1,
                    'error_type' => 'API_Error',
                    'error_message' => 'Category is does not matching.Allowed categories are: farm, garden, tank, polyhouse.',
                    'request_data' => '{"name":"Another farm success","coordinates":[[77.57887210696936,13.027886613876026],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]],"croptype":"123","category":"123","sowingdate":"01-08-2024","crop_variety":"Cherry Tomato"}',
                    'api_response' => '{"exception":"Invalid category","message":"Category is does not matching.Allowed categories are: farm, garden, tank, polyhouse.","status":"Error"}',
                    'farm_id' => NULL,
                    'created_at' => '2025-02-06 10:17:30',
                    'updated_at' => '2025-02-06 10:17:30',
                ),
            4 =>
                array(
                    'id' => 5,
                    'user_id' => 1,
                    'error_type' => 'API_Error',
                    'error_message' => 'cURL error 28: Operation timed out after 15002 milliseconds with 0 bytes received (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://micro.satyukt.com/postjson2?name=Test&coordinates=%5B%5B77.57887210696936%2C13.027886613876026%5D%2C%5B77.57933847606182%2C13.028302107588592%5D%2C%5B77.57991146296263%2C13.027941817090266%5D%2C%5B77.57926404476166%2C13.027034065631998%5D%2C%5B77.57887210696936%2C13.027886613876026%5D%5D&croptype=Apple&category=farm&sowingdate=01-08-2024&crop_variety=Cherry%20Tomato&key=z-gXaNZzUKTsVOc2qvCdTi8mLBDLonoa5z3kTbqFXis%3D',
                    'request_data' => '{"name":"Test","coordinates":[[77.57887210696936,13.027886613876026],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]],"croptype":"Apple","category":"farm","sowingdate":"01-08-2024","crop_variety":"Cherry Tomato"}',
                    'api_response' => NULL,
                    'farm_id' => NULL,
                    'created_at' => '2025-02-07 02:57:48',
                    'updated_at' => '2025-02-07 02:57:48',
                ),
        ));


    }
}