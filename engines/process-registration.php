<?php
    require_once '../bootstrap.php';
    /** @var DatabaseHelper $dbh */
    use Respect\Validation\Validator as v;

    const ERROR_USERNAME = "Username/Mail già presente nel sistema!";
    const ERROR_DB = "Errore nel sistema! Riprova...";
    const SUCCESS = "Registrazione avvenuta con successo!";

    if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["birthday"]) &&
        isset($_POST["usr"]) && isset($_POST["email"]) && isset($_POST["pwd"])) {
        $result = [];
        validate();
        // generate random salt
        $salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        $password = hash('sha512', $_POST["pwd"].$salt);
        // add to db new user
        $res = $dbh->addCustomer($_POST["usr"], $password, $salt, 
            $_POST["name"], $_POST["surname"], $_POST["birthday"], $_POST["email"]);
        if ($res === 0) {
            $result["success"] = SUCCESS;
        } else if ($res === MYSQLI_CODE_DUPLICATE_KEY) {
            $result["error"] = ERROR_USERNAME;
        } else { // other type of error
            $result["error"] = ERROR_DB;
        }
        echo json_encode($result);
    }

    /**
     * Validates the user input. If some errors occurred return the message error.
     * @return void
     */
    function validate() {
        $rules = array (
            'name'      => v::stringType()->notEmpty(),
            'date'      => v::date()->notEmpty(),
            'mail'      => v::email()->notEmpty(),
            // The password was already hashed by the javascript :)
            'password'  => v::StringVal()->notEmpty(),
        );
        $dataDic = array (
            'name'      => [$_POST['name'], $_POST['surname'], $_POST['usr']],
            'date'      => [$_POST['birthday']],
            'mail'      => [$_POST['email']],
            'password'  => [$_POST['pwd']]
        );
        list($tmp, $msg) = validateInput($rules, $dataDic);
        if (!$tmp) {
            $result["error"] = $msg;
            echo json_encode($result);
            exit(1);
        }
    }

    /*
     * TODO @NalNemesi - CHANGE PASSWORD PROCESS
     * This is just the skeleton to put in the section where is done the password update.
     * ** Be careful! This procedure has not been tested yet! **
     * Be aware that the new password (here $_POST["pwd"], but can be changed by passing it as a parameter
     * to a function) **MUST** be previously hashed with hex_sha512() with JavaScript!
     * See login.js / login-form.js
     */
//    if (isset($_POST["pwd"]) && isUserLoggedIn()) {
//        $salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
//        $password = hash('sha512', $_POST["pwd"].$salt);
//        $res = $dbh->updateUserPassword($_SESSION['userid'], $salt, $password);
//        // in $res the result of the query
//    }

?>