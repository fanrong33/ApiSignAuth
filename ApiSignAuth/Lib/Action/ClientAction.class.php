<?php
/**
 * 模拟API客户端 控制器类
 * @author 蔡繁荣 <fanrong33@qq.com>
 * @version 1.0.0 build 20170304
 */
class ClientAction extends Action{


    public function test(){

        // 调用EmailApi获取用户信息
        import('@.ORG.Api.Email.EmailApiClient', '', '.php');
        $client = new EmailApiClient('2091798600', 'WIlWGPFaUUMQGYVsTFIO');

        $method = 'fanrong33.user.get_user';
        $params = array(
            'user_id' => 10001
        );
        $json = $client->get($method, $params);
        dump($json);
        exit;

    }

}
?>