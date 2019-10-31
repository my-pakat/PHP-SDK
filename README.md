 # How to USE
 
 1. Download This Repository
 2/1. Open Pakat.php 
 2/2. Register your application in my-pakat.ir
 2/3. Copy your application token
 3. Replace your application token "{{PAKAT_APPLICATION_TOKEN}}"
 4.You can use the code right now
 
 # Usage
    require_once = "Pakat.php";
    $Pakat = new Pakat();

 # $Pakat->requestForInformation($pakat_id);
in the first step you get user pakat id and send request with top function to pakat and send user pakat Id
you got a Array response from this function with below parameter 
if the request response is true you take this 
    {
        "ok": true,
        "result": [
            "message": ['fa': "پیام", "en": "The Message"]
        ]
    }
if the request response is false
    {
        "ok": false,
        "error": [
            "code": (INT),
            "message": ["fa": "پیام", "en": "Message"]
        ]
    }
  
after get true response you Pakat send a message to pakat ID you sent or take you a user_hash (If user logged in the past)
then you should take the verification code from user and use the verifyPakatId()

 # $Pakat->verifyPakatId($pakat_id, $verify_code);
 you send pakat Id and verification code to pakat and then if the verification code is correct the pakat take you a user_hash and if verification code isn't correct you take error from pakat
 
 
  # $Pakat->getUserInformation($user_hash);
  now you can get user information with user_hash
  
