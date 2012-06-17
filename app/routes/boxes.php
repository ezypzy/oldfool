<?php
/**
 * boxes controller
 *
 * app/routes/boxes.php
 **/

$app->get('/boxes/', 'boxes_list');
function boxes_list() {
    global $app, $v;
    echo 'list of boxes';
}


// --  page for boxes
$app->get('/:box_name/', 'box_name_show');
function box_name_show($box_name, $s = '') {
    global $app, $v, $base_template, $page_template;

    //maybe this should be in config?
    $valid_box_names    =   array('his','hers');

    // verify that box name exist
    $box = ORM::for_table('boxfools')
        ->where('name', $box_name)
        ->where_gt('status_id', 1)
        ->find_one();

    if($box == false || !in_array($box_name, $valid_box_names)) {
        $v['page'] = 'error';
        $app->render($base_template, $v);
    } else{
        $v  =   array_merge($v, array(
            'box_description'   =>  $box->description,
            'box_hashtag'       =>  $box->hashtag,
            'box_name'          =>  $box_name,
            'box_price'         =>  $box->price,
            'page'              =>  'boxstar',
        ));
        $app->render($page_template, $v);
    }
}

// -- page for box subscribe
$app->get('/:box_name/subscribe/', 'box_subscribe');
function box_subscribe($box_name) {
    global $app, $v;

    // verify that box name exist
    $box = ORM::for_table('boxfools')
        ->where('name', $box_name)
        ->where_gt('status_id', 1)
        ->find_one();

    if($box == false) {
        $v['page'] = 'error';
        $app->render('layout', $v);
    } else {
        $v['box_name'] = $box_name;
        $v['page'] = 'box_subscribe';
        $v['box_description'] = $box->description;
        $v['box_hashtag'] = $box->hashtag;
        $v['box_price'] = $box->price;
        $app->render('layout', $v);
    }
}

// -- process subscription form
$app->post('/:box_name/subscribe/', 'box_subscribe_process');
function box_subscribe_proccess() {
    global $app, $v;

    // verify that box name exist
    $box = ORM::for_table('boxfools')
        ->where('name', $box_name)
        ->where_gt('status_id', 1)
        ->find_one();

    if($box == false) {
        $v['page'] = 'error';
        $app->render('layout', $v);
    }   else {

        $name = $app->request()->post('name');
        $email = $app->request()->post('email');
        $address1 = $app->request()->post('address1');
        $address2 = $app->request()->post('address2');
        $address3 = $app->request()->post('address3');
        $postcode =$app->request()->post('postcode');
        $city = $app->request()->post('city');
        $state = $app->request()->post('state');
        $country = $app->request()->post('country');


        $v['box_name'] = $box_name;
        $v['box_description'] = $box->description;
        $v['box_hashtag'] = $box->hashtag;
        $v['box_price'] = $box->price;
        $app->render('layout', $v);
    }

}
