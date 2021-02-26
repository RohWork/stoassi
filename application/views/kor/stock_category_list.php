
	<div class="container">
		<div class="page-header">
			<h1>재고타입 관리</h1>
			<p class="lead">재고타입 관리 화면</p>
		</div>
		<div class="panel panel-default search-form">
			<div class="panel-body">
				<form name="sfrm" id="sfrm" action="<?=$base_url?>" method="get" class="form-inline" onSubmit="return fsearch(this,'');" data-target-src="base_url">
					<div class="row-element">
						<div class="row">
							<div class="col-lg-12">
								<div class="row-element">
									<div class="form-group">
									<label for="">레벨선택</label>
										<select id="category_level" name="category_level" class="form-control" onclick="this.form.submit();">
											<option value="">전체보기</option>
											<option value="1">1레벨</option>
											<option value="2">2레벨</option>
											<option value="3">3레벨</option>
											<option value="4">4레벨</option>
										</select>
										<!--<button type="submit" class="btn btn-primary">검색</button>-->
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>NO</th>
						<th>재고타입명</th>
						<th>레벨</th>
						<th>코드</th>
						<th>최근수정일</th>
						<th>사용여부</th>
						<th>수정/삭제</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no =1+$offset;
				if(!empty($rows)){
					foreach($rows as $row){
					?>
						<tr>
							<td><?=$no?></td>
							<td><?=$row->name?></td>
							<td><?=$row->level?></td>
							<td><?=$row->stock_code?></td>
							<td><?=date('Y-m-d', strtotime($row->modi_date))?></td>
							<td><?=$row->state == 1 ? "사용" : "사용안함" ?></td>
							<td><button type="button" id="modi_button" onclick="detail_category_show('<?=$row->idx?>')" class="btn btn-default">확인/수정</button></td>
						</tr>
					<?php
						$no++;
					}
				}else{
					echo "<tr><td colspan='7' align='center'>데이터없음</td></tr>";	
				}
					?>				
				</tbody>
			</table>
		</div>
		<div class="col-sm-12">
			<button type="button" id="input_button" class="btn btn-primary">타입 추가</button>
		</div>
		<div class="col-sm-offset-5">
			<ul class="pagination">
				<?= $pagination ?>
			</ul>
		</div>
	</div>
	<!-- Modal -->
	<div id="modal_category_detail" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">타입상세화면</h4>
		  </div>
		  <div class="modal-body">
			<form id="category_update_form" enctype="multipart/form-data" class="form-horizontal">
				<div class="form-group">
					<label for="stock_name" class="col-sm-3 control-label">타입명</label>
					<div class="col-sm-8">
						<input type="hidden" id="update_category_idx" name="update_category_idx"/>
						<input type="text" id="update_category_name" name="update_category_name" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label for="update_category_idx_lv1" class="col-sm-3 control-label">level </label>
					<div class="col-sm-8">
						<span id="update_category_level" name="update_category_level"></span>
					</div>
				</div>
				<div class="form-group">
					<label for="update_category_code" class="col-sm-3 control-label">타입 코드 </label>
					<div class="col-sm-8">
						<input type="text" name="update_category_code" id="update_category_code" disabled="disabled" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label for="update_category_useyn" class="col-sm-3 control-label">사용여부</label>
					<div class="col-sm-9">
						<label class="radio-inline">
						<input type="radio" name="update_category_useyn" id="stock_use_y" value='1'>사용
						</label>
						<label class="radio-inline">
						<input type="radio" name="update_category_useyn" id="stock_use_n" value='2'>사용안함
						</label>
					</div>
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" onclick="modal_close('category_update_form')" class="btn btn-default" data-dismiss="modal">취소</button>
			<button type="button" onclick="category_update()" class="btn btn-primary">저장하기</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<div id="modal_category_insert" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">카테고리추가</h4>
		  </div>
		  <div class="modal-body">
			<form id="category_insert_form" name="category_insert_form" enctype="multipart/form-data" class="form-horizontal">
				<div class="form-group">
					<label for="stock_name" class="col-sm-3 control-label">카테고리명</label>
					<div class="col-sm-8">
						<input type="text" id="insert_category_name" name="insert_category_name" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label for="insert_category_lv1" class="col-sm-3 control-label">레벨1 선택</label>
					<div class="col-sm-8">
						<select name="insert_category_lv1" id="insert_category_lv1" class="form-control" onchange="get_lv_category(1, this)"></select>
					</div>
				</div>
				<div class="form-group">
					<label for="insert_category_lv2" class="col-sm-3 control-label">레벨2 선택</label>
					<div class="col-sm-8">
						<select name="insert_category_lv2" id="insert_category_lv2" class="form-control" onchange="get_lv_category(2,this)"></select>
					</div>
				</div>
				<div class="form-group">
					<label for="insert_category_lv3" class="col-sm-3 control-label">레벨3 선택</label>
					<div class="col-sm-8">
						<select name="insert_category_lv3" id="insert_category_lv3" class="form-control" onchange="get_lv_category(3,this)"></select>
					</div>
				</div>
				<div class="form-group">
					<label for="insert_stock_seller_idx" class="col-sm-3 control-label">카테고리 코드값</label>
					<div class="col-sm-2">
						<input type="text" name="insert_category_code_lv1" id="insert_category_code_lv1" class="form-control" size="3" maxlength="2" readonly/>
					</div>
					<div class="col-sm-2">
						<input type="text" name="insert_category_code_lv2" id="insert_category_code_lv2" class="form-control" size="3" maxlength="2" readonly/>
					</div>
					<div class="col-sm-2">	
						<input type="text" name="insert_category_code_lv3" id="insert_category_code_lv3" class="form-control" size="3" maxlength="2" readonly/>
					</div>
					<div class="col-sm-2">
						<input type="text" name="insert_category_code_lv4" id="insert_category_code_lv4" class="form-control" size="3" maxlength="2" readonly/>
					</div>
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" onclick="modal_close('category_insert_form')" class="btn btn-default" data-dismiss="modal">취소</button>
			<button type="button" onclick="category_insert()" class="btn btn-primary">저장하기</button>
		  </div>
		</div>
	  </div>
	</div>
</body>
<script>

	var select_arr_lv1 = new Array();
	var select_arr_lv2 = new Array();
	var select_arr_lv3 = new Array();
	var result_code;
	
    $(document).ready(function(){
		
			$("#category_level").val("<?=$params['category_level']?>").prop("selected", true);
			get_category_code(1,0);
            var modfy_idx;
    });

    $("#input_button").click(function(){
            $("#modal_category_insert").modal('show');
			get_category_code(1,0);
            get_category_info(0, 'insert', 0);
    });

    function detail_category_show(idx){
        var params =  {
                "idx" : idx
        };
        $.ajax({
            url:'/StockCategory/get_category_info',
            type:'post',
            data:params,
            success:function(data){
                set_detail_modal(data.result);
            }
    })

            $("#modal_category_detail").modal('show');
    }

    function set_detail_modal(data){
        
            $("#update_category_idx").val(data.idx);
            $("#update_category_name").val(data.name);
            $("#update_category_code").val(data.stock_code);
            $("#update_category_useyn").val(data.state);
            
            if(data.state == "1"){
                $("#stock_use_y").prop("checked", true);
            }else{
                $("#stock_use_n").prop("checked", true);
            }
            

            get_category_info(data.stock_code, 'detail', data.level);
    }

    function modal_close(id_val){
            $("#"+id_val)[0].reset();
    }


    function get_category_info(code, mode, level){

        $.ajax({
			url:'/StockCategory/get_stock_category',
			type:'post',
			data:'',
			success:function(data){

				var select_arr_lv1 = ["<option value='0'>선택안함</option>"];
				select_arr_lv2 = new Array();
				select_arr_lv3 = new Array();
				
				if(code != ""){
					var lv1_code = code.substr(0,1)+"000000"; 
					var lv2_code = code.substr(0,2)+"0000"; 
					var lv3_code = code.substr(0,3)+"00"; 
					var lv4_code = code;
				}

				var view_str = "";
				data.forEach(function (item){
						
						
						
						var stock_code = item.stock_code;
						var name = item.name;
						var mlevel = item.level;
						
						if(lv1_code == stock_code || lv2_code == stock_code || lv3_code == stock_code || lv4_code == stock_code){

							if(mlevel == level){
								view_str = view_str+name;
							}else{
								view_str = view_str+name+" > ";
							}
							
							
								
						}
						
						str = "<option value='"+stock_code+"'>"+name+"</option>";
						
						if(mlevel == "1"){
							select_arr_lv1.push(str);
						}else if(mlevel == "2"){
							var mlv1_code = stock_code.substr(0,2)+"000000"; 
							if(typeof(select_arr_lv2[mlv1_code]) == 'undefined'){
								select_arr_lv2[mlv1_code] = ["<option value='0'>선택안함</option>"];
							}
							
							select_arr_lv2[mlv1_code].push(str);
							
						}else if(mlevel == "3"){
							var mlv2_code = stock_code.substr(0,4)+"0000"; 
							if(typeof(select_arr_lv3[mlv2_code]) == 'undefined'){
								select_arr_lv3[mlv2_code] = ["<option value='0'>선택안함</option>"];
							}
							select_arr_lv3[mlv2_code].push(str);
						}
						
				});
				
				
				
				if(mode == 'detail'){
						
						$("#update_category_level").html(view_str);
				}else{
					var category_lv = "";
					if(typeof select_arr_lv1[code] !== 'undefined'){
						for(var j=0;j<select_arr_lv1.length;j++){
							category_lv += select_arr_lv1[j]
							$("#insert_category_lv1").html(category_lv);
						}
					}
				}
			}
		});
	
    }
	function get_lv_category(level, select){
		
		var code = $(select).val();
		var category_lv ;
		
		if(level == 1){
			set_category_code_null(1);
			if( code != 0 ){
				if(typeof select_arr_lv2[code] !== 'undefined'){
					for(var j=0;j<select_arr_lv2[code].length;j++){
						category_lv += select_arr_lv2[code][j];
						$("#insert_category_lv2").html(category_lv);
					}
				}
				get_category_code(2,code.substr(0,2));
				$("#insert_category_code_lv1").val(code.substr(0,2));
			}else{
				get_category_code(1,0);
			}
			
			
		}else if(level == 2){
			set_category_code_null(2);
			if(code != 0){
				if( typeof select_arr_lv3[code] !== 'undefined'){
					for(var j=0;j<select_arr_lv3[code].length;j++){
						category_lv += select_arr_lv3[code][j];
						$("#insert_category_lv3").html(category_lv);
					}
				}
				get_category_code(3,code.substr(0,4));
				$("#insert_category_code_lv2").val(code.substr(2,2));
			}else{
				get_category_code(2,$("#insert_category_code_lv1").val().substr(0,2));
			}
			
			

		}else {
			set_category_code_null(3);		
			
			if( code != 0 ){
				if($("#insert_category_code_lv3").val() != "undefined"){
					$("#insert_category_code_lv3").val(code.substr(4,2));
				}
				
				get_category_code(4,code.substr(0,6));
			}else{
				
				get_category_code(3,$("#insert_category_code_lv2").val().substr(0,4));
			}
		}
		
		
	}
	
	function get_category_code(level, code){
		
		var params =  {
                "level" : level,
				"code"	: code
        };
		
		$.ajax({
            url:'/stockCategory/get_category_code',
            type:'post',
            data:params,
            success:function(data){
				
				set_category_code(level, data.code);
				
				return;
            },
            error: function(xhr,status,error) {
                console.log(xhr,status,error);
                alert("네트워크 오류!! 관리자에게 문의 주세요!!");
                return false;
            }	 
        });
	}
	
	function set_category_code(level, code){

		switch(level){
			case 1:
				$("#insert_category_code_lv1").val(code);
				$("#insert_category_code_lv2").val('');
				$("#insert_category_code_lv3").val('');
				$("#insert_category_code_lv4").val('');
				break;
			case 2:
				$("#insert_category_code_lv2").val(code);
				$("#insert_category_code_lv3").val('');
				$("#insert_category_code_lv4").val('');
				break;
			case 3:
				$("#insert_category_code_lv3").val(code);
				$("#insert_category_code_lv4").val('');
				break;
			case 4:
				$("#insert_category_code_lv4").val(code);
				break;	
			
		}
		
	}
	function set_category_code_null(level){
		switch(level){
			case 1:
				$("#insert_category_lv2").html('');
				$("#insert_category_lv3").html('');
				$("#insert_category_lv4").html('');
				$("#insert_category_code_lv2").val('');
				$("#insert_category_code_lv3").val('');
				$("#insert_category_code_lv4").val('');
				break;
			case 2:
				$("#insert_category_lv3").html('');
				$("#insert_category_lv4").html('');
				$("#insert_category_code_lv3").val('');
				$("#insert_category_code_lv4").val('');
				break;
			case 3:
				$("#insert_category_lv4").html('');
				$("#insert_category_code_lv4").val('');
				break;
		}
	}
	function category_insert(){

        var category_name = $("#insert_category_name");
        var category_code1 = $("#insert_category_code_lv1");
		var category_code2 = $("#insert_category_code_lv2");
		var category_code3 = $("#insert_category_code_lv3");
		var category_code4 = $("#insert_category_code_lv4");
		var category_select1 = $("#insert_category_lv1");
		var category_select2 = $("#insert_category_lv2");
		var category_select3 = $("#insert_category_lv3");

		
        if(category_name.val() == ""){
			alert("재료타입명을 입력하시기 바랍니다.");
			category_name.focus();
			return;
        }
		
		

        var form = $("#category_insert_form");

        $.ajax({
            url:'/StockCategory/set_category',
            type:'post',
            data:form.serialize(),
			dataType: 'json',
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
    
    
    function category_update(){
        
        var category_name = $("#update_category_name");

        if(category_name.val() == ""){
                alert("타입명을 입력하시기 바랍니다.");
                category_name.focus();
                return;
        }
	        
        var form = $("#category_update_form");
        var formData = new FormData(form[0]);
        
        $.ajax({
            url:'/stockCategory/set_update_category',
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
    

        
</script>
</html>