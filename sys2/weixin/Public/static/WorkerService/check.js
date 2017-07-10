    function checks(){

   var name = $('#name').val();
          if(name==''){
              $.WeiPHP.toast('收件人不能为空',0,3000);
              return false;
          }else if(!/^[\u4e00-\u9fa5]+$/gi.test(name)){
            $.WeiPHP.toast('收件人不能包含非法字符',0,3000);
            return false;
          }
         
         var phone = $('#phone').val();
          if(phone==''){
              $.WeiPHP.toast('手机不能为空',0,3000);
              return false;
          }else if(!/^1[3|4|5|7|8]\d{9}$/.test(phone)){
            $.WeiPHP.toast('手机号码格式错误',0,3000);
              return false;
        
          }
         



          var address = $('#address').val();
          if(address==''){
              $.WeiPHP.toast('地址不能为空',0,3000);
              return false;
         
          }

          if ($('select[name="express"]').val() == '0')
            {
             
              $.WeiPHP.toast('请选择快递公司',0,3000);
              return false;
            }
          
      

    }