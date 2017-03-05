<?php
/**
 * API接口入口 控制器类
 * @author 蔡繁荣 <fanrong33@qq.com>
 * @version 1.0.0 build 20170304
 */
class ApiAction extends Action{
    
    
    /**
     * 入口函数
     */
    public function entry(){

        unset($_REQUEST['_URL_']);

        /** 模拟测试数据： 
        $pairs = array(
            'method'      => 'kdt.item.update',
            'num_iid'     => '78552',
            'title'       => 'api 测试商品 编辑 __ 22',
            'desc'        => 'description here',
            'post_fee'    => '0.2',
            
            'app_key'     => '2291798602',
            'timestamp'   => '2016-07-17 15:04:26',
            'format'      => 'json',
            'sign_method' => 'md5',
            'v'           => '1.0',
            
            'sign'        => '82d9fa3513b8ccc71a7e0959a16bb145',
        );
        */

        //TODO 优化完善sign授权认证验证业务逻辑
        
        $request_sign = $_REQUEST['sign'];
        unset($_REQUEST['sign']);


        // 1.验证sign签名是否正确
        import('@.ORG.Api.Email.EmailApiProtocol', '', '.php');

        // 1.1 根据app_key获取app信息
        $app_key = $_REQUEST[EmailApiProtocol::APP_ID_KEY];
        //TODO 根据appkey获取app信息的app_secret
        // $app = get_cache_app($app_key);
        $app_secret = 'WIlWGPFaUUMQGYVsTFIO';

        $sign = EmailApiProtocol::sign($app_secret, $_REQUEST, $REQUEST['sign_method']);
        if($request_sign != $sign){
            $this->ajaxReturn('', 'ERR_INVALID_SIGNATURE', 0);
        }

        $_REQUEST['sign'] = $request_sign;


        // 2. 解析接口控制器和方法名
        $pieces = explode('.', $_REQUEST['method']); // kdt.item.update
        $function = array_pop($pieces);
        $module   = ucfirst(array_pop($pieces));


        // 3. 远程调用对应API接口
        R($module.'/'.$function, $_REQUEST);
        exit;
    }

}

?>