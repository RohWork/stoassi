<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- The above 2 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Refobi</title>
        <!-- 합쳐지고 최소화된 최신 CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

        <!-- 부가적인 테마 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <!-- Custom styles for this template -->
        <link href="../../assets/css/sticky-footer-navbar.css" rel="stylesheet">
    </head>
    
    <body>
	<div class="container form-group">
            <div class="row form-group">
                <div class="col-xs-8 col-xs-offset-4 col-md-9 col-md-offset-3">
                <h3>회원가입</h3>
                </div>
            </div>    
                <form id="join_form" name="join_form" method="post">
                    
                <!--<div class="col-sm-6 col-md-offset-3">
                    <div class="form-group">
                        <label for="inputName">ID</label>
                        <input type="text" class="form-control" id="inputName" placeholder="ID을 입력해 주세요">
                        <button class="btn btn-lg btn-primary btn-block" onclick="id_check();">check</button>
                    </div>
                </div>-->
                    <div class="row form-group">    
                        <div class="col-md-3"></div>
                        <label for="user_id" class="col-md-2 hidden-xs hidden-sm control-label">USER ID</label>
                        <div class="col-md-3 col-xs-8 form-group" id="id_group">
                            <input type="text" id="user_id" name="user_id" class="form-control" placeholder="USER ID" />
                            <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true" id="ok_msg" style="display: none"></span>
                            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" id="err_msg" style="display: none"></span>
                            <input type="hidden" id="confirm_id" name="confirm_id" class="form-control"/>
                        
                        </div>
                        <div class="col-md-2 col-xs-4"><button type="button" class="btn btn-mini btn-primary btn-block" onclick="id_check();">ID 체크</button></div>
                        <div class="col-md-3"></div>
                    </div>    
                    <div class="row form-group">    
                        <div class="col-md-3"></div>
                        <label for="user_pw1" class="col-md-2 hidden-xs hidden-sm control-label">PASSWORD1</label>
                        <div class="col-md-3 col-xs-12"><input type="password" id="user_pw1" name="user_pw1" class="form-control" placeholder="PASSWORD1"/></div>
                        <div class="col-md-3"></div>
                    </div>    
                    <div class="row  form-group">    
                        <div class="col-md-3"></div>
                        <label for="user_pw2" class="col-md-2 hidden-xs hidden-sm control-label">PASSWORD2</label>
                        <div class="col-md-3 col-xs-12"><input type="password" id="user_pw2" name="user_pw2" class="form-control" placeholder="PASSWORD2"/></div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row form-group">    
                        <div class="col-md-3"></div>
                        <label for="user_name" class="col-md-2 hidden-xs hidden-sm control-label">이름</label>
                        <div class="col-md-3 col-xs-12"><input type="text" id="user_name" name="user_name" class="form-control" placeholder="이름"/></div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row form-group">    
                        <div class="col-md-3"></div>
                        <label for="user_tel" class="col-md-2  hidden-xs hidden-sm control-label">연락처</label>
                        <div class="col-md-3 col-xs-12"><input type="tel" id="user_tel" name="user_tel" class="form-control"  placeholder="연락처" pattern="^\d{4}-\d{3}-\d{4}$"></div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row form-group">    
                        <div class="col-md-3"></div>
                        <label for="user_email" class="col-md-2 hidden-xs hidden-sm control-label">이메일주소</label>
                        <div class="col-md-3 col-xs-9"><input type="text" id="user_email" name="user_email" class="form-control" placeholder="이메일주소"/></div>
                        <div class="col-md-2 col-xs-3"><!--<button type="button" class="btn btn-mini btn-primary btn-block" onclick="email_submit();">인증</button>--></div>
                        <div class="col-md-3"></div>
                    </div>
                    <!--
                    <div class="row form-group" id="email_confirm_div"  style="display: none">    
                        <div class="col-md-3"></div>
                        <label for="user_email" class="col-md-2 hidden-xs hidden-sm control-label">코드확인</label>
                        <div class="col-md-3 col-xs-9"><input type="text" id="email_confirm" name="email_confirm" class="form-control" placeholder="코드확인"/></div>
                        <div class="col-md-2 col-xs-3"><button type="button" class="btn btn-mini btn-primary btn-block" onclick="code_check();">확인</button></div>
                        <div class="col-md-3"></div>
                    </div>
                    -->
                    <hr/>
                    <div class="row  form-group">    
                        <div class="col-md-3"></div>
                        <label for="shop_name" class="col-md-2 hidden-xs hidden-sm control-label">가게명</label>
                        <div class="col-md-3 col-xs-12"><input type="text" id="shop_name" name="shop_name" class="form-control" placeholder="가게명"/></div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row  form-group">    
                        <div class="col-md-3"></div>
                        <label for="shop_category" class="col-md-2 hidden-xs hidden-sm  control-label" >가게타입</label>
                        <div class="col-md-3 col-xs-12">
                            <select name="shop_category" id="shop_category" class="form-control">
                                <option value="가게타입"/>가게타입</option>
                            </select>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row form-group">    
                        <div class="col-md-3"></div>
                        <label for="shop_addr" class="col-md-2 hidden-xs hidden-sm control-label">가게주소</label>
                        <div class="col-md-3 col-xs-12"><input type="text" id="shop_addr" name="shop_addr" class="form-control" placeholder="가게주소"/></div>
                        <div class="col-md-3"></div>
                    </div>
                </form>
                <div class="row form-group" style="margin-top:100px">

                    <div class="col-md-3"></div>
                    <div class="col-xs-6 col-md-3"><button class="btn btn-mini btn-success btn-block" onclick="join_submit()">가입신청</button></div>
                    <div class="col-xs-6 col-md-3"><button class="btn btn-mini btn-danger btn-block" onclick="location.href ='/';">취소</button></div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            
        

	</div>
        
        <script>
            
            $(document).ready(function(){
                
                var category_html = "";
                
                $.ajax({
                    url:'/member/get_shop_category',
                    type:'post',
                    success:function(data){
                        data.forEach(function (item){
                            category_html += "<option value="+item.idx+">"+item.name+"</option>";
                        });
                        
                        $("#shop_category").append(category_html);
                    },
                    error: function(xhr,status,error) {
                        console.log(xhr,status,error);
                        alert("네트워크 오류!! 관리자에게 문의 주세요!!");
                        return false;
                    }	 
                });
                
            });
            
            
            var user_id = new Array($("#user_id"), "아이디");
            var user_pw1 = new Array($("#user_pw1"), "비밀번호");
            var user_pw2 = new Array($("#user_pw2"), "비밀번호");
            var user_name = new Array($("#user_name"), "이름");
            var user_tel = new Array($("#user_tel"), "연락처");
            var user_email = new Array($("#user_email"), "이메일주소");
            //var email_confirm = new Array($("#email_confirm"), "이메일인증");
            var shop_name = new Array($("#shop_name"), "가게명");
            var shop_category = new Array($("#shop_category"), "가게타입");
            var shop_addr = new Array($("#shop_addr"), "가게주소");
            var confirm_id = new Array($("#confirm_id"), "아이디확인");
            var params_array = new Array(
                                            user_id, 
                                            user_pw1, 
                                            user_pw2, 
                                            user_name, 
                                            user_tel, 
                                            user_email, 
                                           // email_confirm,
                                            shop_name, 
                                            shop_category, 
                                            shop_addr
                                        );
            
            function email_submit(){
                
                email_confirm[0].val("Y");
                
            }
            
            
            function id_check(){
                
                if(user_id[0].val() == ""){
                    alert(user_id[1]+"를 입력해주세요.");
                    return false;
                }else{
                    
                     $.ajax({
                        url:'/member/check_id',
                        type:'post',
                        data:{user_id : user_id[0].val() },
                        success:function(data){
                            if(data.result){
                                user_id[0].attr("disabled", true);
                                confirm_id[0].val(user_id[0].val());
                                $("#id_group").attr("class","col-md-3 col-xs-8 has-success has-feedback");
                                $("#err_msg").hide();
                                $("#ok_msg").show();
                            }else{
                                alert("중복된 계정입니다.");
                                $("#id_group").attr("class","col-md-3 col-xs-8 has-error has-feedback");
                                $("#err_msg").show();
                            }
                        },
                        error: function(xhr,status,error) {
                            console.log(xhr,status,error);
                            alert("네트워크 오류!! 관리자에게 문의 주세요!!");
                            return false;
                        }	 
                    });
                    
                }
                
            }
            
            function join_submit(){
                
                if( requre_params(params_array) ){
                    
                    var form = $("#join_form");
                    
                    $.ajax({
                        url:'/member/join_process',
                        type:'post',
                        data: form.serialize(),
                        success:function(data){
                            if(data.result == true){
                                alert(data.message);
                                location.href="/";
                            }else{
                                alert(data.message);
                            }
                        },
                        error: function(xhr,status,error) {
                            console.log(xhr,status,error);
                            alert("네트워크 오류!! 관리자에게 문의 주세요!!");
                            return false;
                        }	 
                    });
                }
            }
            function requre_params(params){
                var j =0;
                var check_passwd = new Array();
                
                for(var i=0; i<params.length; i++){
                    if(params[i][0].val() == ""){
                        alert(params[i][1]+" 을(를) 확인해주세요.");
                        params[i][0].focus();
                        return false;
                    }
                }
                
                var num = user_pw1[0].val().search(/[0-9]/g);
                var eng = user_pw1[0].val().search(/[a-z]/ig);
                var spe = user_pw1[0].val().search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);
                
                if(user_pw1[0].val() != user_pw2[0].val()){
                    alert("비밀번호가 서로 다릅니다");
                    user_pw1[0].focus();
                    return false;
                }else if( user_pw1[0].val().length < 8 || user_pw1[0].val().length > 20){
                    alert("비밀번호는 8~20자리 이내로 입력해주세요");
                    user_pw1[0].focus();
                    return false;
                }else if (user_pw1[0].val().search(/\s/) != -1){
                    alert("비밀번호는 공백 없이 입력해주세요.");
                    user_pw1[0].focus();
                    return false;
                }else if(num < 0 || eng < 0 || spe < 0){
                    alert("비밀번호는 영문,숫자, 특수문자를 혼합하여 입력해주세요.");
                    user_pw1[0].focus();
                    return false;
                }
                
                
                if(!user_id[0].attr("disabled")){
                    alert("아이디 중복체크를 진행해주세요.");
                    user_id[0].focus();
                    return false;
                }
                
                return true;
            }
            
        </script>
</body>
</html>