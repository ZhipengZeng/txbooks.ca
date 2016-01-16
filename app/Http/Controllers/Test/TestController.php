<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use Symfony\Component\CssSelector\CssSelector;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\DomCrawler\Crawler;

use App\Program;
use App\Course;
use App\School;

// 2 important components used here: Crawler and CssSelector
// install them through commands:
// composer require symfony/dom-crawler 
// composer require symfony/css-selector

class TestController extends Controller
{

    public function test(){

    	// this url below contains 200 programs.
    	// it could be a huge performance concern if crawl it.
    	// so I just choose the "I" category of all programs insteaded.

    	// $url_main = "http://www.humber.ca/program"; 
    	set_time_limit(1000);
    	// $url_main = "http://www.humber.ca/program/listings/b?school=All&credential=All&campus=All&field_program_name_value_1=";

    	$html_main = file_get_contents($url_main);

		$crawler = new Crawler($html_main);

		$links = array();

		// Simple XPath for this element, so I did not use CssSelector.
		$crawler->filterXPath('//tbody/tr/td/a')->each(function ($node, $i) use( &$links) {
			
			// the links in website are relative path, so I need to add a prefix to make it absolute.
			$prefix = "http://humber.ca";

			$existed_programs = Program::all();
			$existed_program_names = array();
			foreach ($existed_programs as $key => $value) {
				$existed_program_names[] = $value['program_name'];
			}

			// get rid of the duplicated links, no idea why Humber make the program list a mess
			if (strpos($node->text(),',') === false) {
				
				// get the full link
				$link = $prefix . $node->attr('href');
			    $link = trim($link);
			    // get the text which is the program name
			    $text = trim($node->text());		
		    	
		    	// put associate name & link to key/value pair array
			    if(!in_array($text, $existed_program_names)){
			    	$links["$text"] = $link;
			    }
		    				
			}
		});

		// an array to store all programs
		$programs = array();

		// use a loop to crawl individual program webpage by accessing its link in $links array
		foreach ($links as $key => $value) {

			$program_url = $value;

			// use curl to get the webpage content
			// it seems file_get_contents() has some issues for these webpage
			// or it's just I made some mistakes
			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$program_url);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Humber College');

			

			$program_html = curl_exec($curl_handle);
			curl_close($curl_handle);

			if($program_html){
				$program_crawler = new Crawler($program_html);
			}

			// $program is an array to store the program's information with key/value pair
			$program = array();

			// here I used CssSelector to help me translate the XPath.
			// It made me address it without headache.
			$program['program_name'] = trim($key);

			$Code = $program_crawler->filterXPath(CssSelector::toXPath('div.container.clearfix>section>div.field-items>div.field-item.even'))->text();
			$program['program_code'] = trim($Code);

			$Credential = $program_crawler->filterXPath(CssSelector::toXPath('section.field-name-field-credential>div.field-item>a'))->text();
			$program['program_credential'] = trim($Credential);

			$School = $program_crawler->filterXPath(CssSelector::toXPath('section.field-name-field-school>div.field-item>a'))->text();
			$program['program_school'] = trim($School);

			// get all the schools from database
			$schools = School::all();

			// Because I used School table's id as the foreign key in Program table.
			foreach ($schools as $key1 => $value1) {
	    		if($program['program_school'] == $value1['school_name']){
	    			$program['program_school_id'] = $value1['id'];
	    		}
	    	}	

	    	// getting each courses' name/code
			$courses = array();
			$courses = $program_crawler->filterXPath(CssSelector::toXPath('div.course'))->each(function ($node, $i)  {
				$course = array();
				$course_code = $node->children()->first()->text();
				$course_name = $node->children()->last()->text();
				$course['course_code'] = $course_code;
				$course['course_name'] = $course_name;
				return $course;

			});

			
			$program['program_courses'] = $courses;
			$programs[] = $program;
		}

		// store the information from array to database through loops
		// just in case of accidents, I commented the inserting database code below.
		foreach ($programs as $key => $value) {
			$one_program = new Program;
			$one_program->program_name = $value['program_name'];
			$one_program->program_code = $value['program_code'];
			$one_program->school_id = $value['program_school_id'];
			$one_program->credential = $value['program_credential'];
			$one_program->save();
			echo "a program is saved to db" . "<br>";
			foreach ($value['program_courses'] as $key2 => $value2) {

				// Same reason as above, I used Program table's id as foreign key in Course table
				$stored_programs = Program::all();
				// $stored_programs = $programs;
				$course_belongs_id = 0;
				foreach ($stored_programs as $key3 => $value3) {
		    		if($value['program_name'] == $value3['program_name']){
		    			$course_belongs_id = $value3['id'];
		    		}
		    	}

		    	$existed_courses = Course::where('program_name', '=', $value['program_name']);
				$existed_course_name = array();
				foreach ($existed_courses as $key => $value) {
					$existed_course_name[] = $value['course_name'];
				}	
				if(!in_array($value2['course_name'], $existed_course_name)){
					$one_course = new Course;
					$one_course->course_name = $value2['course_name'];
					$one_course->course_code = $value2['course_code'];
					$one_course->program_id = $course_belongs_id;
					$one_course->save();
					echo "a course is saved to db ---- " . $one_course->program_id . "<br>";
				}
		    	

			}
			echo "<br>======<br>";
		}

	}
}
