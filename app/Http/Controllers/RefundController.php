<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;


use Auth;

use ClassyPOS\user_new;

use ClassyPOS\refund_invoice_product_mapping;

class RefundController extends Controller
{
    public function refund(Request $r)
    {
    $idus=Auth::user()->id;

     
     //return $r->price;
    $invid=$r->inv[0];


    $sh=user_new::where('UserID','=',$idus)->select('ShopID')->get()->first();

     
     $shopID=$sh->ShopID; 	



 


                $ccc=[];

              $r->checking;
             
              foreach($r->checking as $key=>$value)
              {



                

                array_push($ccc,$value);


              }



              $total=count($ccc);

              $qty=[];


              $proid=[];
              $proname=[];

              $totalprice=[];

              $price=[];
              $discount=[];
              $reason=[];


               for($i=0;$i<$total;$i++)

               {

               	if($r->checking[$i]==1)



               	{


               		array_push($proname,$r->refpronam[$i]);


                  array_push($proid,$r->refproid[$i]);


               
               		array_push($qty,$r->refqty[$i]);

                        array_push($totalprice,$r->refprice[$i]);

                        array_push($price,$r->price[$i]);

                      array_push($discount,$r->dis[$i]);
                      array_push($reason,$r->reason[$i]);


               	}
                 

               }

         





              
             $tata=count($proid);


             for($i=0;$i<$tata;$i++)
             {



           $invp=  new refund_invoice_product_mapping();


           $invp->UserID=$idus;

           $invp->ShopID=$shopID;
           $invp->InvoiceID=$invid;
           $invp->ProductID=$proid[$i];
           $invp->ProductName=$proname[$i];
           $invp->Qty=$qty[$i];
           $invp->Price=$price[$i];
           $invp->TotalPrice=$totalprice[$i];

           $invp->Discount=$discount[$i];


           $invp->RefundReason=$reason[$i];
           
           $invp->save();

    }






    	


   }
}
