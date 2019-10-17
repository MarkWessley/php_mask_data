<!DOCTYPE html>
<!--
    Created by Mark Wessley
    October 2019
    Create a function that will mask credit card data in various formats
-->
<html>
<body>

<?php
//Example 1
$str1 = "[orderId] => 212939129
[orderNumber] => INV10001
[salesTax] => 1.00
[amount] => 21.00
[terminal] => 5
[currency] => 1
[type] => purchase
[avsStreet] => 123 Road
[avsZip] => A1A 2B2
[customerCode] => CST1001
[cardId] => 18951828182
[cardHolderName] => John Smith
[cardNumber] => 5454545454545454
[cardExpiry] => 1025
[cardCVV] => 100";
  
function maskExample1($str) {
    $str = trim($str, "[]");
    $str = (str_replace(" \r\n","&",$str));
    $str = (str_replace("[", "&", $str));
    $str = (str_replace("] => ", "=", $str));
    parse_str($str, $arr1);
    //newArray
    $newArr1 = array(
        'cardNumber' => $arr1['cardNumber'], 
        'cardExpiry' => $arr1['cardExpiry'],
        'cardCVV' => $arr1['cardCVV']
    );

    //mask sensitive data  
    foreach ($newArr1 as $key => $value) {
            $CardMask = mask($value, null, strlen($value));
            $cMask = ("$key=$CardMask"); //new string
            parse_str($cMask, $arrcMask); //new array
            $cardKey = $key;
            if ($cardKey == 'cardNumber') {
                $arrcNum1 = $arrcMask;
            } 
            elseif ($cardKey == 'cardExpiry') {
                $arrcExp1 = $arrcMask;
            } 
            elseif ($cardKey == 'cardCVV') {
                $arrcCVV1 = $arrcMask;
            } 
            else {
                echo "Error";
            }
    }
    $array1 = array_replace($arr1, $arrcNum1, $arrcExp1, $arrcCVV1);
        $str1 = http_build_query($array1);
        $str1 = urldecode($str1);
        $str1 = (str_replace("=", "] => ", $str1));
        $str1 = (str_replace("&", " \r\n[", $str1));
        $str1 = ("[" . $str1 .= "]");
        echo $str1;
  }//function maskExample1

  //Example 2
$str2 = ("Request=Credit Card.Auth Only&Version=4022&HD.Network_Status_Byte=*&HD.Application_ID=TZAHSK!&HD.Terminal_ID=12991kakajsjas&HD.Device_Tag=000123&07.POS_Entry_Capability=1&07.PIN_Entry_Capability=0&07.CAT_Indicator=0&07.Terminal_Type=4&07.Account_Entry_Mode=1&07.Partial_Auth_Indicator=0&07.Account_Card_Number=4242424242424242&07.Account_Expiry=1024&07.Transaction_Amount=142931&07.Association_Token_Indicator=0&17.CVV=200&17.Street_Address=123 Road SW&17.Postal_Zip_Code=90210&17.Invoice_Number=INV19291");

function maskExample2($str) {
    $numbers = array('07.', '17.');
    $blank = array('seven', 'oneseven');
    $str_rep = str_replace($numbers, $blank, $str);  
    parse_str($str_rep, $arr2);
    //15newArray
    $newArr2 = array(
        'sevenAccount_Card_Number' => $arr2['sevenAccount_Card_Number'], 
        'sevenAccount_Expiry' => $arr2['sevenAccount_Expiry'],
        'onesevenCVV' => $arr2['onesevenCVV']
    );

    //mask sensitive data  
    foreach ($newArr2 as $key => $value) {
            $CardMask = mask($value, null, strlen($value));
            $cMask = ("$key=$CardMask"); //new string
            parse_str($cMask, $arrcMask); //new array
            $cardKey = $key;
            if ($cardKey == 'sevenAccount_Card_Number') {
                $arrcNum2 = $arrcMask;
            } 
            elseif ($cardKey == 'sevenAccount_Expiry') {
                $arrcExp2 = $arrcMask;
            } 
            elseif ($cardKey == 'onesevenCVV') {
                $arrcCVV2 = $arrcMask;
            } 
            else {
                echo "Error";
            }
    }
        $array2 = array_replace($arr2, $arrcNum2, $arrcExp2, $arrcCVV2);
        $str2 = http_build_query($array2);
        $str2 = str_replace("seven", "07.", $str2);
        $str2 = str_replace("oneseven", "17.", $str2);
        echo urldecode($str2);
  }
//Example 3
  $str3 = '{
    "MsgTypId": 111231232300,
    "CardNumber": "4242424242424242",
    "CardExp": "1024",
    "CardCVV": "240",
    "TransProcCd": "004800",
    "TransAmt": "57608",
    "MerSysTraceAudNbr": "456211",
    "TransTs": "180603162242",
    "AcqInstCtryCd": "840",
    "FuncCd": "100",
    "MsgRsnCd": "1900",
    "MerCtgyCd": "5013",
    "AprvCdLgth": "6",
    "RtrvRefNbr": "1029301923091239"
}';

function maskExample3($str) {
    //convert string3 to array
    $str = trim($str, "{}");
    $str = (str_replace(",\r\n", "&", $str));
    $str = (str_replace(": ", "=", $str));
    $str = (str_replace(" ", "", $str));
    parse_str($str, $arr3);
    
    //newArray
    $newArr3 = array(
        '"CardNumber"' => $arr3['"CardNumber"'], 
        '"CardExp"' => $arr3['"CardExp"'],
        '"CardCVV"' => $arr3['"CardCVV"']
    );

    //mask sensitive data  
    foreach ($newArr3 as $key => $value) {
            $CardMask = mask($value, null, strlen($value));
            $cMask = ("$key=$CardMask"); //new string
            parse_str($cMask, $arrcMask); //new array
            $cardKey = $key;
            if ($cardKey == '"CardNumber"') {
                $arrcNum3 = $arrcMask;
            } 
            elseif ($cardKey == '"CardExp"') {
                $arrcExp3 = $arrcMask;
            } 
            elseif ($cardKey == '"CardCVV"') {
                $arrcCVV3 = $arrcMask;
            } 
            else {
                echo "Error";
            }
    }
    $array3 = array_replace($arr3, $arrcNum3, $arrcExp3, $arrcCVV3);
        $str3 = http_build_query($array3);
        $str3 = urldecode($str3);
        $str3 = (str_replace("&", ",\r\n" ,$str3));
        $str3 = (str_replace("=", ": ",  $str3));
        $str3 = ("{" . $str3 .= "}");
        echo $str3;
  }

  //Example 4
$str4 =
"<?xml version='1.0' encoding='UTF-8'?>
<Request>
	<NewOrder>
		<IndustryType>MO</IndustryType>
		<MessageType>AC</MessageType>
		<BIN>000001</BIN>
		<MerchantID>209238</MerchantID>
		<TerminalID>001</TerminalID>
		<CardBrand>VI</CardBrand>
		<CardDataNumber>5454545454545454</CardDataNumber>
		<Exp>1026</Exp>
		<CVVCVCSecurity>300</CVVCVCSecurity>
		<CurrencyCode>124</CurrencyCode>
		<CurrencyExponent>2</CurrencyExponent>
		<AVSzip>A2B3C3</AVSzip>
		<AVSaddress1>2010 Road SW</AVSaddress1>
		<AVScity>Calgary</AVScity>
		<AVSstate>AB</AVSstate>
		<AVSname>JOHN R SMITH</AVSname>
		<OrderID>23123INV09123</OrderID>
		<Amount>127790</Amount>
	</NewOrder>
</Request>";

function maskExample4($str) {
$xml=simplexml_load_string($str) or die("Error: Cannot create object");
foreach($xml->children() as $NewOrder) {
    $numXML = $NewOrder->CardDataNumber;
    $expXML = $NewOrder->Exp;
    $cvvXML = $NewOrder->CVVCVCSecurity;
    $xmlArr = array (

        'CardDataNumber' => $numXML,
        'Exp' => $expXML,
        'CVVCVCSecurity' => $cvvXML
    );
}

    foreach ($xmlArr as $key => $value) {
        $CardMask = mask($value, null, strlen($value));
        $cMask = ("$key=$CardMask"); //new string
        parse_str($cMask, $arrcMask); //new array
        $cardKey = $key;
        if ($cardKey == 'CardDataNumber') {
            $cnumXML = $CardMask;
        } 
        elseif ($cardKey == 'Exp') {
            $cexpXML = $CardMask;
        } 
        elseif ($cardKey == 'CVVCVCSecurity') {
            $ccvvXML = $CardMask;
        } 
        else {
            echo "Error";
        }
    }
    
    $xml->NewOrder->CardDataNumber = $cnumXML;
    $xml->NewOrder->Exp = $cexpXML;
    $xml->NewOrder->CVVCVCSecurity = $ccvvXML;

    print_r($xml);
}


echo "Example 1<br>";
maskExample1($str1);
echo "<br><br>Example 2<br>";
maskExample2($str2);
echo "<br><br>Example 3<br>";
maskExample3($str3);
echo "<br><br>Example 4<br>";
maskExample4($str4);



function mask($str, $start = 0, $length = null)
    {
        $mask = preg_replace("/\S/", "*", $str);
        if (is_null($length)) {
            $mask = substr($mask, $start, $length);
            $str3 = substr_replace($str, $mask, $start);
        } else {
            $mask = substr($mask, $start, $length);
            $str = substr_replace($str, $mask, $start, $length);
        }
        return $str;
    }
?>
 
</body>
</html>
