<?php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../route/Request.php';
require_once __DIR__ . '/../route/Router.php';
require_once __DIR__ . '/../db/Database.php';

session_start();

$db = new Database();

$router = new Router(new Request);

$router->get('/games/slotMachine', 'games/slotMachine');
$router->get('/games/luckyNumber', 'games/luckyNumber');
$router->get('/games/rollDice', 'games/rollDice');

$router->get('/', 'index');
$router->get('/profile', 'profile');
$router->get('/profile/edit', function() use($router){
    return $router->renderOnlyView('edit',[
        'user'=>[
            'username' => currentUser('username'),
            'name' => currentUser('name'),
            'lastname' => currentUser('lastname'),
        ]
    ]);
});
$router->get('/profile/posts', function() use($db,$router){
    $userPosts = $db->getPost(currentUser('email'));

    return $router->renderOnlyView('posts',[
        'userPosts' => $userPosts
    ]);
});

$router->get('/posts', function() use($db,$router){
    $posts = $db->getAllPost();

    return $router->renderOnlyView('allposts',[
        'posts' => $posts
    ]);
});
$router->get('/author', 'author');
$router->get('/contact', 'contact');
$router->get('/login', 'login');
$router->get('/signup', 'signup');


$router->get('/logout', function(){
    session_unset();
    session_destroy();
    redirect('/');
});


$router->post('/signup', function (IRequest $request) use ($db,$router) {

    $body = $request->getBody();
    $validateError = validateSignup($body['name'],$body['lastname'],$body['username'],$body['email'], $body['password'] ,$body['passwordRep']);

    if(!empty($validateError['name'])||!empty($validateError['lastname'])||!empty($validateError['username'])||!empty($validateError['email'])||!empty($validateError['password'])||!empty($validateError['passwordRep'])){
        return $router->renderOnlyView('signup',[
            'validateError' => [
                'name' => $validateError['name'],
                'lastname' => $validateError['lastname'],
                'username' => $validateError['username'],
                'email' => $validateError['email'],
                'password' => $validateError['password'],
                'passwordRep' => $validateError['passwordRep']
            ],
            'data' => [
                'name' => $body['name'],
                'lastname' => $body['lastname'],
                'username' => $body['username'],
                'email' => $body['email'],
                'password' => $body['password'],
                'passwordRep' => $body['passwordRep']
            ]
        ]);
    }
    else{

        if ($db->signUpUser($body['name'],$body['lastname'],$body['username'],$body['email'],$_FILES['picture']['name'],$body['password'])) {
            uploadImg();
            redirect('/');
        }
        else {
            return $router->renderOnlyView('signup',[
                'error' => "Email Or Username Is Already Exist",
                'data' => [
                    'name' => $body['name'],
                    'lastname' => $body['lastname'],
                    'username' => $body['username'],
                    'email' => $body['email'],
                    'password' => $body['password'],
                    'passwordRep' => $body['passwordRep']
                ]
            ]);
        }
    }
});



$router->post('/login', function (IRequest $request) use ($db,$router) {

    $body = $request->getBody();

    $validateError = validateLogin($body['email'],$body['password']);


    if(!empty($validateError['email'])||!empty($validateError['password'])){
        return $router->renderOnlyView('login',[
            'validateError' => [
                'email' => $validateError['email'],
                'password' => $validateError['password'],
            ],
            'data' => [
                'email' => $body['email'],
                'password' => $body['password']
            ]
        ]);
    }
    else{
        if ($db->loginUser($body['email'], $body['password'])) {
            redirect('/');
        } else {
            return $router->renderOnlyView('login',[
                'error' => "Email Or Password Is incorrect",
                'data' => [
                    'email' => $body['email'],
                    'password' => $body['password']
                ]
            ]);
        }
    }
});



$router->post('/contact', function (IRequest $request) use ($router) {

    $body = $request->getBody();

    $validateError = validateContact($body['fullname'],$body['email'],$body['subject'],$body['message']);

    if(!empty($validateError['fullname'])||!empty($validateError['email'])||!empty($validateError['subject'])||!empty($validateError['message'])){
        return $router->renderOnlyView('contact',[
            'validateError' => [
                'fullname' => $validateError['fullname'],
                'email' => $validateError['email'],
                'subject' => $validateError['password'],
                'message' => $validateError['message']
            ],
            'data' => [
                'fullname' => $body['fullname'],
                'email' => $body['email'],
                'subject' => $body['subject'],
                'message' => $validateError['message'],
            ]
        ]);
    }
    else{
        sendMail();
        redirect('/');
    }
});


$router->post('/profile/edit', function (IRequest $request) use ($db,$router) {

    $body = $request->getBody();
    $validateError = validateEdit($body['name'],$body['lastname'],$body['password'],$body['passwordRep']);

    if(!empty($validateError['name'])||!empty($validateError['lastname'])||!empty($validateError['password'])||!empty($validateError['passwordRep'])){
        return $router->renderOnlyView('edit',[
            'validateError' => [
                'name' => $validateError['name'],
                'lastname' => $validateError['lastname'],
                'password' => $validateError['password'],
                'passwordRep' => $validateError['passwordRep']
            ],
            'data' => [
                'name' => $body['name'],
                'lastname' => $body['lastname'],
                'password' => $body['password'],
                'passwordRep' => $body['passwordRep']
            ]
        ]);
    }
    else{
        $db->editUser(currentUser('email'),$body['name'],$body['lastname'],$body['password'],$body['passwordRep']);
        redirect('/profile');
    }
});

$router->post('/profile/posts', function (IRequest $request) use ($db,$router) {

    $body = $request->getBody();

    $db->setPost(currentUser('email'),$body['postName'],$body['postBody']);

    redirect('/profile/posts');

});

$router->post('/games/rollDice',function (IRequest $request) use ($db,$router){

    rollDice();
    $db->setCristal(currentUser('email'),currentUser('cristal'));

    //JSON -დან მონაცემების წამოღება ცვლადში მასივის სახით
    $jsonString = file_get_contents(__DIR__.'/public/games/rollDice.json');
    $users = json_decode($jsonString,true);

    $userDie1 = $users['userDie1'];
    $userDie2 = $users['userDie2'];
    $compueterDie1 = $users['computerDie1'];
    $compueterDie2 = $users['computerDie2'];
    $userTotal = $users['userTotal'];
    $computerTotal = $users['computerTotal'];
    $double = $users['double'];
    $sumUp = $users['sumUp'];
    $currentWin = $users['currentWin'];

    return $router->renderOnlyView('/games/rollDice',[
        'userDie1' => $userDie1,
        'userDie2' => $userDie2,
        'computerDie1' => $compueterDie1,
        'computerDie2' => $compueterDie2,
        'userTotal' => $userTotal,
        'computerTotal' => $computerTotal,
        'double' => $double,
        'sumUp' => $sumUp,
        'currentWin' => $currentWin,
    ]);
});

$router->post('/games/luckyNumber',function (IRequest $request) use ($db,$router){

    luckyNumber();
    $db->setCristal(currentUser('email'),currentUser('cristal'));

    //JSON -დან მონაცემების წამოღება ცვლადში მასივის სახით
    $jsonString = file_get_contents(__DIR__.'/public/games/luckyNumber.json');
    $users = json_decode($jsonString,true);

    $rand = $users['rand'];
    $currentWin = $users['currentWin'];

    return $router->renderOnlyView('/games/luckyNumber',[
        'rand' => $rand,
        'currentWin' => $currentWin
    ]);
});

$router->post('/games/slotMachine',function (IRequest $request) use ($db,$router){

    slot();
    $db->setCristal(currentUser('email'),currentUser('cristal'));

    //JSON -დან მონაცემების წამოღება ცვლადში მასივის სახით
    $jsonString = file_get_contents(__DIR__.'/public/games/slotMachine.json');
    $users = json_decode($jsonString,true);

    $sumUp = $users['sumUp'];
    $slot1 = $users['slot1'];
    $slot2 = $users['slot2'];
    $slot3 = $users['slot3'];

    return $router->renderOnlyView('/games/slotMachine',[
        'sumUp' => $sumUp,
        'slot1' => $slot1,
        'slot2' => $slot2,
        'slot3' => $slot3
    ]);

});





