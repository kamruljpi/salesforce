
var leadCreateListFilterSearch = (function(){

	return {
		init: function(){
			var menuValue 	= '';
			var sortbyValue = '';
				
			$('#selectLeadSortbyValue').on('change',function(){
				sortbyValue = $.trim($("#selectLeadSortbyValue").find(":selected").val());
			});

			$('#selectLeadMenuOption').on('change',function(e){
				menuValue = $.trim($("#selectLeadMenuOption").find(":selected").val());

				e.preventDefault();
				$('.pagination_body').addClass('hidden');
				var formDateValue 	= $("input[name='date[from]']").val();
				var toDateValue 	= $("input[name='date[to]']").val();

				var data = 
					{
					selectedOptionValues : menuValue,
					sortbyValues 	:sortbyValue,
					formDateValues  :formDateValue,
					toDateValues    :toDateValue
				};
				var sss = {
					a:inputValidate(menuValue,'error_1'),
					b:inputValidate(sortbyValue,'error_2'),
					c:inputValidate(formDateValue,'error_3'),
					d:inputValidate(toDateValue,'error_4')};
				var id = {a:'error_1',b:'error_2',c:'error_3',d:'error_4'};			
				
				var inputValidates = checkOneTrueValue(sss,id);
				if(inputValidates == false){
					return false;
				}

				$.ajax({
		          type: "GET",
		          url: "/SalesForce/lead/list/Filter/Value",
		          data: data,
		          datatype: 'json',
		          cache: false,
		          async: false,
		          success: function(result) {
		          	var data = JSON.parse(result);
		          	console.log(data);
		          	addRowLead(data,0);
		          },
		          error:function(result){
		            alert("Some thing is Wrong");
		          }
		          });
			});

			$('#search_lead').on('click',function(e){
				e.preventDefault();
				$('.pagination_body').addClass('hidden');
				var formDateValue 	= $("input[name='date[from]']").val();
				var toDateValue 	= $("input[name='date[to]']").val();

				var data = 
					{
					selectedOptionValues : menuValue,
					sortbyValues 	:sortbyValue,
					formDateValues  :formDateValue,
					toDateValues    :toDateValue
				};
				var sss = {
					a:inputValidate(menuValue,'error_1'),
					b:inputValidate(sortbyValue,'error_2'),
					c:inputValidate(formDateValue,'error_3'),
					d:inputValidate(toDateValue,'error_4')};
				var id = {a:'error_1',b:'error_2',c:'error_3',d:'error_4'};			
				
				var inputValidates = checkOneTrueValue(sss,id);
				if(inputValidates == false){
					return false;
				}

				$.ajax({
		          type: "GET",
		          url: "/SalesForce/lead/list/Filter/Value",
		          data: data,
		          datatype: 'json',
		          cache: false,
		          async: false,
		          success: function(result) {
		          	var data = JSON.parse(result);
		          	addRowLead(data,0);
		          },
		          error:function(result){
		            alert("Some thing is Wrong");
		          }
		          });
			});
		}
	}
})();

function inputValidate(value = null ,id){
	var data = true ;
	if(value == null || value == ""){
		$('#'+id+'').addClass('has-error');
		data = false;
	}else{
		$('#'+id+'').removeClass('has-error');
	}
	return data ;
}

function checkOneTrueValue(value = {},id = {}){
	var boolen = false;
	if(value.a || value.b || value.c || value.d == true ){
		$('#'+id.a+'').removeClass('has-error');
		$('#'+id.b+'').removeClass('has-error');
		$('#'+id.c+'').removeClass('has-error');
		$('#'+id.d+'').removeClass('has-error');
		boolen = true;
	}
	return boolen ;
}

function addRowLead(results, start)
{	
	$('.pagination').empty();
    $('#lead_list_tbody').empty();

    var sl = 1;

    var position = start+1;
    start = start*15;

    if(results.length <start+15){
        end = results.length;
    }
    else{
        end = start+15;
    }

    var rows = $.map(results, function(value, index) {
        return [value];
    });
    if( end == 0){
    	$('#lead_list_tbody').append(
    		'<tr class="lead_list_tbody"><td colspan="8" > <center><span style="padding:50px;">Empty Value</span></center> </td> </tr>'
    		);
    }else{
	    for (var i = start; i < end; i++)
	    {	
	    	
	        $('#lead_list_tbody').append('<tr class="lead_list_tbody"><td>'+sl+
	            '</td><td>'+ leadEmptyCheck(rows[i].id_create_lead) +
	            '</td><td>'+ leadEmptyCheck(rows[i].personal_name) +
	            '</td><td>'+ leadEmptyCheck(rows[i].contact_no) +
	            '</td><td>'+ leadEmptyCheck(rows[i].area) +
	            '</td><td>'+ leadEmptyCheck(rows[i].follow_up_date) +
	            '</td><td>'+ rows[i].lead_assign+
	            '</td><td>'+ leadEmptyCheck(rows[i].name) +
	            '</td><td><table><tr><td><a href="/SalesForce/edit/lead/'+rows[i].id_create_lead+'" class="btn btn-primary">Edit</a></td><td><a href="/SalesForce/view/lead/'+rows[i].id_create_lead+'" class="btn btn-success">View</a></td></tr></table></td></tr>');
	           
	        sl++;
	    }
	}

    setLeadPagination(results, position);

    $('.pagination li').on('click',(function () {
        var begin = $(this).attr("data-page");
        addRowLead(results, begin-1);
    }));

}

function leadEmptyCheck(value){
	return ((value == null ) ? "" : value) ;
}



function setLeadPagination(results, position) {
    var pageNum = Math.ceil(results.length/15);
    var previous = (position-1);
    var next = (position+1);
    if(position == 1)
        previous = 1;
    if(position == pageNum)
        next = pageNum;
    $('.pagination').append('<li data-page="'+ previous +'"><span>&laquo;<span class="sr-only">(current)</span></span></li>').show();
    for (i = 1; i <= pageNum;)

    {
        $('.pagination').append('<li data-page="'+i+'">\<span>'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show();
    }
    $('.pagination').append('<li data-page="'+ next +'"><span>&raquo;<span class="sr-only">(current)</span></span></li>').show();

    $('.pagination li:nth-child('+ (position+1) +')').addClass('active');

    if(position == 1)
        $('.pagination li:first-child').addClass('disabled');
    if(position == pageNum)
        $('.pagination li:last-child').addClass('disabled');
}

var leadCreateListReset = (function(){

	return {
		init: function(){
			$('#reset_btn').on('click',function () {
				$('.pagination_body').addClass('hidden');
				$('#selectLeadMenuOption').val("");
				$('#selectLeadSortbyValue').val("");
				$('#formDate').val("");
				$('#toDate').val("");

				$('#error_1').removeClass('has-error');
				$('#error_2').removeClass('has-error');
				$('#error_3').removeClass('has-error');
				$('#error_4').removeClass('has-error');

				$.ajax({
		          type: "GET",
		          url: "/SalesForce/lead/list/all/value",
		          datatype: 'json',
		          cache: false,
		          async: false,
		          success: function(result) {
		          	var data = JSON.parse(result);
		          	addRowLead(data,0)		          	
		          },
		          error:function(result){
		            alert("Some thing is Wrong");
		          }
		          });
			});
		}
	}
})();

var ifaRegisterHideField = (function(){

	return {
		init: function(){

			var selectedValues = '';
			$('#lead_assign').on('change',function(){
				selectedValues = $.trim($("#lead_assign").find(":selected").val());

				if(selectedValues == 'assign_sales_agent'){
					$('.ifa_hide_field').removeClass('hidden');
				}else{
					$('.ifa_hide_field').addClass('hidden');
				}
			});
			var aaa = $('#lead_assign').val();
			removeHiddenClass(aaa);
			
			var itemoptions = {

		    url: function(phrase) {
		      return "/SalesForce/get/ifaRegistervalue";
		    },

		    getValue: function(element) {
		      return element.name;
		    },

		    list: {
		        match: {
		            enabled: true
		        },
		    },
		    // template: {
	    	// 	type: "description",
	    	// 	fields: {
	    	// 		description: "type"
	    	// 	}
	    	// },
		    ajaxSettings: {
		      dataType: "json",
		      method: "GET",
		      data: {
		        dataType: "json"
		      }
		    },

		    requestDelay: 400
		  };
		  $("body #assign_ifa_register_name").easyAutocomplete(itemoptions);
		  $(".add_input .easy-autocomplete").css("width","100%");
		}};
})();

function removeHiddenClass($value){
	if($value == 'assign_sales_agent'){
		$('.ifa_hide_field').removeClass('hidden');
	}
}

$(document).ready(function(){
	leadCreateListFilterSearch.init();
	leadCreateListReset.init();
	ifaRegisterHideField.init();
});