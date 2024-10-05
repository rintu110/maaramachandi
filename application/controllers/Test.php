<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{

		$this->load->library('Compress');  // load the codeginiter library

		//File to block
		$file0 = base_url().'images/issue.jpg';  // file that you wanna compress
		$new_name_image0 = 'issue_resized'; // name of new file compressed
		$quality0 = 60; // Value that I chose
		$destination0 = base_url().'images/resized'; // This destination must be exist on your project

		//File to pass
		$file1 = base_url().'images/snake_river.jpg'; // file that you wanna compress
		$new_name_image1 = 'snake_river_resized'; // name of new file compressed
		$quality1 = 10; // Value that I chose
		$destination1 = base_url().'images/resized'; // This destination must be exist on your project

		//PNG File
		$file2 = base_url().'images/yoshi.png'; // file that you wanna compress
		$new_name_image2 = 'yoshi_resized'; // name of new file compressed
		$quality2 = 60; // Value that I chose
		$pngQuality2 = 9;
		$destination2 = base_url().'images/resized'; // This destination must be exist on your project
		
		$compress0 = new Compress();
		$compress1 = new Compress();
		$compress2 = new Compress();
		
		$compress0->file_url = $file0;
		$compress0->new_name_image = $new_name_image0;
		$compress0->quality = $quality0;
		$compress0->destination = $destination0;

		$compress1->file_url = $file1;
		$compress1->new_name_image = $new_name_image1;
		$compress1->quality = $quality1;
		$compress1->destination = $destination1;

		$compress2->file_url = $file2;
		$compress2->new_name_image = $new_name_image2;
		$compress2->quality = $quality2;
		$compress2->pngQuality = $pngQuality2;
		$compress2->destination = $destination2;

		$result0 = $compress0->compress_image();
		$result1 = $compress1->compress_image();
		$result2 = $compress2->compress_image();

		echo '<pre>';
		var_dump($result0);
		var_dump($result1);
		var_dump($result2);
		die;

	}

	public function test_json()
	{
		$str = '{"id":3,"user_id":1,"bus_operator_id":5,"name":"Sonax","via":"Anugul","bus_number":"OD B 3456","bus_description":null,"bus_type_id":316,"bus_sitting_id":1,"bus_seat_layout_id":6,"cancellationslabs_id":1,"running_cycle":2,"popularity":null,"admin_notes":null,"has_return_bus":0,"return_bus_id":null,"cancelation_points":null,"created_at":"2021-06-11T15:43:18.000000Z","updated_at":"2021-06-11T15:55:17.000000Z","created_by":"Admin","status":1,"sequence":1000,"bus_schedule":[{"id":4,"bus_id":3,"created_at":"2021-06-11T15:55:17.000000Z","updated_at":"2021-06-11T15:55:17.000000Z","created_by":"Admin","status":0,"bus_schedule_date":[{"id":88,"bus_schedule_id":4,"entry_date":"2021-07-01","created_by":"Admin","created_at":"2021-06-11T15:55:18.000000Z","updated_at":"2021-06-11T15:55:18.000000Z","status":1},{"id":89,"bus_schedule_id":4,"entry_date":"2021-07-03","created_by":"Admin","created_at":"2021-06-11T15:55:18.000000Z","updated_at":"2021-06-11T15:55:18.000000Z","status":1},{"id":90,"bus_schedule_id":4,"entry_date":"2021-07-05","created_by":"Admin","created_at":"2021-06-11T15:55:18.000000Z","updated_at":"2021-06-11T15:55:18.000000Z","status":1},{"id":211,"bus_schedule_id":4,"entry_date":"2021-07-07","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1},{"id":212,"bus_schedule_id":4,"entry_date":"2021-07-09","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1},{"id":213,"bus_schedule_id":4,"entry_date":"2021-07-11","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1},{"id":214,"bus_schedule_id":4,"entry_date":"2021-07-13","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1},{"id":215,"bus_schedule_id":4,"entry_date":"2021-07-15","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1},{"id":216,"bus_schedule_id":4,"entry_date":"2021-07-17","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1},{"id":217,"bus_schedule_id":4,"entry_date":"2021-07-19","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1},{"id":218,"bus_schedule_id":4,"entry_date":"2021-07-21","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1},{"id":219,"bus_schedule_id":4,"entry_date":"2021-07-23","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1},{"id":220,"bus_schedule_id":4,"entry_date":"2021-07-25","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1},{"id":221,"bus_schedule_id":4,"entry_date":"2021-07-27","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1},{"id":222,"bus_schedule_id":4,"entry_date":"2021-07-29","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1},{"id":223,"bus_schedule_id":4,"entry_date":"2021-07-31","created_by":"Admin","created_at":"2021-07-14T10:12:29.000000Z","updated_at":"2021-07-14T10:12:29.000000Z","status":1}]}]}';

		$arr = json_decode($str);

		print_result($arr->bus_schedule[0]->bus_schedule_date);

		/*foreach ($arr as $k => $v) 
		{
			print_result($v-><)
		}*/

		print_result($arr);
	}
}
