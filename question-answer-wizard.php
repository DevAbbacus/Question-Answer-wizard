<?php
/*Plugin Name: Question Answer Wizard
  Description: Business logic decision wizard.Not sure what you need? Answer four questions & Get advice on what works best.
  Version: 1.0
  Author: Dev
*/
add_action('wp_enqueue_scripts','ava_test_init');

function ava_test_init() {
	wp_enqueue_style('style-css', plugins_url('assets/css/style.css',__FILE__ ));
    //wp_enqueue_script( 'ava-test-js', plugins_url( 'assets/js/custom.js', __FILE__ ));
    wp_enqueue_script( 'jquery-min-js', plugins_url( 'assets/js/jquery.min.js', __FILE__ ));
}

function question_answer_install(){
	global $wpdb;
	$add_table = $wpdb->prefix . "questions";	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE `{$add_table}` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `question` text NOT NULL,
		  `sort_order` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	$wpdb->insert($add_table, array('question' => 'Do you know which skills to need?','sort_order' => '1'));
	$wpdb->insert($add_table, array('question' => 'Do you have a clear project description?','sort_order' => '2'));
	$wpdb->insert($add_table, array('question' => 'Do you like a flexible skills on demand?','sort_order' => '3'));
	$wpdb->insert($add_table, array('question' => 'Need help with just one marketing project?','sort_order' => '4'));


	$add_table2 = $wpdb->prefix . "result_options";	
	$charset_collate = $wpdb->get_charset_collate();

	$sql2 = "CREATE TABLE `{$add_table2}` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `option_name` varchar(255) NOT NULL,
		  `url` text NOT NULL,
		  PRIMARY KEY (`id`)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql2 );

	$wpdb->insert($add_table2, array('option_name' => 'Playbook','url' => 'https://app.hellomaas.com/free-marketing-playbook'));
	$wpdb->insert($add_table2, array('option_name' => 'Package','url' => 'https://app.hellomaas.com/packages/list'));
	$wpdb->insert($add_table2, array('option_name' => 'Flex team','url' => ''));
	$wpdb->insert($add_table2, array('option_name' => 'Post a Project','url' => 'https://app.hellomaas.com/projects/create'));
	

	$add_table3 = $wpdb->prefix . "question_weightage";	
	$charset_collate = $wpdb->get_charset_collate();

	$sql3 = "CREATE TABLE `{$add_table3}` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `question_id` int(11) NOT NULL,
		  `answer_type` int(11) NOT NULL,
		  `option_id` int(11) NOT NULL,
		  `weightage` int(11) NOT NULL,
		  PRIMARY KEY (`id`),
		  FOREIGN KEY  (question_id) REFERENCES $add_table(id),
		  FOREIGN KEY  (option_id) REFERENCES $add_table2(id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql3 );

	$wpdb->insert($add_table3, array('question_id' => '1','answer_type' => '1','option_id' => '1','weightage' => '0'));
	$wpdb->insert($add_table3, array('question_id' => '2','answer_type' => '1','option_id' => '1','weightage' => '0'));
	$wpdb->insert($add_table3, array('question_id' => '3','answer_type' => '1','option_id' => '1','weightage' => '0'));
	$wpdb->insert($add_table3, array('question_id' => '4','answer_type' => '1','option_id' => '1','weightage' => '0'));

	$wpdb->insert($add_table3, array('question_id' => '1','answer_type' => '0','option_id' => '1','weightage' => '2'));
	$wpdb->insert($add_table3, array('question_id' => '2','answer_type' => '0','option_id' => '1','weightage' => '2'));
	$wpdb->insert($add_table3, array('question_id' => '3','answer_type' => '0','option_id' => '1','weightage' => '1'));
	$wpdb->insert($add_table3, array('question_id' => '4','answer_type' => '0','option_id' => '1','weightage' => '0'));

	$wpdb->insert($add_table3, array('question_id' => '1','answer_type' => '1','option_id' => '2','weightage' => '1'));
	$wpdb->insert($add_table3, array('question_id' => '2','answer_type' => '1','option_id' => '2','weightage' => '1'));
	$wpdb->insert($add_table3, array('question_id' => '3','answer_type' => '1','option_id' => '2','weightage' => '1'));
	$wpdb->insert($add_table3, array('question_id' => '4','answer_type' => '1','option_id' => '2','weightage' => '0'));

	$wpdb->insert($add_table3, array('question_id' => '1','answer_type' => '0','option_id' => '2','weightage' => '1'));
	$wpdb->insert($add_table3, array('question_id' => '2','answer_type' => '0','option_id' => '2','weightage' => '0'));
	$wpdb->insert($add_table3, array('question_id' => '3','answer_type' => '0','option_id' => '2','weightage' => '1'));
	$wpdb->insert($add_table3, array('question_id' => '4','answer_type' => '0','option_id' => '2','weightage' => '2'));

	$wpdb->insert($add_table3, array('question_id' => '1','answer_type' => '1','option_id' => '3','weightage' => '2'));
	$wpdb->insert($add_table3, array('question_id' => '2','answer_type' => '1','option_id' => '3','weightage' => '0'));
	$wpdb->insert($add_table3, array('question_id' => '3','answer_type' => '1','option_id' => '3','weightage' => '2'));
	$wpdb->insert($add_table3, array('question_id' => '4','answer_type' => '1','option_id' => '3','weightage' => '0'));

	$wpdb->insert($add_table3, array('question_id' => '1','answer_type' => '0','option_id' => '3','weightage' => '0'));
	$wpdb->insert($add_table3, array('question_id' => '2','answer_type' => '0','option_id' => '3','weightage' => '1'));
	$wpdb->insert($add_table3, array('question_id' => '3','answer_type' => '0','option_id' => '3','weightage' => '0'));
	$wpdb->insert($add_table3, array('question_id' => '4','answer_type' => '0','option_id' => '3','weightage' => '2'));

	$wpdb->insert($add_table3, array('question_id' => '1','answer_type' => '1','option_id' => '4','weightage' => '1'));
	$wpdb->insert($add_table3, array('question_id' => '2','answer_type' => '1','option_id' => '4','weightage' => '2'));
	$wpdb->insert($add_table3, array('question_id' => '3','answer_type' => '1','option_id' => '4','weightage' => '1'));
	$wpdb->insert($add_table3, array('question_id' => '4','answer_type' => '1','option_id' => '4','weightage' => '0'));

	$wpdb->insert($add_table3, array('question_id' => '1','answer_type' => '0','option_id' => '4','weightage' => '1'));
	$wpdb->insert($add_table3, array('question_id' => '2','answer_type' => '0','option_id' => '4','weightage' => '0'));
	$wpdb->insert($add_table3, array('question_id' => '3','answer_type' => '0','option_id' => '4','weightage' => '1'));
	$wpdb->insert($add_table3, array('question_id' => '4','answer_type' => '0','option_id' => '4','weightage' => '0'));
}

register_activation_hook(__FILE__, 'question_answer_install');


function my_plugin_remove_database() {
     global $wpdb;
     
     $table_name2 = $wpdb->prefix . 'question_weightage';
     $sql2 = "DROP TABLE IF EXISTS $table_name2";
     $wpdb->query($sql2);
     delete_option("my_plugin_db_version");

     $table_name3 = $wpdb->prefix . 'result_options';
     $sql3 = "DROP TABLE IF EXISTS $table_name3";
     $wpdb->query($sql3);
     delete_option("my_plugin_db_version");

     $table_name = $wpdb->prefix . 'questions';
     $sql = "DROP TABLE IF EXISTS $table_name";
     $wpdb->query($sql);

}
register_deactivation_hook( __FILE__, 'my_plugin_remove_database' );

function question_answer_ad_custom_actions() {	
	add_menu_page("Question Answer", "Question Answer", 7, "question_answer", "list_question_answer");	
}

add_action('admin_menu', 'question_answer_ad_custom_actions');
function list_question_answer(){	include('question_answer.php');}

/*Shortcode*/
function wp_qaw_shortcode() { 
	
	$output = "<div class='container'>
	<div id='result'></div>
	<form id='survey_form'>
	<fieldset>
		<div class='row'>
			<div class='col-lg-12 col-md-12 c-center'>
				<div class='questn-main'>
					<div class='q-orange'>
						<div class='question-title'>Do you know which skills to need? </div>
						<div class='yes-no next1'><input class='yes' type='radio' id='yes1' name='yes_no_q1' value='1' required><label for='yes1'>Yes</label><input class='no' type='radio' id='no1' name='yes_no_q1' value='0'><label class='no' for='no1'>No</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input type='button' class='next-form next1 btn btn-info video-btn no-icon' value='Next' />
	</fieldset>
	<fieldset>
		<div class='row'>
			<div class='col-lg-12 col-md-12 c-center'>
				<div class='questn-main'>
					<div class='q-orange'>
						<div class='question-title'>Do you have a clear project description?</div>
						<div class='yes-no next2'><input class='yes' type='radio' id='yes2' name='yes_no_q2' value='1' required><label for='yes2'>Yes</label><input class='no' type='radio' id='no2' name='yes_no_q2' value='0'><label class='no' for='no2'>No</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<input type='button' name='next' class='next-form next2 btn btn-info video-btn no-icon' value='Next' />
	</fieldset>
	<fieldset>
		<div class='row'>
			<div class='col-lg-12 col-md-12 c-center'>
				<div class='questn-main'>
					<div class='q-orange'>
						<div class='question-title'>Do you like a flexible skills on demand?</div>
						<div class='yes-no next3'><input class='yes' type='radio' id='yes3' name='yes_no_q3' value='1' required><label for='yes3'>Yes</label><input class='no' type='radio' id='no3' name='yes_no_q3' value='0'><label class='no' for='no3'>No</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<input type='button' name='next' class='next-form next3 btn btn-info video-btn no-icon' value='Next' />
	</fieldset>
	<fieldset>
		<div class='row'>
			<div class='col-lg-12 col-md-12 c-center'>
				<div class='questn-main'>
					<div class='q-orange'>
						<div class='question-title'>Need help with just one marketing project?</div>
						<div class='yes-no next4'><input class='yes' type='radio' id='yes4' name='yes_no_q4' value='1' required><label for='yes4'>Yes</label><input class='no' type='radio' id='no4' name='yes_no_q4' value='0'><label class='no' for='no4'>No</label></div>
					</div>
				</div>
			</div>
		</div>
		
		<input type='submit' name='submit' class='submit next4 btn btn-success video-btn no-icon' value='Submit' />
	</fieldset>
	</form>
	</div>";
	 
	return $output;
} 
add_shortcode('question_answer_wizard', 'wp_qaw_shortcode'); 

function test_ajax_load_scripts() {
	// load our jquery file that sends the $.post request
	wp_enqueue_script( "ajax-test", plugin_dir_url( __FILE__ ) . 'assets/js/custom.js', array( 'jquery' ) );
 
	// make the ajaxurl var available to the above script
	wp_localize_script( 'ajax-test', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );	
}
add_action('wp_print_scripts', 'test_ajax_load_scripts');

function display_response() {
	
	$yesnoq1 = isset($_POST['q1']) ? $_POST['q1'] : "";
	$yesnoq2 = isset($_POST['q2']) ? $_POST['q2'] : "";
	$yesnoq3 = isset($_POST['q3']) ? $_POST['q3'] : "";
	$yesnoq4 = isset($_POST['q4']) ? $_POST['q4'] : "";
	
	
	global $wpdb;
	$query = "Select * from wp_question_weightage where (question_id = 1 and answer_type= ($yesnoq1)) or (question_id = 2 and answer_type= ($yesnoq2)) or (question_id = 3 and answer_type= ($yesnoq3)) or (question_id = 4 and answer_type= ($yesnoq4))";
	// $data=$wpdb->query($query);
	$myrows = $wpdb->get_results( $query );
	
	$result= array();
	foreach ($myrows as $key => $value) {
		// print_r($value->weightage);
		if(isset($result[$value->option_id])){
			$result[$value->option_id] += $value->weightage;
		}
		else{
			$result[$value->option_id] = $value->weightage;
		}

	}
	arsort($result);
	$options = array_keys($result);
	$options = array_slice($options, 0, 2);
	//print_r($options);
	$options_value = array_values($result);
	//print_r($options_value);
	$options = implode(',', $options);
	$query = "select * from wp_result_options where id in ($options) order by field(id,$options)";
	// $data=$wpdb->query($query);
	$myrows = $wpdb->get_results( $query );
	$urls = array_column($myrows, 'url');
	$names = array_column($myrows, 'option_name');
	//echo $name[1];
	$output .= "<div class='container'>
			<div class='row'>
			<div class='col-lg-12 col-md-12 c-center'>
			<div class='questn-main'>
			<div class='q-orange thanks'>
			<div class='question-title'>Thanks for your answers.<br/> We are recommend you</div>
			<div><a href='".$urls[0]."' target='_blank' class='orange-btn-gd2'>".$names[0]."</a></div>
			<div class='question-title'>As a Second best, try</div>
			<div><a href='".$urls[1]."' target='_blank' class='white-btn'>".$names[1]."</a></div>
			</div>
			</div>
			</div>
			</div>";
	//$output = print_r($myrows);
	
	echo $output;
	exit;
}


add_action('wp_ajax_display_response', 'display_response');
add_action('wp_ajax_nopriv_display_response', 'display_response');