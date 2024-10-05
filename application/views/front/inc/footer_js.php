<!-- JS | Custom script for all pages --> 
<script src="<?=base_url('frontassets/')?>js/custom.js"></script>

<script>
    var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?50585';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
  "enabled":true,
  "chatButtonSetting":{
      "backgroundColor":"#fa5610",
      "ctaText":"Message Us",
      "borderRadius":"20",
      "marginLeft":"0",
      "marginBottom":"50",
      "marginRight":"25",
      "position":"right"
  },
  "brandSetting":{
      "brandName":"Maa Ramachandi Temple",
      "brandSubTitle":"Typically replies within few minutes",
      "brandImg":"http://www.maaramachanditemple.com/logo-chakra.png",
      "welcomeText":"Hi there!\nHow can I help you?",
      "messageText":"",
      "backgroundColor":"#e76b45",
      "ctaText":"Start Chat",
      "borderRadius":"25",
      "autoShow":false,
      "phoneNumber":"917684982330"
  }
};
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>