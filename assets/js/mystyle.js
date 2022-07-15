let i = 0;
let j = 0;
let k = 0;
let m = 0; 

$(document).ready(function(){

	$("#admin_add_muni").click(function(){
		$(".admin_add_mnc").toggle();
	});

	$("#admin_add_muni").click(function(){
		$(".admin_add_truck").toggle();
	});


	$("#admin_back_btn1").click(function(){
		$(".admin_add_mnc").hide();
	})

	$("#admin_back_btn1").click(function(){
		$(".admin_add_truck").hide();
	})

	$("#admin_gb_save").click(function(){
		return confirm("Are you sure");
	});

	$("#admin_edit_remove").click(function(){
		return confirm("Are you sure");
	});

	$("#admin_user_remove").click(function(){
		return confirm("Are you sure want to delete");
	});

	$("#admin_edit_editbtn").click(function(){
		$("#myform :input").prop("disabled",false);
		$("#myform :textarea").prop("disabled",false);
	});

	$("#admin_driver_editbtn").click(function(){
		$("#admin_driver_submit_btn").css("display","block");
		$("#driver_form :input").prop("disabled",false);
		$("#driver_form :textarea").prop("disabled",false);

	});

	$("#assign_bin_click").click(function(){
		$("#content_bin_assign").toggle();
		$("#content_bin_view").toggle();
	});
});

function admin_display(r){
	if (r==1){
		i++;
		var element = document.getElementById("icon_1");
		if(i%2==0){
			document.getElementById('admin_row1').style.display="block";
			element.classList.replace('bi-caret-right-fill','bi-caret-down-fill');
			document.getElementById('row_border_1').classList.remove('brd');
		}
		else{
			document.getElementById('admin_row1').style.display="none";
			element.classList.replace('bi-caret-down-fill','bi-caret-right-fill');
			document.getElementById('row_border_1').classList.add('brd');
		}
	}
	else if(r==2){
		j++;
		var element = document.getElementById("icon_2");
		if(j%2==0){
			document.getElementById('admin_row2').style.display="none";
			element.classList.replace('bi-caret-down-fill','bi-caret-right-fill');
			document.getElementById('row_border_2').classList.add('brd');
		}
		else{
			document.getElementById('admin_row2').style.display="block";
			element.classList.replace('bi-caret-right-fill','bi-caret-down-fill');
			document.getElementById('row_border_2').classList.remove('brd');

		}
	}
	else if(r==3){
		k++;
		var element = document.getElementById("icon_3");
		if(k%2==0){
			document.getElementById('admin_row3').style.display="none";
			element.classList.replace('bi-caret-down-fill','bi-caret-right-fill');
			document.getElementById('row_border_3').classList.add('brd');
		}
		else{
			document.getElementById('admin_row3').style.display="block";
			element.classList.replace('bi-caret-right-fill','bi-caret-down-fill');
			document.getElementById('row_border_3').classList.remove('brd');
		}
	}
	else if(r==4){
		m++;
		var element = document.getElementById("icon_4");
		if(m%2==0){
			document.getElementById('admin_row4').style.display="none";
			element.classList.replace('bi-caret-down-fill','bi-caret-right-fill');
			document.getElementById('row_border_4').classList.add('brd');
		}
		else{
			document.getElementById('admin_row4').style.display="block";
			element.classList.replace('bi-caret-right-fill','bi-caret-down-fill');
			document.getElementById('row_border_4').classList.remove('brd');
		}
	}
}

function myfuntion(){
	var input,filter,i,main_block,content,a,txtValue;
	input = document.getElementById('search');
	filter = input.value.toUpperCase();
	main_block = document.getElementById("admin_user_display");
	content = main_block.getElementsByTagName('a');
	

	for (i=0;i<content.length;i++){
		a = content[i].getElementsByTagName('b')[0];
		txtValue = a.textContent || a.innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1){
			content[i].style.display="";
		}
		else{
			content[i].style.display="none";
		}
	}
}

function comp_1(){
	document.getElementById('comp_hide').style.display="block";
	document.getElementById("view_hide").style.display="none";
}
function comp_2(){
	document.getElementById('comp_hide').style.display="none";
	document.getElementById("view_hide").style.display="block";
}


