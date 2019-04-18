<?php

namespace App\Http\Controllers;
use App\Repositories\Admin\CheckRepository as Check;
use App\Repositories\Hotel\OrderRepository as Order;
use App\WebService\HotelService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SoapClient;
use SoapServer;

/**
 * 微信服务通讯.
 */
class SoapController extends Controller
{

    /**
     * @var $check
     */
    protected $check;

    /**
     * @var $order
     */
    protected  $order;

    public function __construct(Check $check,Order $order)
    {
        $this->check = $check;
        $this->order = $order;
    }

    public function webservice(Request $request)
    {
        $wsdl = "http://xiajia.tunnel.senthink.com/soap/webservice?wsdl";
        return $this->serve($request,$wsdl,HotelService::class,array(
            "uri"      => "Reservation"
        ));
    }


    /**
     * 通用SOAP服务提供
     * @param $request
     * @param $wsdl
     * @param $class
     * @param $service
     * @param array $params
     * @return mixed
     * @throws \App\Services\Exception
     */
    public function serve($request,$wsdl,$class,$params = array()){
        if($request->getMethod() == 'GET'){
            if(isset($_SERVER['QUERY_STRING'])) {
                $qs = $_SERVER['QUERY_STRING'];
            }elseif(isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
                $qs = $HTTP_SERVER_VARS['QUERY_STRING'];
            }else{
                $qs = '';
            }

            if(preg_match('/wsdl/', $qs)){
                $result = file_get_contents(app_path('WebService/Wsdl/hotel.wsdl'));
                return response($result)->header('Content-Type', 'text/xml');
            }
        }else {
            if(is_null($wsdl) && !array_key_exists('uri',$params)){
                exit('非WSDL模式下必须传入uri');
            }

            $server=new SoapServer($wsdl,$params);

            $server->setClass($class,$this->check,$this->order);

                $response = new Response();
                $response->headers->set("Content-Type","text/xml; charset=utf-8");

                ob_start();
                $server->handle();
                $response->setContent(ob_get_clean());

                return $response;
        }
    }


    // 接口调用示例
    public function test()
    {
        //$client=new SoapClient("http://xiajia.tunnel.senthink.com/soap/webservice?wsdl");
        //$param=array('byProvinceName'=>'浙江');
        //$paras = array(
        //    "WeChatHotelId" => 13,
        //    "WeChatRoomTypeId" => 33,
        //    "CheckInTime" => "2017-02-28",
        //    "CheckOutTime" => "2017-03-2",
        //    "Contacts" => "测试",
        //    "TelePhone" => "18067988403",
        //    "Remark" => "",
        //    "RoomNumber" => 2,
        //    "Rate" => 100.0,
        //    "PaymentAmount" => "100.0",
        //    "PaymentMethod" => "微信支付",
        //    "OrderNumber" => "CX201702151721028520"
        //);
        //$paras = array(
        //    "hotel_id" => 13,
        //    "name" => '测试3',
        //    "mobile" => '15088704326',
        //    "person_type" => "内宾",
        //    "certificate_type" => "居民身份证",
        //    "code" => "123456987452122",
        //    "gmt_start" => "2017-02-16",
        //    "gmt_end" => "2017-02-17",
        //    "room_no" => '10010',
        //    "out_order_no" => '1234522134',
        //    "order_no" => ''
        //);

        //$paras = array(
        //    "name" => '测试2',
        //    "mobile" => '15088704326',
        //    "person_type" => "内宾",
        //    "certificate_type" => "居民身份证",
        //    "code" => "123456987452122",
        //    "gmt_start" => "2017-02-16",
        //    "gmt_end" => "2017-02-17",
        //    "room_no" => '10010',
        //    "out_order_no" => '1234521442'
        //);

        //$paras = array(
        //    "order_no" => 'CX201702071651572363'
        //);
        //try{
        //    $ret = $client->insertCheckInfo($paras);
        //    //$ret = $client->checkOut($paras);
        //    //$ret = $client->updateCheckInfo($paras);
        //    print_r($ret);
        //}catch(\SoapFault $e){
        //    echo $e->getMessage();
        //}catch(Exception $e){
        //    echo $e->getMessage();
        //}

        //$this->dispatch(new InsertReservation());

        $order_no = 'CX201702151555150850';
        
        $order = $this->order->with(array('hotel','room','user'))->findBy('order_no',$order_no);

        $check = $this->check->findBy("order_no",$order['order_no']);


        $client=new \SoapClient(config('hotel.pms.wsdl'));

        //$param=array(
        //    'WeChatHotelId' => $order->hotel_id,
        //    'WeChatRoomTypeId' => $order->room_id,
        //    'CheckInTime' => $order->gmt_start,
        //    'CheckOutTime' => $order->gmt_end,
        //    'Contacts' => $order->user->name,
        //    'TelePhone' => $order->mobile,
        //    'Remark' => '',
        //    'RoomNumber' => $order->room_num,
        //    'Rate' => round($order->cost/($order->room_num * (strtotime($order->gmt_end)-strtotime($order->gmt_start)) / 86400),2),
        //    'PaymentAmount' => ($order->pay_type == PayTypeEnum::FRONT) ? 0 : $order->cost,
        //    'PaymentMethod' =>  PayTypeEnum::getDesc($order->pay_type),
        //    'OrderNumber' => $order->order_no,
        //);
        ////

        $param=array(
            'WeChatHotelId' => $order->hotel_id,
            'WeChatRoomTypeId' => $order->room_id,
            'OrderNumber' => $order->order_no,
            'Out_order_no' => $check->out_order_no,
            'RoomNo' => $check->room_no,
        );

        $result = $client->AllCheckOut($param)->AllCheckOutResult;
        //$result = $client->InsertReservation($param)->InsertReservationResult;
    }
}
