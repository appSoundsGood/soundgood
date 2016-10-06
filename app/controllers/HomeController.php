<?php

use PhpImap\Mailbox as ImapMailbox;
use PhpImap\IncomingMail;
use PhpImap\IncomingMailAttachment;

use ReciptIngredient as ReciptIngredientModel;
use Customer as CustomerModel;
use Recipt as ReciptModel;
use ReciptProduct as ReciptProductModel;
use Product as ProductModel;
use CustomerProduct as CustomerProductModel;
use Cabinet as CabinetModel;

class HomeController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |    Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function cronJob()
    {
        /*$mailbox = new PhpImap\Mailbox('{imap.gmail.com:993/imap/ssl}INBOX', 'appsoundsgood@gmail.com', 'culinaryrevolution' , __DIR__);
        
        $mailsIds = $mailbox->searchMailbox('ALL');
        $mail = $mailbox->getMail($mailsIds[count($mailsIds)-1]["textHtml"]);
        //$message = imap_fetchbody($mailbox,4,1.2);
        
        if(!$mailsIds) {
            die('Mailbox is empty');
        }
        var_dump($mail);
        echo "<br>\n<br>\n<br>\n<br>\n<br>\n";  */
        set_time_limit(4000);
        
        $mailbox = new PhpImap\Mailbox('{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX', RECEIPT_MAIL_ADDR, RECEIPT_MAIL_PASSWORD , __DIR__);
        $mailsIds = $mailbox->searchMailbox('UNDELETED');
        
        echo "Mail Count: ". count($mailsIds). "<br><br>\n";
        if (count($mailsIds) == 0) {
        	echo "Mailbox is empty<br>\n";
        	return;
        }

        for($j = 0 ; $j < count($mailsIds); $j++) {
            $mail = $mailbox->getMail($mailsIds[$j]);
            
            echo " - Subject: ". $mail->subject. "  Date: ". $mail->date. "<br>\n"; 
        
            $dom = new DOMDocument();
            $string = $mail->textHtml;
            
            @$dom->loadHTML($string);
            $xpath = new DOMXpath($dom);
            
            $ret = $xpath->query('//td');
            
            /// get recipt number
            //$reciptcode is result
            $reciptCode = "";
            $count = 0; //initial count of account
            $ingreArr = array();
            $prices = array();
            
            for($i = 6 ;$i < $ret->length ;$i++){
                $code = htmlentities($ret->item($i)->nodeValue , null, 'utf-8');
                $codeForArray = htmlentities($ret->item($i)->nodeValue , null, 'utf-8');
                
                $findme   = 'Receipt#:';
                $findAccount = "Account:";
                //$code = str_replace("#:", "++" , $code) ;
                $code = str_replace('&nbsp;', '', $code);
                $pos = strpos($code, $findme);
                
                // The !== operator can also be used.  Using != would not work as expected
                // because the position of 'a' is 0. The statement (0 != false) evaluates 
                // to false.
                if ($pos !== false) {
                     $reciptCode =  substr( $code ,$pos + 9, strlen($code)-$pos );                         
                } else {
                     
                }
                /// get account number
                $posAccount = strpos($code, $findAccount);
                   
                if ($posAccount !== false && $count == 0) {
                     $reciptAccount =  substr( $code ,$posAccount + 8, strlen($code)-$pos );
                     $count = $count + 1;    
                } else {
                     
                }
                //// get the ingredient list
                $numbercheck = substr($codeForArray , 0 , 4); /// this is for the number check
                
                $codeArr = array();
                if (is_numeric($numbercheck)) {
                    //then get the product code and amount
                    $codeArr = explode('&nbsp;' , $codeForArray);
                    $ingreArr[count($ingreArr)] = $codeArr[0];
                    $prices[count($prices)] = $codeArr[count($codeArr)-1];
                    
                } else {
                    // Error
                }
            }
            
            echo "Receipt Code: ". $reciptCode. "<br>\n";
            echo "Account: ". $reciptAccount. "<br>\n";
            print_r($ingreArr);
            print_r($prices);
            
            //echo $reciptCode ;
            //check the recipt code exist or not
            if($reciptCode != ""){

               $recipt = ReciptModel::where('code', $reciptCode)->get();  
               
               if (count($recipt) == 0) {
                    //get the recipt code

                    $customer = CustomerModel::where('accountNumber', $reciptAccount)->get();    
                    
                    $customerId = $customer[0]->id;
                    
                    //recipt model create
                    $recipt = new ReciptModel;
                    $recipt->customer_id = $customerId;
                    $recipt->code = $reciptCode;
                    
                    $recipt->save();
                    
                    $reciptId = $recipt->id;
                    
                    //// get the codes and update recipt product table
                    for($k = 0 ; $k < count($ingreArr);$k++){
                        $upccode = $ingreArr[$k];
                        //////////////////////////////chenck the prodcut exist with that upccode
                        $product =  ProductModel::where('upcCode', $upccode)->get();
                        if(count($product) != 0){
                           $productId = $product[0]->id;
                           $reciptProductModel = new ReciptProductModel;
                           $reciptProductModel->recipt_id = $reciptId; 
                           $reciptProductModel->product_id = $productId; 
                           $reciptProductModel->save(); 

                           $condition = ['customer_id' => $customerId , 'product_id' => $productId ] ;

                           $checkCustomerProduct = CabinetModel::where($condition)->get();

                           if(count($checkCustomerProduct) == 0){
                                $newCustomerProduct = new CabinetModel;
                                $newCustomerProduct->product_id = $productId;     
                                $newCustomerProduct->customer_id = $customerId;  
                                $newCustomerProduct->save();                    
                           }
                        }
                        else {
                        	echo "Product not found<br>\n";
                        }
                    }
                } else {
                    echo "Receipt is already processed<br>\n";
                }
            }
            else {
            	echo "Receipt code is empty.<br>\n";
            }
            echo '<br>';
        }
    }
    
    public function phpInfo(){
        phpInfo();
    }
}
