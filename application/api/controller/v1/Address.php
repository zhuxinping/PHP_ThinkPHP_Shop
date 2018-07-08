<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/4
 * Time: 16:47
 */

namespace app\api\controller\v1;


use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\api\model\User as UserModel;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\SucessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use think\Controller;

class Address extends Controller
{
    protected $beforeActionList=[
        'checkPrimaryScope'=>['only'=>'createOrUpdateAddress']
    ];
    protected function checkPrimaryScope(){
        $scope=TokenService::getCurrentTokenVar('scope');
       if($scope){
           if($scope>=ScopeEnum::User){
               return true;
           }else{
               throw  new ForbiddenException();
           }
       }else{
           throw new  TokenException();
       }
    }
    public function createOrUpdateAddress(){
        $validate=new AddressNew();
        (new AddressNew())->goCheck();
        //根据Token来获取用户uid
        //根据uid来查找用户数据，判断用户是否存在，如果不存在 抛出异常
        //获取用户从客户端提交过来的地址信息
        //根据用户地址信息是否存在，从而判断是添加地址还是更新地址
        $uid=TokenService::getCurrentUid();
        $user=UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
        $dataArray=$validate->getDataByRule(input('post.'));
        $userAddress=$user->address;
        if(!$userAddress){
            $user->address()->save($dataArray);//创建
        }else{
            $user->address->save($dataArray);//更新
        }
       // return $user;
        return json(new SucessMessage(),201);
    }
}