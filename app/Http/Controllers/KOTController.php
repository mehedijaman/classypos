<?php

namespace ClassyPOS\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use ClassyPOS\shop\Shop;
use ClassyPOS\Kitchen\Kitchen;
use ClassyPOS\Kitchen\KitchenCategory;
use DB;
use ClassyPOS\sales\Orders;
use ClassyPOS\sales\Suborders;
use ClassyPOS\sales\SubOrderProductMapping;
use ClassyPOS\sales\Tables;
use ClassyPOS\product\Product;
use Cookie;
use LRedis;
use Illuminate\Support\Facades\Session; 
use Illuminate\Http\Response;
use ClassyPOS\product\ProductCategory;
use ClassyPOS\user\UserNew;

class KOTController extends Controller
{

    public function newKOT(Request $request)
    {
        // Initialize Redis connection.
        $redis = LRedis::connection();

        if($request->Counter>0)
        {
            $CounterTable=Tables::findOrFail($request->Counter);
            $BookingChecking=$CounterTable->IsBooked;
        }

        if($request->Counter==0)
        {
            $BookingChecking=0;

        }

        $ParcelLoad=$request->ParcelTest;
        $OrderID=$request->OrderUpdateID;
        $productidprimary= $request->productid1;
        $productquantityprimary=$request->total1;
        $productshopprimary= $request->Shop1;
        $commentprimary= $request->KOTComment;
        $totalprimaryid=count($productidprimary);
        $productid1=[];
        $Qty=[];
        $Discount=[];
        $Vat=[];
        $Shop=[];
        $CategoryID=[];
        $KitchenID=[];
        $KitchenName=[];
        $BatchID=[];
        $Comment=[];
        $SubOrderIDGroup=[];


        for($i=0;$i<$totalprimaryid;$i++)
        {
            if($productidprimary[$i]>0)
            {
                array_push($productid1,$productidprimary[$i]);
                array_push($Qty,$productquantityprimary[$i]);
                array_push($Shop,$productshopprimary[$i]);
                array_push($Comment,$commentprimary[$i]);
                array_push($BatchID,0);
            }
        }

        for($i=0;$i<count($productid1);$i++)
        {
            $Category=Product::findOrFail($productid1[$i])->CategoryID;
            $Kitchen=KitchenCategory::where('CategoryID','=',$Category)->leftjoin('kitchen','kitchen.ID','=','kitchen_category_mapping.KitchenID')->get()->first();
            //array_push($CategoryID,$Category);
            array_push($KitchenID,$Kitchen->KitchenID);
            array_push($KitchenName,$Kitchen->Name);
        }

        //return $KitchenName;

        $Kitch=Kitchen::all();
        $RealKitchenID=[];
        $RealKitchenName=[];
        for($i=0;$i<count($Kitch);$i++)
        {
            $Checker=0;
            for($j=0;$j<count($productid1);$j++)
            {
                if($Kitch[$i]->ID==$KitchenID[$j])
                {
                    $Checker=1;
                    break;
                }
            }
            if($Checker==1)
            {
                array_push($RealKitchenID,$Kitch[$i]->ID);
                array_push($RealKitchenName,$Kitch[$i]->Name);
            }

        }


        //return "I am Sohail";

        //$RealKitchenID=[];


        //return $RealKitchenID;

        $total=count($productid1);
        $Complex=[];
        $ProductName=[];
        $ProductID=[];


        for($i=0;$i<$total;$i++)
        {
            $Complex[$i]=array('ProductID'=>$productid1[$i],'Quantity'=>$Qty[$i],'Shop'=>$Shop[$i]);
        }

        $json = json_encode($Complex);
        $ShopID=session()->get('ShopID');

        //Update an Order
        if($OrderID>0)
        {
            $OrderUpdate=Orders::findOrFail($request->OrderUpdateID);
            $OrderUpdate->Notes=$request->Notes;
            $OrderUpdate->StaffID =$request->Staff;
            $OrderUpdate->Guests=$request->Guest;
            $OrderUpdate->save();
            //$Shopping=session()->get('ShopID');



            for($a=0;$a<count($RealKitchenID);$a++)
            {
                $SubOrders=new SubOrders();

                $SubOrders->OrderID=$request->OrderUpdateID;;
                $SubOrders->KitchenID=$RealKitchenID[$a];
                $SubOrders->ShopID=$ShopID;
                $SubOrders->save();

                array_push($SubOrderIDGroup,$SubOrders->SubOrderID);


                for($i=0;$i<$total;$i++)
                {
                    if($KitchenID[$i]==$RealKitchenID[$a])
                    {
                        $Mapping=new SubOrderProductMapping();
                        $Mapping->SubOrderID=$SubOrders->SubOrderID;
                        $Mapping->ProductID=$productid1[$i];
                        $Mapping->Qty=$Qty[$i];
                        $Mapping->ShopID=$Shop[$i];
                        $Mapping->Notes=$Comment[$i];
                        $Mapping->IsCanceled=0;
                        $Mapping->save();
                    }
                }

            }


            //$SubOrder=new Suborders();
            //$SubOrder->OrderID=$rq->OrderUpdateID;
            //$SubOrder->ShopID=$Shopping;
            //$SubOrder->save();

            /*for($i=0;$i<$total;$i++)
            {
              $Mapping=new SubOrderProductMapping();
              $Mapping->SubOrderID=$SubOrder->SubOrderID;
              $Mapping->ProductID=$productid1[$i];
              $Mapping->Qty=$Qty[$i];
              $Mapping->ShopID=$Shop[$i];
              $Mapping->IsCanceled=0;
              $Mapping->save();
            }*/

            for($i = 0; $i < count($RealKitchenID); $i++) {
                $redis->publish('order-received', $RealKitchenID[$i]);
                $RealSubOrderID=$RealKitchenID[$i]."-".$SubOrderIDGroup[$i];
                $redis->publish('suborder-id', $RealSubOrderID);
            }

        }


        if($OrderID==0)
        {

            $Order=new Orders();
            $Order->ShopID=$ShopID;
            $Order->UserID=session()->get('UserID');
            $Order->CustomerID=session()->get('CustomerID');
            $Order->TableID=$request->Counter;
            $Order->Notes=$request->Notes;
            $Order->StaffID =$request->Staff;
            $Order->Guests=$request->Guest;
            $Order->IsReady=0;
            $Order->IsDelivered=0;

            $Order->IsInvoiced=0;
            $Order->IsComplete=0;
            $Order->save();
            $Shopping=session()->get('ShopID');

            for($a=0;$a<count($RealKitchenID);$a++)
            {
                $SubOrders=new SubOrders();
                $SubOrders->OrderID=$Order->ID;
                $SubOrders->KitchenID=$RealKitchenID[$a];
                $SubOrders->ShopID=$ShopID;
                $SubOrders->save();
                array_push($SubOrderIDGroup,$SubOrders->SubOrderID);

                if($request->Counter>0)
                {
                    $CounterTable=Tables::findOrFail($request->Counter);
                    $CounterTable->IsBooked=1;
                    $CounterTable->OrderID=$Order->ID;
                    $CounterTable->save();
                }



                for($i=0;$i<$total;$i++)
                {
                    if($KitchenID[$i]==$RealKitchenID[$a])
                    {
                        $Mapping=new SubOrderProductMapping();
                        $Mapping->SubOrderID=$SubOrders->SubOrderID;
                        $Mapping->ProductID=$productid1[$i];
                        $Mapping->Qty=$Qty[$i];
                        $Mapping->ShopID=$Shop[$i];
                        $Mapping->Notes=$Comment[$i];
                        $Mapping->IsCanceled=0;
                        $Mapping->save();
                    }
                }
            }

            /*$SubOrders=new SubOrders();
            $SubOrders->OrderID=$Order->ID;
            $SubOrders->save();

            $CounterTable=Counter::findOrFail($rq->Counter);
            $CounterTable->IsBooked=1;
            $CounterTable->OrderID=$Order->ID;
            $CounterTable->save();

            for($i=0;$i<$total;$i++)
            {
              $Mapping=new SubOrderProductMapping();
              $Mapping->SubOrderID=$SubOrders->SubOrderID;
              $Mapping->ProductID=$productid1[$i];
              $Mapping->Qty=$Qty[$i];
              $Mapping->ShopID=$Shop[$i];
              $Mapping->IsCanceled=0;
              $Mapping->save();
            }*/

            // Publish @KitchenID to redis for socket.io notification.
            // for($i = 0; $i < count($RealKitchenID); $i++) {
            //     $redis->publish('order-received', $RealKitchenID[$i]);
            // }

        }





        if($request->OrderUpdateID==0)
            $TempOrderID = $Order->ID;
        if($request->OrderUpdateID>0)
        {
            $TempOrderID =$request->OrderUpdateID;
        }



        $ProductName=[];
        $ProductID=[];
        $ShopID=[];
        $Price=[];
        $FinalPrice=[];

        for($i=0;$i<$total;$i++)
        {
            array_push($ProductID,$productid1[$i]);
            $Name=Product::findOrFail($productid1[$i])->ProductName;
            $Pr=Product::findOrFail($productid1[$i])->SalePrice;
            array_push($ProductName,$Name);
            array_push($ShopID,$Shop[$i]);
            array_push($Price,$Pr);
            array_push($FinalPrice,$Pr*$Qty[$i]);
        }

        $ItemQty=$total;
        $shh=session()->get('ShopID');
        $Shop = Shop::findOrFail(session()->get('ShopID'));

        $Order = Orders::where('orders.ID','=',$TempOrderID)
            ->leftjoin('tables','orders.TableID','=','tables.ID')
            ->leftjoin('user','user.UserID','=','orders.StaffID')
            ->select('orders.ID', 'tables.Name', 'orders.Guests', 'orders.Notes', 'user.FirstName', 'orders.created_at')
            ->first();
        if($ParcelLoad==1)
            $Checking=$SubOrders->SubOrderID;
        if($ParcelLoad==0&&$BookingChecking==0)
            $Checking=$TempOrderID;

        if($ParcelLoad==0&&$BookingChecking==1)
        {
            $Checking=$SubOrders->SubOrderID;
            $JsonChecking=json_encode($SubOrderIDGroup);
            $JsonBookingChecking=json_encode($BookingChecking);
            return response(['Checking'=>$JsonChecking,'Booking'=>$JsonBookingChecking]);


        }


        // Publish @KitchenID to redis for socket.io notification.

        for($i = 0; $i < count($RealKitchenID); $i++) {

            $redis->publish('order-received', $RealKitchenID[$i]);
            $RealSubOrderID=$RealKitchenID[$i]."-".$SubOrderIDGroup[$i];
            $redis->publish('suborder-id', $RealSubOrderID);
        }

        //$Checking=$SubOrders->SubOrderID;
        $JsonChecking=json_encode($Checking);
        $JsonBookingChecking=json_encode($BookingChecking);
        return response(['Checking'=>$JsonChecking,'Booking'=>$JsonBookingChecking]);
        //session()->put('Azhar',$Checking);

        //return back()->with('Azhar',$Checking);



        //return view('invoice.order',compact('TempOrderID','Order','Shop','ItemQty','ProductID','ProductName','Qty','Price','ShopID','FinalPrice','KitchenID','RealKitchenID','RealKitchenName','KitchenName'));
    }

    public function listKOT($ShopID, $KitchenID, $DateFrom,$DateTo,$Option)
    {

        $id=Auth::user()->id;
        $Admin=Auth::user()->admin;
        if($Admin==5)
        {
            if(session()->has('KitchenID'))
            {
                $KitchenID=session()->get('KitchenID');
            }
        }
        else
        $KitchenID=UserNew::findOrFail($id)->KitchenID;
        $ShopID=UserNew::findOrFail($id)->ShopID;
        $DateFrom="nofromdate";
        $DateTo  ="notodate";
        //return $ShopID;

        if($DateFrom=="nofromdate" && $DateTo=="notodate")
           {
            //return "Fahad";
            $start=date("Y-m-d");
            $end=date("Y-m-d",time() + 86400);
            $Times=[];
            $OrderID=[];
            $CounterName=[];
            $CounterNameCompleted=[];

            //return $KitchenID;

            if($Option==1)
            {
                $Products=SubOrders::where('suborder.ShopID','=',$ShopID)->where('KitchenID','=',$KitchenID)->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')->leftjoin('product','product.ProductID','=','suborder_product_mapping.ProductID')->where('suborder_product_mapping.IsCanceled','=',0)->whereBetween('suborder.updated_at',[$start,$end])->select('suborder_product_mapping.Qty','product.ProductName','product.ProductID','suborder_product_mapping.SubOrderID','suborder.OrderID','suborder_product_mapping.Notes','suborder_product_mapping.SubOrderProductID')->get();

                $SubOrders=SubOrders::where('suborder.ShopID','=',$ShopID)->leftjoin('orders','orders.ID','=','suborder.OrderID')->where('KitchenID','=',$KitchenID)->whereBetween('suborder.updated_at',[$start,$end])->where('suborder.IsComplete','=',0)->get();
                //->where('orders.IsComplete','=',0)

                //$OrderID=$SubOrders[0]->ID;
                
                $Total=count($SubOrders);
                for($i=0;$i<$Total;$i++)
                {
                    $SubID=$SubOrders[$i]->SubOrderID;
                    $All=SubOrders::where('SubOrderID','=',$SubID)->get();
                    $OrderingID=$SubOrders[$i]->OrderID;
                    array_push($Times,$All[0]);
                    array_push($OrderID,$OrderingID);
                }

                //return $OrderID;

                
                



                for($i=0;$i<count($OrderID);$i++)
                {
                    $CounterIDs=Orders::where('ID','=',$OrderID[$i])->get()->first();
                    $Counter=Tables::where('tables.ID','=',$CounterIDs->TableID)->get();
                    //$Counter=Counter::where('OrderID','=',$OrderID[$i])->get();
                    if(count($Counter)==1)
                        array_push($CounterName,$Counter[0]->Name);
                    if(count($Counter)==0)
                        array_push($CounterName,"Parcel");

                }

                //return $CounterName;

                $jsonProducts=json_encode($Products);
                $jsonSubOrders=json_encode($SubOrders);
                $jsonSubID=json_encode($SubID);
                $jsonAll=json_encode($All);
                $jsonTimes=json_encode($Times);
                $jsonCounterName=json_encode($CounterName);
                return response(['Products'=>$jsonProducts,'SubOrders'=>$jsonSubOrders,'Total'=>$jsonSubID,'All'=>$jsonAll,'Times'=>$jsonTimes,'CounterName'=>$jsonCounterName]);               


                //$Order=Orders::where('ID','=',$OrderID)->get()->first();

            }

            if($Option==2)
            {
                $Products=SubOrders::where('suborder.ShopID','=',$ShopID)->where('KitchenID','=',$KitchenID)->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')->leftjoin('product','product.ProductID','=','suborder_product_mapping.ProductID')->where('suborder_product_mapping.IsCanceled','=',0)->whereBetween('suborder.updated_at',[$start,$end])->select('suborder_product_mapping.Qty','product.ProductName','product.ProductID','suborder_product_mapping.SubOrderID','suborder.OrderID','suborder_product_mapping.Notes')->get();

                $SubOrders=SubOrders::where('suborder.ShopID','=',$ShopID)->leftjoin('orders','orders.ID','=','suborder.OrderID')->leftjoin('tables','tables.ID','=','orders.TableID')->where('KitchenID','=',$KitchenID)->whereBetween('suborder.updated_at',[$start,$end])->where('orders.IsComplete','=',0)->where('suborder.IsComplete','=',0)->where('suborder.IsConfirmed','=',1)->get();

                $Total=count($SubOrders);
                for($i=0;$i<$Total;$i++)
                {
                    $SubID=$SubOrders[$i]->SubOrderID;
                    $All=SubOrders::where('SubOrderID','=',$SubID)->get();
                    $OrderingID=$SubOrders[$i]->OrderID;
                    array_push($Times,$All[0]);
                    array_push($OrderID,$OrderingID);
                }

                for($i=0;$i<count($OrderID);$i++)
                {
                    $Counter=Tables::where('OrderID','=',$OrderID[$i])->get();
                    if(count($Counter)==1)
                        array_push($CounterName,$Counter[0]->Name);
                    if(count($Counter)==0)
                        array_push($CounterName,"Parcel");

                }

                //return $CounterName;

                $jsonProducts=json_encode($Products);
                $jsonSubOrders=json_encode($SubOrders);
                $jsonSubID=json_encode($SubID);
                $jsonAll=json_encode($All);
                $jsonTimes=json_encode($Times);
                $jsonCounterName=json_encode($CounterName);
                return response(['Products'=>$jsonProducts,'SubOrders'=>$jsonSubOrders,'Total'=>$jsonSubID,'All'=>$jsonAll,'Times'=>$jsonTimes,'CounterName'=>$jsonCounterName]);               

            }

            if($Option==3)
            {
                $ListofOrderID=[];

                $Products=SubOrders::where('suborder.ShopID','=',$ShopID)->where('KitchenID','=',$KitchenID)->where('suborder.IsComplete','=',1)->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')->leftjoin('product','product.ProductID','=','suborder_product_mapping.ProductID')->where('suborder_product_mapping.IsCanceled','=',0)->whereBetween('suborder.updated_at',[$start,$end])->select('suborder_product_mapping.Qty','product.ProductName','product.ProductID','suborder_product_mapping.SubOrderID','suborder.OrderID','suborder_product_mapping.Notes')->get();

                $SubOrders=SubOrders::where('suborder.ShopID','=',$ShopID)->leftjoin('orders','orders.ID','=','suborder.OrderID')->leftjoin('tables','tables.ID','=','orders.TableID')->where('KitchenID','=',$KitchenID)->whereBetween('suborder.updated_at',[$start,$end])->where('suborder.IsComplete','=',1)->get();

                for($i=0;$i<count($SubOrders);$i++)
                {
                    $IDofSubOrder=$SubOrders[$i]->SubOrderID;
                    $OrderedID=SubOrders::where('SubOrderID','=',$IDofSubOrder)->select('OrderID')->get()->first();
                    array_push($ListofOrderID,$OrderedID->OrderID);
                    
                }
      

                $Total=count($SubOrders);
                for($i=0;$i<$Total;$i++)
                {
                    $SubID=$SubOrders[$i]->SubOrderID;
                    $All=SubOrders::where('SubOrderID','=',$SubID)->get();
                    $OrderingID=$SubOrders[$i]->OrderID;
                    array_push($Times,$All[0]);
                    array_push($OrderID,$OrderingID);
                }



                for($i=0;$i<count($OrderID);$i++)
                {

                    $CounterIDs=Orders::where('ID','=',$ListofOrderID[$i])->get()->first();
                    $Counter=Tables::where('tables.ID','=',$CounterIDs->TableID)->get();
                    //$Counter=Counter::where('OrderID','=',$OrderID[$i])->get();
                    if(count($Counter)==1)
                        array_push($CounterNameCompleted,$Counter[0]->Name);
                    if(count($Counter)==0)
                        array_push($CounterNameCompleted,"Parcel");
              

                }

                //return $CounterNameCompleted;

                $jsonProducts=json_encode($Products);
                $jsonSubOrders=json_encode($SubOrders);
                $jsonSubID=json_encode($SubID);
                $jsonAll=json_encode($All);
                $jsonTimes=json_encode($Times);
                $jsonCounterNameCompleted=json_encode($CounterNameCompleted);
                $jsonTotal=json_encode($Total);
                $jsonListofOrderID=json_encode($ListofOrderID);
                return response(['Products'=>$jsonProducts,'SubOrders'=>$jsonSubOrders,'All'=>$jsonAll,'Times'=>$jsonTimes,'CounterName'=>$jsonCounterNameCompleted,'Total'=>$jsonTotal,'ListofOrderID'=>$jsonListofOrderID]);                  

            }
            $jsonProducts=json_encode($Products);
            $jsonSubOrders=json_encode($SubOrders);
            $jsonSubID=json_encode($SubID);
            $jsonAll=json_encode($All);
            $jsonTimes=json_encode($Times);
            return response(['Products'=>$jsonProducts,'SubOrders'=>$jsonSubOrders,'Total'=>$jsonSubID,'All'=>$jsonAll,'Times'=>$jsonTimes]);           

           }

        $List = json_encode("Hello Darkness my old friend");

        return response($List);

        // $id=Auth::user()->id;
        // $Admin=Auth::user()->admin;
        // if($Admin==5)
        // {
        //     if(session()->has('KitchenID'))
        //     {
        //         $KitchenID=session()->get('KitchenID');
        //     }
        // }
        // else
        // $KitchenID=UserNew::findOrFail($id)->KitchenID;
        // //return $KitchenID;
        // $ShopID=UserNew::findOrFail($id)->ShopID;
        // $DateFrom="nofromdate";
        // $DateTo  ="notodate";
        // //return $ShopID;

        // if($DateFrom==0 && $DateTo==0)
        //    {
        //     //return "Fahad";
        //     $start=date("Y-m-d");
        //     $end=date("Y-m-d",time() + 86400);
        //     $Times=[];
        //     $OrderID=[];
        //     $CounterName=[];
        //     $CounterNameCompleted=[];

        //     //return $KitchenID;

        //     if($Option==1)
        //     {
        //         $Products=SubOrders::where('suborder.ShopID','=',$ShopID)
        //         ->where('KitchenID','=',$KitchenID)
        //         ->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')
        //         ->leftjoin('product','product.ProductID','=','suborder_product_mapping.ProductID')
        //         ->where('suborder_product_mapping.IsCanceled','=',0)
        //         ->whereBetween('suborder.updated_at',[$start,$end])
        //         ->select('suborder_product_mapping.Qty','product.ProductName','product.ProductID','suborder_product_mapping.SubOrderID','suborder.OrderID','suborder_product_mapping.Notes')
        //         ->get();;



        //         $SubOrders=SubOrders::where('suborder.ShopID','=',$ShopID)
        //         ->leftjoin('orders','orders.ID','=','suborder.OrderID')
        //         ->where('KitchenID','=',$KitchenID)
        //         ->whereBetween('suborder.updated_at',[$start,$end])
        //         ->where('suborder.IsComplete','=',0)
        //         ->get();
                
        //         $Total=count($SubOrders);

        //         for($i=0;$i<$Total;$i++)
        //         {
        //             $SubID=$SubOrders[$i]->SubOrderID;
        //             // return $SubID;
        //             $All=SubOrders::where('SubOrderID','=',$SubID)->get();
        //             // return $All;
        //             $OrderingID=$SubOrders[$i]->OrderID;
        //             // return $OrderingID;
        //             array_push($Times,$All[0]);
        //             array_push($OrderID,$OrderingID);
        //             // return $OrderID;
        //         }
        //         // return $OrderID;


        //         $Count = count($OrderID);
        //         for($i=0;$i<$Count;$i++)
        //         {
        //             //return "sdfgasdf";
        //             // return $OrderID[3];
        //             $CounterIDs=Orders::where('ID','=',$OrderID[$i])->get();
        //             $Count = count($CounterIDs);
                    
                    
        //             $Counter=Tables::where('tables.ID','=',$CounterIDs->TableID)->get();
        //             //$Counter=Counter::where('OrderID','=',$OrderID[$i])->get();
        //             $Count = count($Counter);
        //             if($Count == 1)
        //                 array_push($CounterName,$Counter[0]->Name);
        //             if($Count == 0)
        //                 array_push($CounterName,"Parcel");
        //                 // array_push($CounterName,"Parcel");
        //         }

        //         //return $CounterName;

        //         $jsonProducts=json_encode($Products);
        //         $jsonSubOrders=json_encode($SubOrders);
        //         $jsonSubID=json_encode($SubID);
        //         $jsonAll=json_encode($All);
        //         $jsonTimes=json_encode($Times);
        //         $jsonCounterName=json_encode($CounterName);
        //         return response(['Products'=>$jsonProducts,'SubOrders'=>$jsonSubOrders,'Total'=>$jsonSubID,'All'=>$jsonAll,'Times'=>$jsonTimes,'CounterName'=>$jsonCounterName]);               


        //         //$Order=Orders::where('ID','=',$OrderID)->get()->first();

        //     }

        //     if($Option==2)
        //     {
        //         $Products=SubOrders::where('suborder.ShopID','=',$ShopID)->where('KitchenID','=',$KitchenID)->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')->leftjoin('product','product.ProductID','=','suborder_product_mapping.ProductID')->where('suborder_product_mapping.IsCanceled','=',0)->whereBetween('suborder.updated_at',[$start,$end])->select('suborder_product_mapping.Qty','product.ProductName','product.ProductID','suborder_product_mapping.SubOrderID','suborder.OrderID','suborder_product_mapping.Notes')->get();

        //         $SubOrders=SubOrders::where('suborder.ShopID','=',$ShopID)->leftjoin('orders','orders.ID','=','suborder.OrderID')->leftjoin('tables','tables.ID','=','orders.TableID')->where('KitchenID','=',$KitchenID)->whereBetween('suborder.updated_at',[$start,$end])->where('orders.IsComplete','=',0)->where('suborder.IsComplete','=',0)->where('suborder.IsConfirmed','=',1)->get();

        //         $Total=count($SubOrders);
        //         for($i=0;$i<$Total;$i++)
        //         {
        //             $SubID=$SubOrders[$i]->SubOrderID;
        //             $All=SubOrders::where('SubOrderID','=',$SubID)->get();
        //             $OrderingID=$SubOrders[$i]->OrderID;
        //             array_push($Times,$All[0]);
        //             array_push($OrderID,$OrderingID);
        //         }

        //         for($i=0;$i<count($OrderID);$i++)
        //         {
        //             $Counter=Tables::where('OrderID','=',$OrderID[$i])->get();
        //             if(count($Counter)==1)
        //                 array_push($CounterName,$Counter[0]->Name);
        //             if(count($Counter)==0)
        //                 array_push($CounterName,"Parcel");

        //         }

        //         //return $CounterName;

        //         $jsonProducts=json_encode($Products);
        //         $jsonSubOrders=json_encode($SubOrders);
        //         $jsonSubID=json_encode($SubID);
        //         $jsonAll=json_encode($All);
        //         $jsonTimes=json_encode($Times);
        //         $jsonCounterName=json_encode($CounterName);
        //         return response(['Products'=>$jsonProducts,'SubOrders'=>$jsonSubOrders,'Total'=>$jsonSubID,'All'=>$jsonAll,'Times'=>$jsonTimes,'CounterName'=>$jsonCounterName]);               

        //     }

        //     if($Option==3)
        //     {
        //         $ListofOrderID=[];

        //         $Products=SubOrders::where('suborder.ShopID','=',$ShopID)->where('KitchenID','=',$KitchenID)->where('suborder.IsComplete','=',1)->leftjoin('suborder_product_mapping','suborder.SubOrderID','=','suborder_product_mapping.SubOrderID')->leftjoin('product','product.ProductID','=','suborder_product_mapping.ProductID')->where('suborder_product_mapping.IsCanceled','=',0)->whereBetween('suborder.updated_at',[$start,$end])->select('suborder_product_mapping.Qty','product.ProductName','product.ProductID','suborder_product_mapping.SubOrderID','suborder.OrderID','suborder_product_mapping.Notes')->get();

        //         $SubOrders=SubOrders::where('suborder.ShopID','=',$ShopID)->leftjoin('orders','orders.ID','=','suborder.OrderID')->leftjoin('tables','tables.ID','=','orders.TableID')->where('KitchenID','=',$KitchenID)->whereBetween('suborder.updated_at',[$start,$end])->where('suborder.IsComplete','=',1)->get();

        //         for($i=0;$i<count($SubOrders);$i++)
        //         {
        //             $IDofSubOrder=$SubOrders[$i]->SubOrderID;
        //             $OrderedID=SubOrders::where('SubOrderID','=',$IDofSubOrder)->select('OrderID')->get()->first();
        //             array_push($ListofOrderID,$OrderedID->OrderID);
                    
        //         }
        //         //return $ListofOrderID;


        //         //$IDofSubOrder=$SubOrders[0]->SubOrderID;
        //         //$ListofOrderID=SubOrders::where('SubOrderID','=',$IDofSubOrder)->select('OrderID')->get()->first();
        //         //return $ListofOrderID;

        //         $Total=count($SubOrders);
        //         for($i=0;$i<$Total;$i++)
        //         {
        //             $SubID=$SubOrders[$i]->SubOrderID;
        //             $All=SubOrders::where('SubOrderID','=',$SubID)->get();
        //             $OrderingID=$SubOrders[$i]->OrderID;
        //             array_push($Times,$All[0]);
        //             array_push($OrderID,$OrderingID);
        //         }



        //         for($i=0;$i<count($OrderID);$i++)
        //         {

        //             $CounterIDs=Orders::where('ID','=',$ListofOrderID[$i])->get()->first();
        //             $Counter=Tables::where('tables.ID','=',$CounterIDs->TableID)->get();
        //             //$Counter=Counter::where('OrderID','=',$OrderID[$i])->get();
        //             if(count($Counter)==1)
        //                 array_push($CounterNameCompleted,$Counter[0]->Name);
        //             if(count($Counter)==0)
        //                 array_push($CounterNameCompleted,"Parcel");
        //             //$Counter=Counter::where('OrderID','=',$OrderID[$i])->get();
        //             //if(count($Counter)==1)
        //                 //array_push($CounterName,$Counter[0]->Name);
        //             //if(count($Counter)==0)
        //                 //array_push($CounterName,"Parcel");

        //         }

        //         //return $CounterNameCompleted;

        //         $jsonProducts=json_encode($Products);
        //         $jsonSubOrders=json_encode($SubOrders);
        //         $jsonSubID=json_encode($SubID);
        //         $jsonAll=json_encode($All);
        //         $jsonTimes=json_encode($Times);
        //         $jsonCounterNameCompleted=json_encode($CounterNameCompleted);
        //         $jsonTotal=json_encode($Total);
        //         $jsonListofOrderID=json_encode($ListofOrderID);
        //         return response(['Products'=>$jsonProducts,'SubOrders'=>$jsonSubOrders,'All'=>$jsonAll,'Times'=>$jsonTimes,'CounterName'=>$jsonCounterNameCompleted,'Total'=>$jsonTotal,'ListofOrderID'=>$jsonListofOrderID]);                  

        //     }

        //     $jsonProducts=json_encode($Products);
        //     $jsonSubOrders=json_encode($SubOrders);
        //     $jsonSubID=json_encode($SubID);
        //     $jsonAll=json_encode($All);
        //     $jsonTimes=json_encode($Times);
        //     return response(['Products'=>$jsonProducts,'SubOrders'=>$jsonSubOrders,'Total'=>$jsonSubID,'All'=>$jsonAll,'Times'=>$jsonTimes]);           

        //    }

        // $List = json_encode("Hello Darkness my old friend");

        // return response($List);
    }

     

}
