<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RequestLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('request_logs')->delete();
        
        \DB::table('request_logs')->insert(array (
            0 => 
            array (
                'id' => 9,
                'user_id' => 1,
                'service_name' => 'Add Farm API',
                'request_method' => 'GET',
                'request_url' => 'https://micro.satyukt.com/postjson2',
                'request_data' => '{"name":"Test","coordinates":[[77.57887210696936,13],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]],"croptype":"Apple","category":"farm","sowingdate":"01-08-2024","crop_variety":"Cherry Tomato"}',
                'response_status' => 200,
                'response_data' => '{"exception":"Invalid Input","message":"The first and last coordinates are not matching","status":"error"}',
                'is_successful' => 1,
                'error_message' => NULL,
                'created_at' => '2025-02-07 03:45:04',
                'updated_at' => '2025-02-07 03:45:04',
            ),
            1 => 
            array (
                'id' => 11,
                'user_id' => 1,
                'service_name' => 'Add Farm API',
                'request_method' => 'GET',
                'request_url' => 'https://micro.satyukt.com/postjson2',
                'request_data' => '{"name":"Test","coordinates":[[77.57887210696936,13],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]],"croptype":"Apple","category":"farm","sowingdate":"01-08-2024","crop_variety":"Cherry Tomato"}',
                'response_status' => 200,
                'response_data' => '{"exception":"Invalid Input","message":"The first and last coordinates are not matching","status":"error"}',
                'is_successful' => 0,
                'error_message' => 'The first and last coordinates are not matching',
                'created_at' => '2025-02-07 04:13:07',
                'updated_at' => '2025-02-07 04:13:07',
            ),
            2 => 
            array (
                'id' => 12,
                'user_id' => 1,
                'service_name' => 'Add Farm API',
                'request_method' => 'GET',
                'request_url' => 'https://micro.satyukt.com/postjson2',
                'request_data' => '{"name":"Test","coordinates":[[77.57887210696936,13],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]],"croptype":"Apple","category":"farm","sowingdate":"01-08-2024","crop_variety":"Cherry Tomato"}',
                'response_status' => 200,
                'response_data' => '{"exception":"Invalid api key","message":"API key is reqiured.","status":"Error"}',
                'is_successful' => 0,
                'error_message' => 'API key is reqiured.',
                'created_at' => '2025-02-07 07:28:44',
                'updated_at' => '2025-02-07 07:28:44',
            ),
            3 => 
            array (
                'id' => 13,
                'user_id' => 1,
                'service_name' => 'Add Farm API',
                'request_method' => 'GET',
                'request_url' => 'https://micro.satyukt.com/postjson2',
                'request_data' => '{"name":"Test","coordinates":[[77.57887210696936,13],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]],"croptype":"Apple","category":"farm","sowingdate":"01-08-2024","crop_variety":"Cherry Tomato"}',
                'response_status' => 200,
                'response_data' => '{"exception":"Invalid Input","message":"The first and last coordinates are not matching","status":"error"}',
                'is_successful' => 0,
                'error_message' => 'The first and last coordinates are not matching',
                'created_at' => '2025-02-07 07:32:30',
                'updated_at' => '2025-02-07 07:32:30',
            ),
            4 => 
            array (
                'id' => 14,
                'user_id' => 1,
                'service_name' => 'Add Farm API',
                'request_method' => 'GET',
                'request_url' => 'https://micro.satyukt.com/postjson2',
                'request_data' => '{"name":"Test","coordinates":[[77.57887210696936,13.027886613876026],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]],"croptype":"Apple","category":"farm","sowingdate":"01-08-2024","crop_variety":"Cherry Tomato"}',
                'response_status' => 200,
                'response_data' => '{"Area":1.9479352710333642,"Center":[77.5793568736788,13.02775148067602],"District":"Bangalore Urban","ID":"108399","State":"Karnataka","geo_json":{"geometry":{"coordinates":[[[77.57887210696936,13.027886613876026],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]]],"type":"Polygon"},"properties":{"name":"urn:ogc:def:crs:OGC:1.3:CRS84"},"type":"name"},"name":"Test","status":"success","type":"FeatureCollection","user_id":"z-gXaNZzUKTsVOc2qvCdTi8mLBDLonoa5z3kTbqFXis="}',
                'is_successful' => 1,
                'error_message' => NULL,
                'created_at' => '2025-02-07 07:34:34',
                'updated_at' => '2025-02-07 07:34:34',
            ),
            5 => 
            array (
                'id' => 15,
                'user_id' => 1,
                'service_name' => 'Add Farm API',
                'request_method' => 'GET',
                'request_url' => 'https://micro.satyukt.com/postjson2',
                'request_data' => '{"name":"Test","coordinates":[[77.57887210696936,13],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]],"croptype":"Apple","category":"farm","sowingdate":"01-08-2024","crop_variety":"Cherry Tomato"}',
                'response_status' => 200,
                'response_data' => '{"exception":"Invalid Input","message":"The first and last coordinates are not matching","status":"error"}',
                'is_successful' => 0,
                'error_message' => 'The first and last coordinates are not matching',
                'created_at' => '2025-02-07 10:07:17',
                'updated_at' => '2025-02-07 10:07:17',
            ),
            6 => 
            array (
                'id' => 16,
                'user_id' => 1,
                'service_name' => 'Add Farm API',
                'request_method' => 'GET',
                'request_url' => 'https://micro.satyukt.com/postjson2',
                'request_data' => '{"name":"Sunny Valley Farm","coordinates":[[77.57887210696936,13.027886613876026],[77.57933847606182,13.028302107588592],[77.57991146296263,13.027941817090266],[77.57926404476166,13.027034065631998],[77.57887210696936,13.027886613876026]],"croptype":"Apple","category":"cherry","sowingdate":"01-08-2024","crop_variety":"Cherry Tomato"}',
                'response_status' => 200,
                'response_data' => '{"exception":"Invalid category","message":"Category is does not matching.Allowed categories are: farm, garden, tank, polyhouse.","status":"Error"}',
                'is_successful' => 0,
                'error_message' => 'Category is does not matching.Allowed categories are: farm, garden, tank, polyhouse.',
                'created_at' => '2025-02-07 10:19:44',
                'updated_at' => '2025-02-07 10:19:44',
            ),
            7 => 
            array (
                'id' => 17,
                'user_id' => 1,
                'service_name' => 'Add Farm API',
                'request_method' => 'POST',
                'request_url' => 'https://micro.satyukt.com/postjson2',
                'request_data' => '[]',
                'response_status' => 422,
                'response_data' => NULL,
                'is_successful' => 0,
                'error_message' => NULL,
                'created_at' => '2025-02-07 10:22:23',
                'updated_at' => '2025-02-07 10:22:23',
            ),
        ));
        
        
    }
}