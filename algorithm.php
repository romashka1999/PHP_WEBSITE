<?php
require_once 'helpers.php';

function rollDice()
{
    //სესიებიდან წამოღებული კრისტალების რაოდენობა
    $userCurrentCristal = currentUser('cristal');

    //როდესც ღილაკს დააჭერს მომხმარებელი
    $userCurrentCristal --;

    //ფუნქცია დააბრუნებს რანდომულად 1 - 6 მომხმარებლისთვის
    function getUserRandom(){
        return rand(1,6);
    }

    //ფუნქცია დააბრუნებს რანდომულად 4 - 6 კომპიუტერისთვის
    function getcomputerRandom(){
        return rand(4,6);
    }

    $double = null;
    $sumUp = null;
    $currentWin = null;

    $userDie1 = getUserRandom();
    $userDie2 = getUserRandom();
    $userTotal = $userDie1 + $userDie2;

    $compueterDie1 = getcomputerRandom();
    $compueterDie2 = getcomputerRandom();
    $ComputerTotal = $compueterDie1 + $compueterDie2;

    if($userDie1 == $userDie2){
        $double = true;
    }
    $draw = false;

    if($userTotal > $ComputerTotal){
        $sumUp = 'You Won';
        if($double == true){
            $currentWin = $userTotal * $userDie1;
        }
        else{
            $currentWin = $userTotal;
        }
    }
    else {
        if($userTotal == $ComputerTotal){
            $sumUp = 'This Is Draw';
            $currentWin = 0;
        }
        else{
            $sumUp = 'You Lose';
            $currentWin = 0;
        }
    }
    //მიმდინარე მოგებას ვუმატებთ მიმდინარე მომხმარებლის კრისტალების რაოდენობას
    $userCurrentCristal = $userCurrentCristal + $currentWin;

    //ჩავაბრუნოთ კრისტალების ცვლილება სესიებში
    $_SESSION['currentUser']['cristal'] = $userCurrentCristal;

    $users['userDie1'] = $userDie1;
    $users['userDie2'] = $userDie2;
    $users['userTotal'] = $userTotal;
    $users['computerDie1'] = $compueterDie1;
    $users['computerDie2'] = $compueterDie2;
    $users['computerTotal'] = $ComputerTotal;
    $users['currentWin'] = $currentWin;
    $users['sumUp'] = $sumUp;
    $users['double'] = $double;

    //JSON -ში ვსვამთ მონაცემებს , რომელებიც განვაახლეთ
    $arrForJson = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents( __DIR__.'/bin/public/games/rollDice.json', $arrForJson);

}

function luckyNumber()
{
    //სესიებიდან წამოღებული კრისტალების რაოდენობა
    $userCurrentCristal = currentUser('cristal');

    //როდესც ღილაკს დააჭერს მომხმარებელი
    $userCurrentCristal --;

    //ფუნქცია დააბრუნებს რანდომულად 1 - 10000
    function getRandom(){
        return rand(1,10000);
    }

    //ცვლადში ვინახავთ რანდომულ რიცხვს 1 -10000
    $rand = getRandom();


    //შემუშავებული ალგორითმი
    if($rand<=9800){
        $currentWin = 0;
    }
    else {
        if($rand<=9900){
            $currentWin = 10;
        }
        else{
            if($rand<=9950){
                $currentWin = 50;
            }
            else{
                if($rand<=9999){
                    $currentWin = 100;
                }
                else{
                    $currentWin = 1000;
                }
            }
        }
    }


    $users['rand'] = $rand;
    $users['currentWin'] = $currentWin;

    //მიმდინარე მოგებას ვუმატებთ მიმდინარე მომხმარებლის კრისტალების რაოდენობას
    $userCurrentCristal = $userCurrentCristal + $currentWin;

    //ჩავაბრუნოთ კრისტალების ცვლილება სესიებში
    $_SESSION['currentUser']['cristal'] = $userCurrentCristal;

    //JSON -ში ვსვამთ მონაცემებს , რომელებიც განვაახლეთ
    $arrForJson = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents( __DIR__.'/bin/public/games/luckyNumber.json', $arrForJson);

}

function slot()
{
    //სესიებიდან წამოღებული კრისტალების რაოდენობა
    $userCurrentCristal = currentUser('cristal');

    //მომხმარებლის მიმდინარე კრისტალების რაოდენობა შევამციროთ რადგან დავაჭირეთ ღილაკს
    $userCurrentCristal --;

    //ფუნქცია დააბრუნებს რანდომულად 1 - 7
    function getRandom(){
        return rand(1,7);
    }

    $slot1 = getRandom();
    $slot2 = getRandom();
    $slot3 = getRandom();

    $currentWin = null;

    if($slot1 == $slot2 && $slot1 == $slot3){
        $sumUp = "You Win";
        switch($slot1){
            case 1 : $currentWin = 1 ;
                break;
            case 2 : $currentWin = 2 ;
                break;
            case 3 : $currentWin = 3 ;
                break;
            case 4 : $currentWin = 4 ;
                break;
            case 5 : $currentWin = 5 ;
                break;
            case 6 : $currentWin = 10 ;
                break;
            default: $currentWin = 100 ;
        }
    }
    else{
        $sumUp = "You Lose";
        $currentWin = 0;
    }

    //მიმდინარე მოგებას ვუმატებთ მიმდინარე მომხმარებლის კრისტალების რაოდენობას
    $userCurrentCristal = $userCurrentCristal + $currentWin;

    //ჩავაბრუნოთ კრისტალების ცვლილება სესიებში
    $_SESSION['currentUser']['cristal'] = $userCurrentCristal;


    $users['sumUp'] = $sumUp;
    $users['slot1'] = $slot1;
    $users['slot2'] = $slot2;
    $users['slot3'] = $slot3;

    //JSON -ში ვსვამთ მონაცემებს , რომელებიც განვაახლეთ
    $arrForJson = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents( __DIR__.'/bin/public/games/slotMachine.json', $arrForJson);

}

?>