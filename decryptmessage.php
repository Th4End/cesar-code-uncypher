<?php
error_reporting(0);

function calculeFrequence($text) 
{
    $frequence = array_fill(0, 26, 0);
    for ($i = 0; $i < strlen($text); $i++) 
    {
        $char = strtolower($text[$i]);
        if (ord($char) >= 97 && ord($char) <= 122) 
        {
            $frequence[ord($char) - 97]++;
        }
    }
    return $frequence;
}

function decryptMessage($msgcrypt) 
{
    $frequence = calculeFrequence($msgcrypt);
    $maxrecurrence = max($frequence);
    $maxIndex = array_search($maxrecurrence, $frequence);
    $shift = 4 - $maxIndex;
    $decryptmsg = "";
    for ($i = 0; $i < strlen($msgcrypt); $i++) 
    {
        $char = $msgcrypt[$i];
        $ascii = ord($char);
        if ($ascii >= 65 && $ascii <= 90) 
        {
            $shifted_ascii = ($ascii - 65 + $shift) % 26 + 65;
            $decryptmsg .= chr($shifted_ascii);
        } 
        else if ($ascii >= 97 && $ascii <= 122) 
        {
            $shifted_ascii = ($ascii - 97 + $shift) % 26 + 97;
            $decryptmsg .= chr($shifted_ascii);
        } 
        else 
        {
            $decryptmsg .= $char;
        }
    }
    return $decryptmsg;
}

$msgcrypt =$_POST["msgcrypt"];
$decryptmsg = decryptMessage($msgcrypt);
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style.css" type="text/css"/>
<head>
    <title>Décryptage de message</title>
</head>
<body>
    <h1>Déchiffrage de message pour code de césar</h1>
    <form action="" method="post">
        <input type="text" name="msgcrypt" id="msgcrypt" placeholder="message chiffré par césar" required autocomplete="off">
        <input type="submit" value="Décrypter">
        <input type="reset" value="annuler">
    </form>
    <h2>Message chiffré</h2>
    <?php echo $msgcrypt;?>
    <h2>Message en clair :</h2>
    <p><?php echo $decryptmsg; ?></p>
</body>
</html>