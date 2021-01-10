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
                        <div class="col-md-3 col-xs-8"><input type="text" id="user_id" name="user_id" class="form-control" placeholder="USER ID"/></div>
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
                        <div class="col-md-3 col-xs-12"><input type="tel" id="user_tel" name="user_tel" class="form-control" placeholder="연락처"/></div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row form-group">    
                        <div class="col-md-3"></div>
                        <label for="user_email" class="col-md-2 hidden-xs hidden-sm control-label">이메일주소</label>
                        <div class="col-md-3 col-xs-9"><input type="text" id="user_email" name="user_email" class="form-control" placeholder="이메일주소"/></div>
                        <div class="col-md-2 col-xs-3"><button type="button" class="btn btn-mini btn-primary btn-block" onclick="email_submit();">인증</button></div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row form-group" id="email_confirm_div"  style="display: none">    
                        <div class="col-md-3"></div>
                        <label for="user_email" class="col-md-2 hidden-xs hidden-sm control-label">코드확인</label>
                        <div class="col-md-3 col-xs-9"><input type="text" id="email_confirm" name="email_confirm" class="form-control" placeholder="코드확인"/></div>
                        <div class="col-md-2 col-xs-3"><button type="button" class="btn btn-mini btn-primary btn-block" onclick="code_check();">확인</button></div>
                        <div class="col-md-3"></div>
                    </div>
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
            
            var user_id = new Array($("#user_id"), "아이디");
            var user_pw1 = new Array($("#user_pw1"), "비밀번호");
            var user_pw2 = new Array($("#user_pw2"), "비밀번호");
            var user_name = new Array($("#user_name"), "이름");
            var user_tel = new Array($("#user_tel"), "연락처");
            var user_email = new Array($("#user_email"), "이메일주소");
            var email_confirm = new Array($("#email_confirm"), "이메일인증");
            var shop_name = new Array($("#shop_name"), "가게명");
            var shop_category = new Array($("#shop_category"), "가게타입");
            var shop_addr = new Array($("#shop_addr"), "가게주소");

            var params_array = new Array(
                                            user_id, 
                                            user_pw1, 
                                            user_pw2, 
                                            user_name, 
                                            user_tel, 
                                            user_email, 
                                            email_confirm,
                                            shop_name, 
                                            shop_category, 
                                            shop_addr
                                        );
            
            function email_submit(){
                
                $("#email_confirm_div").show();
                
            }
            
            
            
            
            function join_submit(){
                
                if( requre_params(params_array) ){
                    
                    $.ajax({
                        url:'/member/join_process',
                        type:'post',
                        data:$('#join_form').serialize(),
                        success:function(data){
                            alert(data.test);
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
                if(user_pw1[0].val() != user_pw2[0].val()){
                    alert("비밀번호가 서로 다릅니다");
                    user_pw1[0].focus();
                    return false;
                }
                
            }
            
        </script>
</body>
</html>