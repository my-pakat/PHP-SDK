#How To Use

Fill the defines in bottom of Pakat.php with your app information

First: `include "Pakat.php";`

Next: `$Pakat = new Pakat("{CALLBACK_URL}");`

Point: Please login to pakat website and register your application and get private key and public key and developer key


#newLink();
    $link = $Pakat->newLink();
This Method make login link on the response back to you a url `$link->url` you should transfer user in to this link

Point: Set callback url carefully

#checkRequest($LoginToken, $DeveloperHash); and getUserData($LoginToken);
    `$LoginToken = $_GET['login_token'];
    
    $DeveloperHash = $_GET['developer_hash'];
    
    $check = $Pakat->checkRequest($LoginToken, $DeveloperHash);
    
    if($check) {
    
        // Get User Data 
    
        $userData = getUserData($LoginToken);
    
    } else {
    
        die("Sorry, login token not valid");
    
    }`
   
