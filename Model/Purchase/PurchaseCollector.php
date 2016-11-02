<?php

/**
 * @author   dzgok  <dgokdunek@tmobtech.com>
 * @license  https://raw.githubusercontent.com/tappz/magento2/master/LICENCE
 *
 * @link     http://t-appz.com/
 */

namespace TmobLabs\Tappz\Model\Purchase;

use Magento\Framework\Event\ManagerInterface as EventManager;
use TmobLabs\Tappz\Helper\RequestHandler as RequestHandler;
use TmobLabs\Tappz\Model\Basket\BasketCollector as Basket;
use TmobLabs\Tappz\Model\Order\OrderCollector as OrderCollector;
use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
/**
 * Class PurchaseCollector.
 */
class PurchaseCollector extends PurchaseFill
{
    /**
     * @var RequestHandler
     */
    public $helper;
    /**
     * @var
     */
    public $addressRepository;
    /**
     * @var Basket
     */
    public $basketRepository;
    /**
     * @var
     */
    public $objectManager;
    /**
     * @var OrderCollectorß
     */
    public $orderCollector;

    /**
     * @var $eventManager
     */
    protected $eventManager;

    /**
     * PurchaseCollector constructor.
     *
     * @param RequestHandler $requestHandler
     * @param Basket $basketRepository
     * @param OrderCollector $orderCollector
     */
    public function __construct(
        RequestHandler $requestHandler,
        Basket $basketRepository,
        OrderCollector $orderCollector,
        EventManager $eventManager
    ) {
        $this->objectManager =
            \Magento\Framework\App\ObjectManager::getInstance();
        $this->helper = $requestHandler;
        $this->basketRepository = $basketRepository;
        $this->orderCollector = $orderCollector;
        $this->eventManager = $eventManager;
    }

    /**
     * @param $quoteId
     * @param $method
     *
     * @return array|void
     */
    public function getPurchase($quoteId,$method)
    {
        switch ($method) {
            case 'CreditCard':
                $result = $this->purchaseCreditCards($quoteId);
                break;
            case 'threeD':
                $result = $this->purchaseThreeD($quoteId);
                break;
            case 'MoneyTransfer':
                $result = $this->purchaseMoneyTransfer($quoteId);
                break;
            case 'cashOnDelivery':
                $result = $this->purchaseCashOnDelivery($quoteId);
                break;
            case 'paypal':
                $result = $this->purchasePaypal($quoteId);
                break;
            case 'applepay':
                $result = $this->purchaseApplePay();
                break;
            default:
                $result = $this->purchaseCreditCards($quoteId);
                break;
        }
        return $result;
    }

    private function getTransId($quoteId , $userId)
    {
        return  "q-".$quoteId."u-".$userId."-".strtotime("now");
    }
    /**
     * @param $quoteId
     */

    public function purchaseCreditCards($quoteId)
    {
        $request = $this->helper->convertJson(
            $this->helper->getHeaderJson()
        );
        $userId = $this->helper->getAuthorization();
        $result = $this->basketRepository->getBasketById($quoteId);
        $clientToken = $this->getTransId($quoteId,$userId);
        $cardHolder = $request->creditCard->owner;
        $cardNumber = $request->creditCard->number;
        $expiryMonth = $request->creditCard->month;
        $expiryYear = $request->creditCard->year;
        $cvv = $request->creditCard->cvv;
        $amount = $this->basketRepository->getBasketRealPrice($result);
        $ipAddress = $this->getIpAddress();
        /**
         * Set your gateway here
         */

        $method = $this->getChosenCreditCardMethod();
        if($method == "mygate"){
            $resultMyGateToken = $this->mygateGetPaymentToken(
                $clientToken,
                $cardHolder,
                $cardNumber,
                $expiryMonth,
                $expiryYear
            );
            if($resultMyGateToken['Message'] == "success"){
                $token = $resultMyGateToken['token'];
                $resultOfPayment = $this->mygateDoPayment(
                    $token,
                    $clientToken,
                    $cvv,
                    $amount,
                    $ipAddress,
                    $quoteId

                );
                if($resultOfPayment['Message'] == "success"){
                    return $this->doPurchase($quoteId, $userId, "mygate");
                } else{
                    $result["ErrorCode"] = 403;
                    $result["Message"] = $resultOfPayment['Message'];
                    $result["UserFriendly"]  =  true;
               }
            } else {
                $result["ErrorCode"] = $resultMyGateToken['ErrorCode'];
                $result["Message"] = $resultMyGateToken['Message'];
                $result["UserFriendly"]  =  true;
            }
        }
        return $result;
    }
    public function mygateMessageConverter(
        $token,
        $message,
        $errorCode,
        $userFriendly = true
    ){
        return [
            "token" => $token,
            'ErrorCode' =>  $errorCode,
            'Message' => $message ,
            'UserFriendly' => $userFriendly,
        ];
    }
    public function mygateGetPaymentToken(
        $clientToken,
        $cardHolder,
        $cardNumber,
        $expiryMonth,
        $expiryYear
    ){
        $sandbox =  $this->getMygateAttr("mygateSandbox");
        $merchantUId = $this->getMygateAttr("mygateApplicationId");
        $applicationUId = $this->getMygateAttr("mygateClientId");
        if($sandbox == 1){
            $url = "https://dev-services.mygateglobal.com/wsTokenization.wsdl";
        }else{
            $url = "https://services.mygateglobal.com/wsTokenization.wsdl";
        }
        $client = new \SoapClient($url);
        $myGateResult = $client->fCreateTokenCC(
            $merchantUId,
            $applicationUId,
            $clientToken,
            $cardHolder,
            $cardNumber,
            $expiryMonth,
            $expiryYear
        );
        $resultMessage  = explode("||",$myGateResult[0]);
        if($resultMessage[1] == 0){
            $resultToken  = (explode("||",$myGateResult[1]));
            $token = $resultToken[1];
            $message = "success";
            $errorCode = 200;
            $userFriendly = false;

        } else {
            $resultError  = explode("||",$myGateResult[2]);
            $token = "";
            $message = $resultError[2]."-".$resultError[3];
            $errorCode = $resultError[1];
            $userFriendly = true;
        }
        return $this->mygateMessageConverter($token,$message,$errorCode,$userFriendly);

    }

    public function mygateDoPayment(
        $token,
        $clientToken,
        $cvv,
        $amount,
        $ipAddress ,
        $merchantReference = "",
        $mode = 0,
        $budget = 0,
        $budgetPeriod = 1,
        $uci = "",
        $shippingCountryCode = "za"
    ){
        $sandbox =  $this->getMygateAttr("mygateSandbox");
        $merchantUId = $this->getMygateAttr("mygateApplicationId");
        $applicationUId = $this->getMygateAttr("mygateClientId");
        if($sandbox == 1){
            $url = "https://dev-services.mygateglobal.com/wsTokenization.wsdl";
            $mode = 0 ;
        }else{
            $url = "https://services.mygateglobal.com/wsTokenization.wsdl";
            $mode = 1 ;
        }
        $client = new \SoapClient($url);
        $myGateResult = $client->fPayNow(
            $merchantUId,
            $applicationUId,
            $token,
            $clientToken,
            $cvv,
            number_format($amount,2),
            $mode,
            $merchantReference,
            $budget,
            $budgetPeriod,
            $uci,
            $ipAddress,
            $shippingCountryCode
        );
        $resultMessage  = explode("||",$myGateResult[0]);
        if($resultMessage[1] == 0){
            $resultToken  = (explode("||",$myGateResult[1]));
            $token = $resultToken[1];
            $message = "success";
            $errorCode = 200;
            $userFriendly = false;

        } else {
            $resultError  = explode("||",$myGateResult[2]);
            $token = "";
            $message = $resultError[2]." <br>".$resultError[3];
            $errorCode = $resultError[1];
            $userFriendly = true;
        }

        return  $this->mygateMessageConverter($token,$message,$errorCode,$userFriendly);


    }
    /**
     * @param $quoteId
     */
    public function purchaseThreeD($quoteId)
    {
        $quoteId;
        return "";
    }

    /**cd
     * @param $quoteId
     */
    public function purchaseMoneyTransfer($quoteId)
    {
        $userId = $this->helper->getAuthorization();
        return $this->doPurchase($quoteId, $userId, "checkmo");

    }

    /**
     * @param $quoteId
     *
     * @return array
     */
    public function purchaseCashOnDelivery($quoteId)
    {
        $userId = $this->helper->getAuthorization();
        return $this->doPurchase($quoteId, $userId, "cashondelivery");
    }

    /**
     * @param $userid
     *
     * @return mixed
     */
    public function getUserViaUserId($userId)
    {
        $store = $this->objectManager->
        get('Magento\Store\Model\StoreManagerInterface')->getStore();
        $customer = $this->objectManager->
        get('Magento\Customer\Model\Customer')->setStore($store);
        $customer->load($userId);
        return $customer;
    }

    /**
     *
     */
    public function purchasePaypal($quoteId)
    {
        $result = [];
        $request = $this->helper->convertJson(
            $this->helper->getHeaderJson()
        );
        $userId = $this->helper->getAuthorization();
        $sandbox = $this->getPaypalAttr("paypalSandbox");
        if($sandbox){
            $url = 'https://api.sandbox.paypal.com/v1/';
        }else{
            $url = 'https://api.paypal.com/v1/';
        }
        $paypalClientId =  $this->getPaypalAttr("paypalClientId");
        $paypalSecret = $this->getPaypalAttr("paypalSecretKey");
        $transactionId =   $request->TransactionId;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.'oauth2/token');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Accept-Language: en_US',
            'content-type: application/x-www-form-urlencoded',
        ));
        curl_setopt($ch, CURLOPT_USERPWD, $paypalClientId.':'.$paypalSecret);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        $token_result_json = curl_exec($ch);
        curl_close($ch);
        $token_result = json_decode($token_result_json);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.'payments/payment/'.$transactionId);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Authorization: Bearer '.$token_result->access_token,
            'content-type: application/x-www-form-urlencoded',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $payment_result_json = curl_exec($ch);
        curl_close($ch);
        $payment_result = json_decode($payment_result_json, true);
        $transactionState = $payment_result['state'];
        $paymentResult =$payment_result['transactions'];
        $saleState = $paymentResult[0]['related_resources'][0]['sale']['state'];
        if ($transactionState == 'approved' && $saleState == 'completed') {
            return $this->doPurchase($quoteId, $userId, "paypal");
        }else{
            $result = $this->basketRepository->getBasketById($quoteId);
            $result["ErrorCode"] = 403;
            $result["Message"] = "No such order.Please try again.";
            $result["UserFriendly"]  =  true;
        }
        return $result;
    }
    /**
     *
     */
    public function purchaseApplePay()
    {
        return '';
    }

    /**
     * @param $attr
     * @return mixed
     */
    public function getMygateAttr($attr)
    {
        $scopeConfig = $this->objectManager
            ->create('\Magento\Framework\App\Config\ScopeConfigInterface');
        return $scopeConfig->
        getValue('tappzmygate/tappzmygatemethod/' . $attr);
    }
    private function getChosenCreditCardMethod()
    {
        $scopeConfig = $this->objectManager
            ->create('\Magento\Framework\App\Config\ScopeConfigInterface');
        return $scopeConfig->
        getValue('tappzpayment/tappzcreditcard/tappzcreditcardmethod');

    }

    /**
     * @param $quoteId
     * @param $userId
     * @param $method
     * @return array
     * @throws LocalizedException
     */
    public function doPurchase($quoteId,$userId,$method){
        $result = [];
        $quote = $this->basketRepository->getBasketQuoteById($quoteId);
        $payment = $quote->getPayment();
        if ($payment) {

            $payment->setChecks([
                \Magento\Payment\Model\Method\AbstractMethod::CHECK_USE_CHECKOUT,
                \Magento\Payment\Model\Method\AbstractMethod::CHECK_USE_FOR_COUNTRY,
                \Magento\Payment\Model\Method\AbstractMethod::CHECK_USE_FOR_CURRENCY,
                \Magento\Payment\Model\Method\AbstractMethod::CHECK_ORDER_TOTAL_MIN_MAX,
                \Magento\Payment\Model\Method\AbstractMethod::CHECK_ZERO_TOTAL,
            ]);
            $payment->setTransactionId($this->getTransId($quoteId, $userId));
            $quote->getPayment()->setQuote($quote);
        }else{
            $quote->setPaymentMethod($method);
            $quote->getPayment()->importData(['method' => $method]);
        }
        if ($quote->getCustomerEmail() == null) {
            $customerModel = $this->getUserViaUserId($userId);
            $quote->setCustomerId($userId)
                ->setCustomerEmail($customerModel->getEmail())
                ->setCustomerGroupId($customerModel->getGroupId())
                ->setCustomerFirstname($customerModel->getFirstname())
                ->setCustomerLastname($customerModel->getLastname())
                ->setCustomerIsGuest(false);
        }
        $shippingQuote = $quote->getShippingAddress();
        $shipmentMethod = $shippingQuote->getData('shipping_method');
        $quote->setShippingMethod($shipmentMethod);
        $shippingQuote->setCollectShippingRates(true)
            ->collectShippingRates()
            ->setShippingMethod($shipmentMethod);
        $quote->setIsActive(true)
            ->collectTotals()
            ->save();
        $quote->getShippingMethod();
        $rate = $this->objectManager->
        get('Magento\Quote\Model\Quote\Address\Rate');
        $rate->setCode($shipmentMethod);
        $quote->getShippingAddress()->addShippingRate($rate);
        $this->eventManager->dispatch('checkout_submit_before', ['quote' => $quote]);
        $quoteManagement = $this->objectManager
            ->create('\Magento\Quote\Model\QuoteManagement');
        $order = $quoteManagement->submit($quote);
        if (null == $order) {
            throw new LocalizedException(__('Cannot place order.'));
        }
        if ($order) {
            $order->setCustomerIsGuest(false);
            $result = $this->orderCollector->getOrderById($order->getID());
            return $result;
        }
        return $result;
    }

    /**
     * @param $attr
     * @return mixed
     */
    private function getPaypalAttr($attr)
    {
        $scopeConfig = $this->objectManager
            ->create('\Magento\Framework\App\Config\ScopeConfigInterface');
        return $scopeConfig->
        getValue('tappzpaypal/tappzpaypalmethod/' . $attr);
    }
}

