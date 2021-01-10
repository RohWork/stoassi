<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 2 meta tags *must* come first in the head; any other head content must come *after* these tags -->
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
        <style>
            .login_button{
                height:70px;
            }
        </style>
    </head>
    
    <body>
	<div class="container">
                
                    <div class="row">
                        <div class="col-xs-4"></div>
                        <div class="col-xs-4"><center><h3>로그인</h3></center></div>
                        <div class="col-xs-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5 col-xs-8">
                            <form id="user_form" name="user_form" target="">
                                <input type="text" id="user_id" name="user_id" placeholder="ID" class="form-control"/>
                                <input type="password" id="user_pw" name="user_pw" placeholder="PASSWORD" class="form-control"/>
                            </form>
                        </div>
                        <div class="col-md-3 col-xs-4">
                            <button class="btn btn-lg btn-primary btn-block login_button" onclick="login_submit();">LOGIN</button>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 col-xs-12">
                        <button class="btn btn-lg btn-success btn-block" onclick="location.href='/member/join'">JOIN</button>
                    </div>
                    <div class="col-md-2"></div>
                </div>

	</div>
        
        <script>
            function login_submit(){
                
                if($("#user_id").val() == "" || $("#user_pw").val() == ""){
                
                    if($("#user_id").val() == ""){
                        alert("아이디를 입력해주세요.");
                        $("#user_id").focus();
                        return false;
                    }
                    if($("#user_pw").val() == ""){
                        alert("비밀번호를 입력해주세요.");
                        $("#user_pw").focus();
                        return false;
                    }
                }else{

                    $.ajax({
                        url:'/main/login_process',
                        type:'post',
                        data:$('#user_form').serialize(),
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
        </script>
</body>
</html>