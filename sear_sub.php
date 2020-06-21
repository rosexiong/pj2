
	<div class="btn-group">
		<select name="zt" class="selectpicker">
		 <option value="0">请选择主题</option>
		 <?php 
		$zhuti = getZhuti();
		foreach($zhuti as $k=>$v){?>
			 <option value="<?php echo $v;?>"><?php echo $v;?></option>
		<?php }?>
		</select>
		<select name="gj" class="selectpicker" id="gj_id">
			<option value="0" selected='selected'>请选择国家</option>
			<option value="1">中国</option>
			<option value="2">日本</option>
			<option value="3">英国</option>
			<option value="4">法国</option>
		</select>
		<select name="cs" class="selectpicker" id="cs_id">
			
		</select>
	</div>
<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript" >
$(function(){ 
    getSelectVal(); 
    $("#gj_id").change(function(){ 
        getSelectVal(); 
    }); 
}); 

function getSelectVal(){ 

	var gj_id = $("#gj_id").val();
	
    $.getJSON("aJaxGetSelect.php",{gj_id:gj_id},function(json){ 

        var cs_id = $("#cs_id"); 
	
        $("option",cs_id).remove(); //清空原有的选项 
	
        cs_id.append('<option value="0">请选择城市</option>'); //清空原有的选项 
		
        $.each(json,function(index,array){ 
			
            var option = "<option value='"+array['id']+"' >"+array['name']+"</option>"; 
            cs_id.append(option); 
        }); 
    }); 
} 
</script>