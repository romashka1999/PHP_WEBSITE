<?php

function uploadImg()
{
    if(!is_dir(__DIR__.'/bin/public/userimage'))
    {
        mkdir(__DIR__.'/bin/public/userimage');
    }
    $fileName = $_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'],__DIR__."/bin/public/userimage/$fileName");

    unset($_FILES['picture']);
}

function sendMail()
{
    $mailFrom = "r_chikhladze@cu.edu.ge";
    $mailTo = "roma.chikhladze777@gmail.com";
    $subject ="sagani";
    $message ="mesijiiii";
    $fullname ="afsadf";

    $headers = array(
        'Authorization: Bearer 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',
        'Content-Type: application/json'
    );

    $data = array(
        "personalizations" => array(
            array(
                "to" => array(
                    array(
                        "email" => $mailTo,
                        "name" => $fullname
                    )
                )
            )
        ),
        "from" => array(
            "email" => $mailFrom
        ),
        "subject" => $subject,
        "content" => array(
            array(
                "type" => "text/html",
                "value" => $message
            )
        )
    );

    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,"https://api.sendgrid.com/v3/mail/send");
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
}
?>