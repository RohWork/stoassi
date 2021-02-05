
	<div class="container">
		<div class="page-header">
			<h1>업체 관리</h1>
			<p class="lead">등록 업체 관리</p>
		</div>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>NO</th>
						<th>업체명</th>
						<th>가게타입</th>
						<th>가입자명</th>
						<th>연락처</th>
						<th>이메일주소</th>
                                                <th>가게주소</th>
						<th>수정/삭제</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1+$offset;
				foreach($rows as $row){
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->shop_name?></td>
						<td><?=$row->shop_category?></td>
						<td><?=$row->user_name?></td>
						<td><?=$row->tel?></td>
						<td><?=$row->email?></td>
                                                <td><?=$row->addr?></td>
						<td><button type="button" id="modi_button" onclick="detail_member_show('<?=$row->idx?>')" class="btn btn-default">확인/수정</button></td>
					</tr>
				<?php
				$no ++;
				}
				?>				
				</tbody>
			</table>
		</div>
		<div class="col-sm-12">
			<button type="button" id="input_button" class="btn btn-primary">업체추가</button>
		</div>
		<div class="col-sm-offset-5">
			<ul class="pagination">
				<?= $pagination ?>
			</ul>
		</div>
	</div>
	<!-- Modal -->
	<div id="modal_member_detail" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">업체정보 수정</h4>
		  </div>
		  <div class="modal-body">
			<form id="member_update_form" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group">
                                    <label for="update_id" class="col-sm-3 control-label">ID</label>
                                    <div class="col-sm-8">
                                            <input type="hidden" id="update_confirm_id" name="update_confirm_id"/>
                                            <input type="text" id="update_id" name="update_id" class="form-control" readonly="readonly"/>
                                    </div>
                            </div>
                            <div class="form-group">
					<label for="update_pw1" class="col-sm-3 control-label">PW1</label>
					<div class="col-sm-8">
						<input type="text" id="update_pw1" name="update_pw1" class="form-control"/>
					</div>
				</div>
                            <div class="form-group">
					<label for="update_pw2" class="col-sm-3 control-label">PW2</label>
					<div class="col-sm-8">
						<input type="text" id="update_pw2" name="update_pw2" class="form-control"/>
					</div>
                            </div>

                            <div class="form-group">
                                    <label for="update_name" class="col-sm-3 control-label">이름</label>
                                    <div class="col-sm-8">
                                            <input type="text" id="update_name" name="update_name" class="form-control"/>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="update_tel" class="col-sm-3 control-label">연락처</label>
                                    <div class="col-sm-8">
                                            <input type="text" id="update_tel" name="update_tel" class="form-control"/>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="update_shop_name" class="col-sm-3 control-label">가게명</label>
                                    <div class="col-sm-8">
                                            <input type="text" id="update_shop_name" name="update_shop_name" class="form-control"/>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="update_shop_category" class="col-sm-3 control-label">가게타입</label>
                                    <div class="col-sm-8">
                                        <select name="update_shop_category" id="update_shop_category" class="form-control"></select>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="update_shop_addr" class="col-sm-3 control-label">가게주소</label>
                                    <div class="col-sm-8">
                                            <input type="text" id="update_shop_addr" name="update_shop_addr" class="form-control"/>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="update_email" class="col-sm-3 control-label">이메일주소</label>
                                    <div class="col-sm-8">
                                            <input type="text" id="update_email" name="update_email" class="form-control"/>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="update_shop_state" class="col-sm-3 control-label">상태</label>
                                    <div class="col-sm-4">
                                        <select name="update_shop_state" id="update_shop_state" class="form-control">
                                            <option value="Y">승인</option>
                                            <option value="1">Lv1</option> 
                                            <option value="2">Lv2</option>
                                            <option value="3">Lv3</option>
                                            <option value="N">비승인</option>
                                        </select>
                                    </div>
                            </div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" onclick="modal_close('member_update_form')" class="btn btn-default" data-dismiss="modal">취소</button>
			<button type="button" onclick="member_update()" class="btn btn-primary">저장하기</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<div id="modal_member_insert" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">업체정보 추가</h4>
		  </div>
		  <div class="modal-body">
			<form id="member_insert_form" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group">
                                    <label for="insert_id" class="col-sm-3 control-label">ID</label>
                                    <div class="col-sm-8">
                                            <input type="hidden" id="update_confirm_id" name="update_confirm_id"/>
                                            <input type="text" id="insert_id" name="insert_id" class="form-control"/>
                                    </div>
                            </div>
                            <div class="form-group">
					<label for="insert_pw1" class="col-sm-3 control-label">PW1</label>
					<div class="col-sm-8">
						<input type="text" id="insert_pw1" name="insert_pw1" class="form-control"/>
					</div>
				</div>
                            <div class="form-group">
					<label for="insert_pw2" class="col-sm-3 control-label">PW2</label>
					<div class="col-sm-8">
						<input type="text" id="insert_pw2" name="insert_pw2" class="form-control"/>
					</div>
                            </div>

                            <div class="form-group">
                                    <label for="insert_name" class="col-sm-3 control-label">이름</label>
                                    <div class="col-sm-8">
                                            <input type="text" id="insert_name" name="insert_name" class="form-control"/>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="insert_tel" class="col-sm-3 control-label">연락처</label>
                                    <div class="col-sm-8">
                                            <input type="text" id="insert_tel" name="insert_tel" class="form-control"/>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="insert_shop_name" class="col-sm-3 control-label">가게명</label>
                                    <div class="col-sm-8">
                                            <input type="text" id="insert_shop_name" name="insert_shop_name" class="form-control"/>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="insert_shop_category" class="col-sm-3 control-label">가게타입</label>
                                    <div class="col-sm-8">
                                        <select name="insert_shop_category" id="insert_shop_category" class="form-control"></select>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="insert_shop_addr" class="col-sm-3 control-label">가게주소</label>
                                    <div class="col-sm-8">
                                            <input type="text" id="insert_shop_addr" name="insert_shop_addr" class="form-control"/>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="insert_email" class="col-sm-3 control-label">이메일주소</label>
                                    <div class="col-sm-8">
                                            <input type="text" id="insert_email" name="insert_email" class="form-control"/>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="insert_shop_state" class="col-sm-3 control-label">상태</label>
                                    <div class="col-sm-4">
                                        <select name="insert_shop_state" id="insert_shop_state" class="form-control">
                                            <option value="Y">승인</option>
                                            <option value="1">Lv1</option> 
                                            <option value="2">Lv2</option>
                                            <option value="3">Lv3</option>
                                            <option value="N">비승인</option>
                                        </select>
                                    </div>
                            </div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" onclick="modal_close('member_insert_form')" class="btn btn-default" data-dismiss="modal">취소</button>
			<button type="button" onclick="member_insert()" class="btn btn-primary">저장하기</button>
		  </div>
		</div>
	  </div>
	</div>
</body>
<script>

    $(document).ready(function(){
            var modfy_idx;
    });

    $("#input_button").click(function(){
            $("#modal_member_insert").modal('show');
            get_category_info(0, 'insert');
    });

    function detail_member_show(idx){
        var params =  {
                "idx" : idx
        };
        $.ajax({
            url:'/member/get_member_info',
            type:'post',
            data:params,
            success:function(data){
                set_detail_modal(data.result_data);
            }
    })

            $("#modal_member_detail").modal('show');
    }

    function set_detail_modal(data){
        
            $("#update_id").val(data.id);
            $("#update_name").val(data.user_name);
            $("#update_tel").val(data.tel);
            $("#update_shop_name").val(data.shop_name);
            $("#update_shop_addr").val(data.addr);
            $("#update_email").val(data.email);
            
            get_category_info(data.category_idx, 'detail');
            set_state_info(data.state, 'detail');
    }

    function modal_close(id_val){
            $("#"+id_val)[0].reset();
    }


    function get_category_info(idx, mode){
        $.ajax({
        url:'/member/get_shop_category',
        type:'post',
        data:'',
        success:function(data){
            var str = '';
            data.forEach(function (item){
                    if(idx == item.idx){
                            str += "<option value='"+item.idx+"' selected>"+item.name+"</option>";
                    }else{
                            str += "<option value='"+item.idx+"'>"+item.name+"</option>";
                    }
            });
            if(mode == 'detail'){
                    $("#update_shop_category").html(str);
            }else{
                    $("#insert_shop_category").html(str);
            }
        }
    })
    }

    function set_state_info(idx, mode){
        $("#update_shop_state").val(idx).attr("selected","selected");
    }

    function shop_insert(){

        var stock_name = $("#insert_stock_name");
        var stock_unit = $("#insert_stock_unit");

        if(stock_name.val() == ""){
                alert("재료명을 입력하시기 바랍니다.");
                stock_name.focus();
                return;
        }
        if(stock_unit.val() == ""){
                alert("갯수 단위를 입력하시기 바랍니다.");
                stock_unit.focus();
                return;
        }
		if($("#update_stock_image").val() != ""){
			file_upload_test($("#insert_stock_image"));
		}
        var form = $("#stock_insert_form");
        var formData = new FormData(form[0]);


        $.ajax({
            url:'/stock/set_stock',
            type:'post',
            processData : false,
            contentType : false,
            data:formData,
            success:function(data){
				alert(data.message);
				
				if(data.code == 200){
					location.reload();
				}
            },
            error: function(xhr,status,error) {
                console.log(xhr,status,error);
                alert("네트워크 오류!! 관리자에게 문의 주세요!!");
                return false;
            }	 
        });

    }
    
    
    function shop_update(){
        
        var uname = new Array($("#update_name"), "이름");
        var utel = new Array($("#update_tel"), "연락처");
        var ushop_name = new Array($("#update_shop_name"), "가게명");
        var ushop_addr = new Array($("#update_shop_addr"), "가게주소");
        var uemail = new Array($("#update_email"), "이메일주소");
        var upw1 = $("#update_pw1");
        var upw2 = $("#update_pw2");
        
        var params = new Array(
                                            uname, 
                                            utel, 
                                            ushop_name, 
                                            ushop_addr, 
                                            uemail, 
                                    );
        if(requre_params(params, upw1, upw2)){
        
            var form = $("#member_update_form");

            $.ajax({
                url:'/member/set_update_member',
                type:'post',
                processData : false,
                contentType : false,
                data:form.serialize(),
                success:function(data){
                    alert('수정완료');
                    location.reload();
                },
                error: function(xhr,status,error) {
                    console.log(xhr,status,error);
                    alert("네트워크 오류!! 관리자에게 문의 주세요!!");
                    return false;
                }	 
            });
        }
    }
    
    function requre_params(params, user_pw1, user_pw2){
        
                var j =0;
                var check_passwd = new Array();
                
                for(var i=0; i<params.length; i++){
                    if(params[i][0].val() == ""){
                        alert(params[i][1]+" 을(를) 확인해주세요.");
                        params[i][0].attr("class","form-control alert-danger");
                        params[i][0].focus();
                        return false;
                    }
                }
                
                if(user_pw1.val() != "" && user_pw2.val() != ""){
                    var num = user_pw1.val().search(/[0-9]/g);
                    var eng = user_pw1.val().search(/[a-z]/ig);
                    var spe = user_pw1.val().search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

                    if(user_pw1.val() != user_pw2.val()){
                        alert("비밀번호가 서로 다릅니다");
                        user_pw1.focus();
                        user_pw1.attr("class","form-control alert-danger");
                        return false;
                    }else if( user_pw1.val().length < 8 || user_pw1.val().length > 20){
                        alert("비밀번호는 8~20자리 이내로 입력해주세요");
                        user_pw1.focus();
                        user_pw1.attr("class","form-control alert-danger");
                        return false;
                    }else if (user_pw1.val().search(/\s/) != -1){
                        alert("비밀번호는 공백 없이 입력해주세요.");
                        user_pw1.focus();
                        user_pw1.attr("class","form-control alert-danger");
                        return false;
                    }else if(num < 0 || eng < 0 || spe < 0){
                        alert("비밀번호는 영문,숫자, 특수문자를 혼합하여 입력해주세요.");
                        user_pw1.focus();
                        user_pw1.attr("class","form-control alert-danger");
                        return false;
                    }
                }
                
                
                return true;
            }
        
</script>
</html>