
	<div class="container">
		<div class="page-header">
			<h1>재고업체 관리</h1>
			<p class="lead">재고업체 관리 화면</p>
		</div>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>NO</th>
						<th>업체명</th>
						<th>업체위치</th>
						<th>담당자 이메일</th>
						<th>전화번호</th>
						<th>메모</th>
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
						<td><?=$row->name?></td>
						<td><?=$row->addr?></td>
						<td><?=$row->email?></td>
						<td><?=$row->tel?></td>
						<td><?=$row->memo?></td>
						<td><button type="button" id="modi_button" onclick="detail_seller_show('<?=$row->idx?>')" class="btn btn-default">확인/수정</button></td>
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
	<div id="modal_seller_detail" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">업체 상세화면</h4>
		  </div>
		  <div class="modal-body">
			<form id="seller_update_form" enctype="multipart/form-data" class="form-horizontal">
				<div class="form-group">
					<label for="update_seller_name" class="col-sm-3 control-label">업체명</label>
					<div class="col-sm-8">
						<input type="text" id="update_seller_name" name="update_seller_name" class="form-control"/>
                                                <input type="hidden" id="update_seller_idx" name="update_seller_idx" />
					</div>
				</div>
				<div class="form-group">
					<label for="update_seller_addr" class="col-sm-3 control-label">업체위치</label>
					<div class="col-sm-8">
						<input type="text" id="update_seller_addr" name="update_seller_addr" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label for="update_seller_email" class="col-sm-3 control-label">담당자이메일</label>
					<div class="col-sm-8">
						<input type="text" id="update_seller_email" name="update_seller_email" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label for="update_seller_phone" class="col-sm-3 control-label">전화번호</label>
                                        <div class="col-sm-2">
                                            <input type="number" name="update_seller_tel1" id="update_seller_tel1" maxlength="3" oninput="maxLengthCheck(this)"  class="form-control" />
					</div>
                                        <div class="col-sm-3">
                                            <input type="number" name="update_seller_tel2" id="update_seller_tel2" maxlength="4" size="5" oninput="maxLengthCheck(this)" class="form-control" />
					</div>
                                        <div class="col-sm-3">
                                            <input type="number" name="update_seller_tel3" id="update_seller_tel3" maxlength="4" size="5" oninput="maxLengthCheck(this)" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label for="update_seller_memo" class="col-sm-3 control-label">메모</label>
					<div class="col-sm-8">
						<textarea id="update_seller_memo" name="update_seller_memo" class="form-control"></textarea>
					</div>
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" onclick="modal_close('seller_update_form')" class="btn btn-default" data-dismiss="modal">취소</button>
			<button type="button" onclick="seller_update()" class="btn btn-primary">저장하기</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<div id="modal_seller_insert" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">재고 업체 추가</h4>
		  </div>
		  <div class="modal-body">
			<form id="seller_insert_form" enctype="multipart/form-data" class="form-horizontal">
				<div class="form-group">
					<label for="insert_seller_name" class="col-sm-3 control-label">업체명</label>
					<div class="col-sm-8">
						<input type="text" id="insert_seller_name" name="insert_seller_name" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label for="insert_seller_addr" class="col-sm-3 control-label">업체위치</label>
					<div class="col-sm-8">
						<input type="text" id="insert_seller_addr" name="insert_seller_addr" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label for="insert_seller_email" class="col-sm-3 control-label">담당자이메일</label>
					<div class="col-sm-8">
                                            <input type="email" id="insert_seller_email" name="insert_seller_email" class="form-control" placeholder="이메일을 입력하세요"/>
					</div>
				</div>
				<div class="form-group">
					<label for="insert_seller_phone" class="col-sm-3 control-label">전화번호</label>
					<div class="col-sm-2">
                                            <input type="number" name="insert_seller_tel1" id="insert_seller_tel1" maxlength="3" oninput="maxLengthCheck(this)"  class="form-control" />
					</div>
                                        <div class="col-sm-3">
                                            <input type="number" name="insert_seller_tel2" id="insert_seller_tel2" maxlength="4" size="5" oninput="maxLengthCheck(this)" class="form-control" />
					</div>
                                        <div class="col-sm-3">
                                            <input type="number" name="insert_seller_tel3" id="insert_seller_tel3" maxlength="4" size="5" oninput="maxLengthCheck(this)" class="form-control" />
					</div>

				</div>
				<div class="form-group">
					<label for="insert_seller_memo" class="col-sm-3 control-label">메모</label>
					<div class="col-sm-8">
						<textarea id="insert_seller_memo" name="insert_seller_memo" class="form-control"></textarea>
					</div>
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
                      <button type="button" onclick="modal_close('seller_insert_form')" class="btn btn-default" data-dismiss="modal">취소</button>
                      <button type="submit" onclick="seller_insert()" class="btn btn-primary">저장</button>
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
            $("#modal_seller_insert").modal('show');

    });

    function detail_seller_show(idx){
        var params =  {
                "idx" : idx
        };
        $.ajax({
            url:'/StockSeller/get_seller_info',
            type:'post',
            data:params,
            success:function(data){
                set_detail_modal(data.result);
            }
    })

            $("#modal_seller_detail").modal('show');
    }

    function set_detail_modal(data){
        
            $("#update_seller_idx").val(data.idx);
            $("#update_seller_name").val(data.name);
            $("#update_seller_addr").val(data.addr);
            $("#update_seller_email").val(data.email);
            
            
            var arr = data.tel.split("-");
            $("#update_seller_tel1").val(arr[0]);
            $("#update_seller_tel2").val(arr[1]);
            $("#update_seller_tel3").val(arr[2]);
            
            $("#update_seller_memo").val(data.memo);
            
    }

    function modal_close(id_val){
            $("#"+id_val)[0].reset();
    }


function seller_insert(){

        var seller_name = $("#insert_seller_name");
        var seller_addr = $("#insert_seller_addr");
        var seller_email = $("#insert_seller_email");
        var seller_tel1 = $("#insert_seller_tel1");
        var seller_tel2 = $("#insert_seller_tel2");
        var seller_tel3 = $("#insert_seller_tel3");

        if(seller_name.val() == ""){
                alert("업체명을 입력하시기 바랍니다.");
                seller_name.focus();
                return;
        }
        if(seller_addr.val() == ""){
                alert("업체위치 데이터를 입력해주시기 바랍니다.");
                seller_addr.focus();
                return;
        }
        if(seller_email.val() == ""){
                alert("업체 담당자 이메일주소를 입력해주시기 바랍니다.");
                seller_email.focus();
                return;
        }else if(!validateEmail(seller_email.val())){
                alert("올바른 이메일 주소가 아닙니다.");
                seller_email.focus();
                return;           
        }
        if(seller_tel1.val() == "" || seller_tel2.val() == "" || seller_tel3.val() == ""){
                alert("전화번호를 입력해주시기 바랍니다.");
                seller_tel1.focus();
                return;
        }

        var form = $("#seller_insert_form");


        $.ajax({
            url:'/stockSeller/set_seller',
            type:'post',
            data:form.serialize(),
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
    
    
    function seller_update(){
        
        var seller_name = $("#update_seller_name");
        var seller_addr = $("#update_seller_addr");
        var seller_email = $("#update_seller_email");
        var seller_tel1 = $("#update_seller_tel1");
        var seller_tel2 = $("#update_seller_tel2");
        var seller_tel3 = $("#update_seller_tel3");

        if(seller_name.val() == ""){
                alert("업체명을 입력하시기 바랍니다.");
                seller_name.focus();
                return;
        }
        if(seller_addr.val() == ""){
                alert("업체 위치를 입력하시기 바랍니다.");
                seller_addr.focus();
                return;
        }
        if(seller_email.val() == ""){
                alert("담당자의 이메일주소를 입력하시기 바랍니다.");
                seller_email.focus();
                return;
        }else if(!validateEmail(seller_email.val())){
                alert("올바른 이메일 주소가 아닙니다.");
                seller_email.focus();
                return;           
        }
        
        if(seller_tel1.val() == "" || seller_tel2.val() == "" || seller_tel3.val() == ""){
                alert("전화번호를 입력해주시기 바랍니다.");
                seller_tel1.focus();
                return;
        }
          
        var form = $("#seller_update_form");

        $.ajax({
            url:'/stockSeller/set_update_seller',
            type:'post',
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
    
    function maxLengthCheck(object){
        if (object.value.length > object.maxLength){
          object.value = object.value.slice(0, object.maxLength);
        }    
    }
    
    function validateEmail(sEmail){
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/ ;
        
        if (filter.test(sEmail)) {
            return true;
        }else{
            return false;
        }
    }
   
</script>
</html>