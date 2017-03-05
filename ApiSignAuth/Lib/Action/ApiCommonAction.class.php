<?php
/**
 * API通用 控制器类
 * @author 蔡繁荣 <fanrong33@qq.com>
 * @version 1.1.0 build 20170304
 */
class ApiCommonAction extends Action{


    public function _initialize(){

        $request_sign = $_REQUEST['sign'];
        unset($_REQUEST['sign']);


        // 1.验证sign签名是否正确
        import('@.ORG.Api.Email.EmailApiProtocol', '', '.php');

        // 1.1 根据app_key获取app信息
        $app_key = $_REQUEST[EmailApiProtocol::APP_ID_KEY];
        //TODO 根据appkey获取app信息的app_secret
        // $app = get_cache_app($app_key);
        $app_secret = 'gIlWGPFaUUMQGYVsTFzk';

        $sign = EmailApiProtocol::sign($app_secret, $_REQUEST, $REQUEST['sign_method']);
        if($request_sign != $sign){
            $this->ajaxReturn('', 'ERR_INVALID_SIGNATURE', 0);
        }
        
    }


}

?>