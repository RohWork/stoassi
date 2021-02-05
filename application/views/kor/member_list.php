
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
                                            <input type="text" id="update_id" name="update_id" class="form-control"/>
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
                                    <div class="col-sm-9">
                                            <select name="update_shop_state" id="update_shop_state" class="form-control"></select>
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
                                    <div class="col-sm-9">
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
            
            get_category_info(data.stock_category_idx, 'detail');
            get_seller_info(data.stock_seller_idx, 'detail');
    }

    function modal_close(id_val){
            $("#"+id_val)[0].reset();
    }


    function get_category_info(idx, mode){
        $.ajax({
        url:'/stock/get_stock_category',
        type:'post',
        data:'',
        success:function(data){
            var str = '';
            data.forEach(function (item){
				var view_name;
					
					
					switch(item.level){
						case "2":
							view_name = item.lv1_sc_name +">"+ item.name;
							break;
						case "3":
							view_name = item.lv1_sc_name +">"+ item.lv2_sc_name +">"+ item.name;
							break;
						case "4":
							view_name = item.lv1_sc_name +">"+ item.lv2_sc_name +">"+item.lv3_sc_name +">"+ item.name;
							break;
						default:
							view_name = item.name;
							break;
					}
                    if(idx == item.idx){
                            str += "<option value='"+item.idx+"' selected>"+view_name+"</option>";
                    }else{
                            str += "<option value='"+item.idx+"'>"+view_name+"</option>";
                    }
            });
            if(mode == 'detail'){
                    $("#update_stock_category_idx").html(str);
            }else{
                    $("#insert_stock_category_idx").html(str);
            }
        }
    })
    }

    function get_seller_info(idx, mode){
        $.ajax({
        url:'/stock/get_stock_seller',
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
                    $("#update_stock_seller_idx").html(str);
            }else{
                    $("#insert_stock_seller_idx").html(str);
            }
        }
    })
    }

function stock_insert(){

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
        formData.append("file", $("#insert_stock_image")[0].files[0]);

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
    
    
    function stock_update(){
        
        var stock_name = $("#stock_name");
        var stock_unit = $("#stock_unit");

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
            file_upload_test($("#update_stock_image"));
        }
        
        var form = $("#stock_update_form");
        var formData = new FormData(form[0]);
        formData.append("file", $("#update_stock_image")[0].files[0]);
        
        $.ajax({
            url:'/stock/set_update_stock',
            type:'post',
            processData : false,
            contentType : false,
            data:formData,
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
    
    function file_upload_test(upload_file){
        var extArray = new Array("jpg", "gif", "png");
        var path = upload_file.val();
        if(path == ""){
            alert("파일을 추가해주세요.");
            return false;
        }
        
        var pos = path.indexOf(".");
        if(pos < 0 ){
            alert("확장자가 없는 파일입니다.");
            return false;
        }
        
        var ext = path.slice(path.indexOf(".")+ 1).toLowerCase();
        var checkExt = false;
        for(var i = 0; i < extArray.length; i++) {
            if(ext == extArray[i]) {
                    checkExt = true;
                    break;
            }
	}

	if(checkExt == false) {
            alert("업로드 할 수 없는 파일 확장자 입니다.");
	    return false;

	}
	return true;

        
    }
        
</script>
</html>