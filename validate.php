<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateSignup($name,$lastname,$username,$email,$password,$passwordRep)
{

    $name_error = $lastname_error = $username_error = $email_error = $password_error = $passwordRep_error = "";
    $errors['name'] = $errors['lastname'] = $errors['username'] = $errors['email'] = $errors['password'] = $errors['passwordRep'] = "";
    if (empty($name)) {
        $name_error = "Name is required";
        $errors['name'] = $name_error;
    } else {
        $name = test_input($name);
        // check if name only contains letters
        if (!preg_match("/[a-zA-Z ]/",$name)) {
            $name_error = "Only letters allowed";
            $errors['name'] = $name_error;
        }
    }

    if (empty($lastname)) {
        $lastname_error = "Lastname is required";
        $errors['lastname'] = $lastname_error;
    } else {
        $lastname = test_input($lastname);
        // check if name only contains letters
        if (!preg_match("/[a-zA-Z ]/",$lastname)) {
            $lastname_error = "Only letters allowed";
            $errors['lastname'] = $lastname_error;
        }
    }

    if (empty($username)) {
        $username_error = "Username is required";
        $errors['username'] = $username_error;
    } else {
        $username = test_input($username);
        /*
            Only contains alphanumeric characters, underscore and dot.
            Underscore and dot can't be at the end or start of a username (e.g _username / username_ / .username / username.).
            Underscore and dot can't be next to each other (e.g user_.name).
            Underscore or dot can't be used multiple times in a row (e.g user__name / user..name).
            Number of characters must be between 8 to 20.
        */
        if (!preg_match("/^[a-zA-Z0-9]+([._]?[a-zA-Z0-9]+)*$/",$username)) {
            $username_error = "Only alphanumeric characters, underscore and dot allowed";
            $errors['username'] = $username_error;
        }
    }

    if (empty($email)) {
        $email_error = "Email is required";
        $errors['email'] = $email_error;
    } else {
        $email = test_input($email);
        //emil vallidate to be well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
            $errors['email'] = $email_error;
        }
    }

    if (empty($password)) {
        $password_error = "Password is required";
        $errors['password'] = $password_error;
    } else {
        $password = test_input($password);
        /*
            A password contains at least eight characters, including at least one
            number and includes both lower and uppercase letters and special characters, for example #, ?, !.
            It cannot be your old password or contain your username, "password", or "websitename"
            And here is my validation expression which is for eight characters including
            one uppercase letter, one lowercase letter, and one number or special character.
        */
        if (!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$password)) {
            $password_error = "password must has one uppercase letter, one lowercase letter, and one number or special character";
            $errors['password'] = $password_error;
        }
    }

    if (empty($passwordRep)) {
        $passwordRep_error = "Password Repeat is required";
        $errors['passwordRep'] = $passwordRep_error;
    } else {
        $passwordRep = test_input($passwordRep);
        /*
            if does not math to pass
        */
        if ($passwordRep!=$password) {
            $passwordRep_error = "Repeated Password Does Not Match To pass";
            $errors['passwordRep'] = $passwordRep_error;
        }
    }

    return $errors;
}

function validateLogin($email,$password)
{

    $email_error = $password_error = "";

    $errors['email'] = $errors['password'] = "";

    if (empty($email)) {
        $email_error = "Email is required";
        $errors['email'] = $email_error;
    } else {
        $email = test_input($email);
        //emil vallidate to be well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
            $errors['email'] = $email_error;
        }
    }

    if (empty($password)) {
        $password_error = "Password is required";
        $errors['password'] = $password_error;
    } else {
        $password = test_input($password);
        /*
            A password contains at least eight characters, including at least one
            number and includes both lower and uppercase letters and special characters, for example #, ?, !.
            It cannot be your old password or contain your username, "password", or "websitename"
            And here is my validation expression which is for eight characters including
            one uppercase letter, one lowercase letter, and one number or special character.
        */
        if (!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$password)) {
            $password_error = "password must has one uppercase letter, one lowercase letter, and one number or special character";
            $errors['password'] = $password_error;
        }
    }
    return $errors;
}

function validateContact($fullname,$email,$subject,$message)
{

    $fullname_error = $email_error = $subject_error = $message_error = "";

    $errors['fullname'] = $errors['email'] = $errors['subject'] = $errors['message'] = "";

    if (empty($fullname)) {
        $fullname_error = "fullname is required";
        $errors['fullname'] = $fullname_error;
    } else {
        $fullname = test_input($fullname);
        // check if name only contains letters
        if (!preg_match("/[a-zA-Z ]/",$fullname)) {
            $fullname_error = "Only letters allowed";
            $errors['fullname'] = $fullname_error;
        }
    }

    if (empty($email)) {
        $email_error = "Email is required";
        $errors['email'] = $email_error;
    } else {
        $email = test_input($email);
        //emil vallidate to be well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
            $errors['email'] = $email_error;
        }
    }

    if (empty($subject)) {
        $subject_error = "Subject is required";
        $errors['subject'] = $subject_error;
    } else {
        $subject = test_input($subject);
        // check if name only contains letters
        if (!preg_match("/[a-zA-Z]/",$subject)) {
            $subject_error = "Only letters allowed";
            $errors['subject'] = $subject_error;
        }
    }

    if (empty($message)) {
        $message_error = "Message is required";
        $errors['message'] = $message_error;
    }

    return $errors;

}

function validateEdit($name,$lastname,$password,$passwordRep)
{

    $name_error = $lastname_error =  $password_error = $passwordRep_error = "";
    $errors['name'] = $errors['lastname'] = $errors['password'] = $errors['passwordRep'] = "";

    if (empty($name)) {
        $name_error = "Name is required";
        $errors['name'] = $name_error;
    } else {
        $name = test_input($name);
        // check if name only contains letters
        if (!preg_match("/[a-zA-Z ]/",$name)) {
            $name_error = "Only letters allowed";
            $errors['name'] = $name_error;
        }
    }

    if (empty($lastname)) {
        $lastname_error = "Lastname is required";
        $errors['lastname'] = $lastname_error;
    } else {
        $lastname = test_input($lastname);
        // check if name only contains letters
        if (!preg_match("/[a-zA-Z ]/",$lastname)) {
            $lastname_error = "Only letters allowed";
            $errors['lastname'] = $lastname_error;
        }
    }

    if (empty($password)) {
        $password_error = "Password is required";
        $errors['password'] = $password_error;
    } else {
        $password = test_input($password);
        /*
            A password contains at least eight characters, including at least one
            number and includes both lower and uppercase letters and special characters, for example #, ?, !.
            It cannot be your old password or contain your username, "password", or "websitename"
            And here is my validation expression which is for eight characters including
            one uppercase letter, one lowercase letter, and one number or special character.
        */
        if (!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$password)) {
            $password_error = "password must has one uppercase letter, one lowercase letter, and one number or special character";
            $errors['password'] = $password_error;
        }
    }

    if (empty($passwordRep)) {
        $passwordRep_error = "Password Repeat is required";
        $errors['passwordRep'] = $passwordRep_error;
    } else {
        $passwordRep = test_input($passwordRep);
        /*
            if does not math to pass
        */
        if ($passwordRep!=$password) {
            $passwordRep_error = "Repeated Password Does Not Match To pass";
            $errors['passwordRep'] = $passwordRep_error;
        }
    }

    return $errors;
}

?>