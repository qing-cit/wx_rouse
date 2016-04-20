<?php 

define("TOKEN", "wx_rouse_velsur");
$wechatObj = new wechatCallbackapiTest();
// echo "1";
//         $arr_item[0] = array(
//           'title' => "洛兹集团简介",
//           'description' => "",
//           'picurl' => "http://www.rousegroup.com/images/banner_profile.jpg",
//           'url' => "http://www.rousegroup.com/profile.asp",
//         );
//         echo "2";
// echo $wechatObj->transmitNews($object, $arr_item);
// echo "3";
// exit;
define("WxAppID", "wx66850fd164e9fd26");
define("WxAppSecret", "321609bbe390140db157f4b2bfa92712");
if (!isset($_GET['echostr'])) {
  $wechatObj->responseMsg();
} else {
  $wechatObj->valid();
}

class wechatCallbackapiTest {
  public function valid() {
    $echoStr = $_GET["echostr"];
    if($this->checkSignature()) {
      echo $echoStr;
      exit;
    }
  }

  private function checkSignature() {
    $signature = $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce = $_GET["nonce"];
    $token = TOKEN;
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr);
    $tmpStr = implode($tmpArr);
    $tmpStr = sha1($tmpStr);

    if($tmpStr == $signature) {
      return true;
    } else {
      return false;
    }
  }

  public function responseMsg(){
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    if (!empty($postStr)) {
      $this->logger("R ".$postStr);
      $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
      $RX_TYPE = trim($postObj->MsgType);

      switch ($RX_TYPE) {
        case "event":
          $result = $this->receiveEvent($postObj);
          break;
        case "text":
          $result = $this->receiveText($postObj);
          break;
      }
      $this->logger("T ".$result);
      echo $result;
      } else {
        echo "";
        exit;
      }
  }
    
  private function receiveEvent($object) {
    $content = "";
    switch ($object->Event) {
      case "subscribe":
        $content = "感谢您的关注，洛兹维旭生活馆，愿带给您多姿多彩的生活着装体验！\n点击“精彩活动”了解最新优惠信息哦！";
        $result = $this->transmitText($object, $content);
        break;
      case "unsubscribe":
        $content = "取消关注";
        $result = $this->transmitText($object, $content);
        break;
      case "CLICK":
        $result = $this->receiveEventClick($object);
        break;
      default:
        $content = "洛兹维旭生活馆";
        $result = $this->transmitText($object, $content);
    }
    
    return $result;
  }
  
  private function receiveText($object) {
    $content = "洛兹维旭生活馆";
    $result = $this->transmitText($object, $content);
    return $result;
  }
   
    
  private function transmitText($object, $content) {
    $textTpl = "<xml>
      <ToUserName><![CDATA[%s]]></ToUserName>
      <FromUserName><![CDATA[%s]]></FromUserName>
      <CreateTime>%s</CreateTime>
      <MsgType><![CDATA[text]]></MsgType>
      <Content><![CDATA[%s]]></Content>
      </xml>";
    $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
    return $result;
  }

  public function transmitNews($object, $arr_item) {
    if(!is_array($arr_item))  return;
    $itemTpl = "<item>
      <Title><![CDATA[%s]]></Title>
      <Description><![CDATA[%s]]></Description>
      <PicUrl><![CDATA[%s]]></PicUrl>
      <Url><![CDATA[%s]]></Url>
      </item>";
    $item_str = "";
    foreach ($arr_item as $item){
      $item_str .= sprintf($itemTpl, $item['title'], $item['description'], $item['picurl'], $item['url']);
    } 

    $newsTpl = "<xml>
      <ToUserName><![CDATA[%s]]></ToUserName>
      <FromUserName><![CDATA[%s]]></FromUserName>
      <CreateTime>%s</CreateTime>
      <MsgType><![CDATA[news]]></MsgType>
      <ArticleCount>%s</ArticleCount>
      <Articles>".$item_str."</Articles>
      </xml>";
    $result = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item));
    return $result;
  }

  private function transmitLink($object, $title, $description, $url) {
    $textTpl = "<xml>
      <ToUserName><![CDATA[%s]]></ToUserName> 
      <FromUserName><![CDATA[%s]]></FromUserName> 
      <CreateTime>%s</CreateTime> 
      <MsgType><![CDATA[link]]></MsgType> 
      <Title><![CDATA[%s]]></Title> 
      <Description><![CDATA[%s]]></Description> 
      <Url><![CDATA[%s]]></Url>
      </xml>";
    $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $title, $description, $url);
    return $result;
  }

  private function logger($log_content) {
    
  }

  private function receiveEventClick($object){
    switch ($object->EventKey) {
      case "contact_us":
        $text = "浙江省宁波市鄞州区石碶街道洛兹工业园区\n联系电话：0574-88260199 88266168\n客服电话：0574-88260019\n传真：0574-88443572\n邮编：315153 \nwww.velsur.com";
        return $this->transmitText($object, $text);
        break;
      case "campaign":
        $dateArray = array();
        $dateArray[0] = array(
          'title' => "2016五一感恩回馈",
          'description' => "2016五一感恩回馈",
          'picurl' => "http://wx.rouse.0574jc.com/wp-content/uploads/2016/04/2016-05-01-e1461117701880.jpg",
          'url' => "http://wx.rouse.0574jc.com/2016-05-01/",
        );
        $dateArray[1] = array(
          'title' => "扫一扫，添加分享得好礼",
          'description' => "扫一扫，添加分享得好礼",
          'picurl' => "http://wx.rouse.0574jc.com/wp-content/uploads/2016/04/635589900835887646-212x300.jpg",
          'url' => "http://wx.rouse.0574jc.com/shareget/",
        );
        return $this->transmitNews($object, $dateArray);
        break;
      case "user_info":
        return $this->transmitText($object, $object->FromUserName);
        break;
    }

  }
}
?>