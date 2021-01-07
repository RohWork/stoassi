
	<div class="container">
		<div class="page-header">
			<h1>재고관리</h1>
			<p class="lead">재고관리 화면</p>
		</div>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>NO</th>
						<th>재료명</th>
						<th>재료타입</th>
						<th>재료 남은갯수</th>
						<th>최근수정일</th>
						<th>사용여부</th>
						<th>수정/삭제</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1+$offset;
				foreach($rows as $row){
					switch($row->stock_level){
						case 3:
							$row->lv3_sc_name = null;
							break;
						case 2:
							$row->lv3_sc_name = null;
							$row->lv2_sc_name = null;
							break;
						case 1:
							$row->lv3_sc_name = null;
							$row->lv2_sc_name = null;
							$row->lv1_sc_name = null;
							break;
					}					
					
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->name?></td>
						<td>
							<?=$row->lv1_sc_name?><?= !empty($row->lv1_sc_name) ? ">" : "" ?>
							<?=$row->lv2_sc_name?><?= !empty($row->lv2_sc_name) ? ">" : "" ?>
							<?=$row->lv3_sc_name?><?= !empty($row->lv3_sc_name) ? ">" : "" ?>
							<?=$row->category_name?>
						</td>
						<td><?=$row->count?> <?=$row->unit?></td>
						<td><?=date('Y-m-d', strtotime($row->modi_date))?></td>
						<td><?=$row->state == 1 ? "사용" : "사용안함" ?></td>
						<td><button type="button" id="modi_button" onclick="detail_stock_show('<?=$row->idx?>')" class="btn btn-default">확인/수정</button></td>
					</tr>
				<?php
				$no ++;
				}
				?>				
				</tbody>
			</table>
		</div>
		<div class="col-sm-12">
			<button type="button" id="input_button" class="btn btn-primary">상품추가</button>
		</div>
		<div class="col-sm-offset-5">
			<ul class="pagination">
				<?= $pagination ?>
			</ul>
		</div>
	</div>
	<!-- Modal -->
	<div id="modal_stock_detail" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">재고상세화면</h4>
		  </div>
		  <div class="modal-body">
			<form id="stock_update_form" enctype="multipart/form-data" class="form-horizontal">
				<div class="form-group">
					<label for="stock_name" class="col-sm-3 control-label">재료명</label>
					<div class="col-sm-8">
                                                <input type="hidden" id="update_stock_idx" name="update_stock_idx"/>
                                                       
                                                       
						<input type="text" id="update_stock_name" name="update_stock_name" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label for="stock_category_idx" class="col-sm-3 control-label">자료타입</label>
					<div class="col-sm-8">
						<select name="update_stock_category_idx" id="update_stock_category_idx" class="form-control"></select>
					</div>
				</div>
				<div class="form-group">
					<label for="stock_name" class="col-sm-3 control-label">재료사진</label>
					<div class="col-sm-8">
						<img id="stock_image" src="" class="img-responsive" id="view_stock_image">
						<input type="file" id="update_stock_image" name="update_stock_image" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label for="update_stock_seller_idx" class="col-sm-3 control-label">구입처</label>
					<div class="col-sm-8">
						<select name="update_stock_seller_idx" id="update_stock_seller_idx" class="form-control"></select>
					</div>
				</div>
				<div class="form-group">
					<label for="update_stock_count" class="col-sm-3 control-label">재료갯수</label>
					<div class="col-sm-4">
						<input type="number" id="update_stock_count" name="update_stock_count" class="form-control" readonly/>
					</div>
					<label for="update_stock_unit" class="col-sm-2 control-label">갯수단위</label>
					<div class="col-sm-2">
						<input type="text" id="update_stock_unit" name="update_stock_unit" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label for="stock_amt_history" class="col-sm-3 control-label">최근구매금액</label>
					<div class="col-sm-8">
						<div id="stock_amt_history"></div>
					</div>
				</div>
				<div class="form-group">
					<label for="stock_comment" class="col-sm-3 control-label">재료설명</label>
					<div class="col-sm-8">
						<textarea id="update_stock_comment" name="update_stock_comment" class="form-control"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="update_stock_useyn" class="col-sm-3 control-label">사용여부</label>
					<div class="col-sm-9">
						<label class="radio-inline">
						<input type="radio" name="update_stock_useyn" id="stock_use_y">사용
						</label>
						<label class="radio-inline">
						<input type="radio" name="update_stock_useyn" id="stock_use_n">사용안함
						</label>
					</div>
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" onclick="modal_close('stock_update_form')" class="btn btn-default" data-dismiss="modal">취소</button>
			<button type="button" onclick="stock_update()" class="btn btn-primary">저장하기</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<div id="modal_stock_insert" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">재고상품추가</h4>
		  </div>
		  <div class="modal-body">
			<form id="stock_insert_form" enctype="multipart/form-data" class="form-horizontal">
				<div class="form-group">
					<label for="stock_name" class="col-sm-3 control-label">재료명</label>
					<div class="col-sm-8">
						<input type="text" id="insert_stock_name" name="insert_stock_name" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label for="insert_stock_category_idx" class="col-sm-3 control-label">자료타입</label>
					<div class="col-sm-8">
						<select name="insert_stock_category_idx" id="insert_stock_category_idx" class="form-control"></select>
					</div>
				</div>
				<div class="form-group">
					<label for="insert_stock_image" class="col-sm-3 control-label">재료사진</label>
					<div class="col-sm-8">
						<input type="file" id="insert_stock_image" name="insert_stock_image" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label for="insert_stock_seller_idx" class="col-sm-3 control-label">구입처</label>
					<div class="col-sm-8">
						<select name="insert_stock_seller_idx" id="insert_stock_seller_idx" class="form-control"></select>
					</div>
				</div>
				<div class="form-group">
					<label for="insert_stock_count" class="col-sm-3 control-label">재료갯수</label>
					<div class="col-sm-4">
						<input type="number" id="insert_stock_count" name="insert_stock_count" class="form-control" value="0"/>
					</div>
					<label for="insert_stock_unit" class="col-sm-2 control-label">갯수단위</label>
					<div class="col-sm-2">
						<input type="text" id="insert_stock_unit" name="insert_stock_unit" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label for="insert_stock_comment" class="col-sm-3 control-label">재료설명</label>
					<div class="col-sm-8">
						<textarea id="insert_stock_comment" name="insert_stock_comment" class="form-control"></textarea>
					</div>
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" onclick="modal_close('stock_insert_form')" class="btn btn-default" data-dismiss="modal">취소</button>
			<button type="button" onclick="stock_insert()" class="btn btn-primary">저장하기</button>
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
            $("#modal_stock_insert").modal('show');
            get_category_info(0, 'insert');
            get_seller_info(0,'insert');
    });

    function detail_stock_show(idx){
        var params =  {
                "idx" : idx
        };
        $.ajax({
            url:'/stock/get_stock_info',
            type:'post',
            data:params,
            success:function(data){
                set_detail_modal(data.result);
            }
    })

            $("#modal_stock_detail").modal('show');
    }

    function set_detail_modal(data){
        
            $("#update_stock_idx").val(data.idx);
            $("#update_stock_name").val(data.name);
            $("#update_stock_count").val(data.count);
            $("#update_stock_unit").val(data.unit);
            $("#update_stock_comment").val(data.memo);
            $("#update_stock_useyn").val(data.state);
            
            if(data.state == "1"){
                $("#stock_use_y").prop("checked", true);
            }else{
                $("#stock_use_y").prop("checked", false);
            }
            
            if(data.image != null){
                $("#stock_image").attr("src", 'http://<?=$_SERVER['HTTP_HOST']?>'+data.image);
            }else{
                $("#stock_image").attr("src", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKaZM3avvgYxxTcLs_z8BzV-grlQfZF_NhSQ&usqp=CAU");
            }
            if(data.history_price != null){
                $("#stock_amt_history").text("€ "+data.history_price);
            }else{
                $("#stock_amt_history").text("정보없음");
            }
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