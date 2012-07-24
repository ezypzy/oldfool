<?php
/**
 * Boxfool Web Bootstrap
 *
 * bootstrap.php
 **/

require_once 'vendor/Slim/Slim.php';
require_once 'vendor/Idiorm/idiorm.php';
require_once 'vendor/Kirby/kirby.php';
require_once 'vendor/Rain/rain.tpl.class.php';
require_once 'vendor/phpmailer/class.phpmailer.php';

require_once 'app/config.php';
require_once 'app/helpers/db.php';
require_once 'app/helpers/view.php';
require_once 'app/helpers/session.php';

//Custom libraries
require_once 'app/lib/breadcrumb.php';

// -- init database connection
$db = new Database();
$db->connect();

// -- init session
$user_sess = new Session();

// -- init app
$app = new Slim(array(
    'view'              =>  new RainView(),
    'templates.path'    =>  '../views'
));

$bread  =   new Breadcrumb('/');
$crumb  =   $bread->generate();

// Change cache dir from "tmp" to "cache"
RainTPL::$cache_dir =   'cache';

// -- init the view data
$v = array(
    'base_url'      =>  c::get('base_url'),
    'crumb'         =>  $crumb,
    'breadcrumb'    =>  'breadcrumb',
    'is_home'       =>  false,
    'page'          =>  'blank',
    'tweetfools'    =>  'tweetfools',
    'window_title'  =>  'Discover Boxfools of Awesomeness Every Quarter'
);

function debug($args)
{
    echo '<pre>';
    print_r($args);
    echo '</pre>';
}

$base_template  =   'layout';
$page_template  =   'page';

$app->get('/', 'landing');
function landing()
{
    global $v, $app,$base_template;
    $v['page']    =   'landing';
    $v['is_home']   =   true;
		$v['form_error'] = false; // Newly added to prevent error
		$v['form_success'] = false; // Newly added to prevent error
    $app->render($base_template, $v);
}

$app->map('/newsletter/', 'newsletter')->via('POST', 'GET');
function newsletter()
{
	global $v, $app, $base_template;
	$v['page'] = 'landing';
	$v['is_home'] = true;
	$v['form_error'] = false;
	$v['form_success'] = false;
	$v['form_error_type']['null'] = false;
	$v['form_error_type']['syntax'] = false;
	$v['form_error_type']['duplication'] = false;
	$v['form_error_type']['database'] = false;

	if($app->request()->isPost()) {
		// check for valid email address
		$email = $app->request()->post('email');
		
		if(!v::email($email)) {
			$v['form_error'] = true;
			$v['form_error_type']['syntax'] = true; 
		}

		$e = ORM::for_table('emails')->where('email', $email)->find_one();
		if($e) {
			$v['form_error'] = true;
			$v['form_error_type']['duplication'] = true; 
		}

		if($v['form_error'] == false) {
			$e = ORM::for_table('emails')->create();
			$e->email = $email;
			$e->created_at = date('Y-m-d H:i:s');
			if($e->save()) {
				$v['form_success'] = true;
			} else {
				$v['form_error'] = true;
				$v['form_error_type']['database'] = true;
			}
		} 
	}
	
	$app->render($base_template, $v);
}


$app->get('/but-why/', 'cancel_order');
function cancel_order() {
	global $app, $v, $user_sess, $page_template;
	
	if($user_sess->logged_in) {
		$sub = ORM::for_table('subscribers')->find_one($user_sess->user_id);
		$sub->payment = 'cancel';
		$sub->save();

		$v['sub_name'] = $sub->name;
		$v['sub_email'] = $sub->email;

		$user_sess->destroy();
		
	} else {
		$app->redirect('/');
	}
	
	$v['page'] = 'cancel_order';
	$app->render($page_template, $v);
}


// the thank you page
$app->get('/thank-you-are-awesome/', 'thank_you_paypal');
function thank_you_paypal() {
	global $app, $v, $user_sess, $page_template;
	
	if($user_sess->logged_in) {
		$sub = ORM::for_table('subscribers')->find_one($user_sess->user_id);
		$sub->payment = 'done';
		$sub->save();

		$v['sub_name'] = $sub->name;
		$v['sub_email'] = $sub->email;

		sendEmail($v['sub_name'], $v['sub_email']);
		$user_sess->destroy();
		
	} else {
		$app->redirect('/');
	}
	
	$v['page'] = 'thankyou';
	$app->render($page_template, $v);
}

$app->get('/thank-you/', 'thank_you_bank_transfer');
function thank_you_bank_transfer() {
	global $app, $v, $user_sess, $page_template;

	if($user_sess->logged_in) {
		$sub = ORM::for_table('subscribers')->find_one($user_sess->user_id);
		$sub->payment = 'manual';
		$sub->save();

		$v['sub_name'] = $sub->name;
		$v['sub_email'] = $sub->email;

		sendEmailBankTransfer($v['sub_name'], $v['sub_email']);
		$user_sess->destroy();
	} else {
		$app->redirect('/');
	}

	$v['page'] = 'thankyou_bank';
	$app->render($page_template, $v);
}

/*
$app->get('/email-test/', 'email_test');
function email_test() {
	//echo "email test ";
	//$bla = sendEmail("bla", "jibone@gmail.com");
	//var_dump($bla);
	echo sha1("password123");
}*/

function sendEmail($name, $email) {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled
	
	$email_message = "Hello {$name}, \r\n\r\n";
	$email_message .= "Your Boxfool order has been received. Thank you!\r\n\r\n";
	$email_message .= "The Boxfool of Eco will be released on 15 September 2012. We'll keep you notified when it's out!\r\n\r\n";
	$email_message .= "Your order details are as follows:\r\n";
	$email_message .= "Boxfool of Eco {ECO01}\r\n";
	$email_message .= "Quantity: 1\r\n";
	$email_message .= "Total: RM 60\r\n\r\n";
	$email_message .= "For order enquiries, feel free to reply to us directly in this email or call (+603) 7887 1709.\r\n\r\n";
	$email_message .= "Thank you & best regards,\r\n\r\n";
	$email_message .= "Team Boxfool\r\n";
  $email_message .= "http://www.boxfool.com\r\n";
	$email_message .= "http://facebook.com/boxfool\r\n";
	$email_message .= "http://twitter.com/boxfool\r\n";

	$body = $email_message;

	$mail->IsSMTP();														// tell the class to use SMTP
	$mail->Mailer     = 'smtp';
	$mail->Host       = "ssl://smtp.gmail.com"; // SMTP server
	$mail->Port       = 465;                    // set the SMTP server port
	$mail->SMTPAuth   = true;										// enable SMTP authentication
	$mail->Username   = "hello@boxfool.com";		// SMTP server username
	$mail->Password   = "b0xst4rs";							// SMTP server password


	// $mail->IsSendmail();  // tell the class to use Sendmail

	$mail->From       = "hello@boxfool.com";
	$mail->FromName   = "Boxfool Team";
	$mail->AddReplyTo($mail->From, $mail->FromName);
	$mail->AddAddress($email);
	$mail->Subject  = "Thank you for your Boxfool subscription";
	$mail->Body = $body;
	$mail->WordWrap   = 80; // set word wrap

	$mail->Send();
}

function sendEmailBankTransfer($name, $email) {
	$mail = new PHPMailer(true);

	$email_message = "Hello {$name}, \r\n\r\n";
	$email_message .= "Thank you for your order for a Boxfool of Eco (RM60).\r\n\r\n";
	$email_message .= "You have chosen to make payment via direct bank-in / bank transfer.\r\n";
	$email_message .= "For your convenience, here are the payment details:\r\n\r\n";
	$email_message .= "Account No: 247-201-200344-6\r\n";
	$email_message .= "Name: EzPzy Sdn Bhd\r\n";
	$email_message .= "Bank: AmBank (M) Berhad\r\n\r\n";
	$email_message .= "Once transferred, send a scanned image of the bank-in slip or screenshot of the payment confirmation page to hello@boxfool.com.\r\n\r\n";
	$email_message .= "For order enquiries, feel free to reply to us directly in this email or call (+603) 7887 1709.\r\n\r\n\r\n";
	$email_message .= "Thank you & best regards,\r\n\r\n";
	$email_message .= "Team Boxfool\r\n";
	$email_message .= "http://www.boxfool.com\r\n";
	$email_message .= "http://facebook.com/boxfool\r\n";
	$email_message .= "http://twitter.com/boxfool\r\n";

	$body = $email_message;

	$mail->IsSMTP();
	$mail->Mailer			= 'smtp';
	$mail->Host				= "ssl://smtp.gmail.com";
	$mail->Port				= 465;
	$mail->SMTPAuth		= true;
	$mail->Username		=	"hello@boxfool.com";
	$mail->Password		= "b0xst4rs";

	$mail->From				= "hello@boxfool.com";
	$mail->FromName		= "Boxfoll Team";
	$mail->AddReplyTo($mail->From, $mail->FromName);
	$mail->AddAddress($email);
	$mail->Subject		= "Boxfool bank transfer details";
	$mail->Body				= $body;
	$mail->WordWrap		= 80;

	$mail->Send();
}

require 'app/routes/admin.php';
require 'app/routes/pages.php';
require 'app/routes/subscribers.php';
require 'app/routes/boxes.php';

$app->run();
