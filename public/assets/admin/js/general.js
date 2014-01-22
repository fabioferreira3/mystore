function getClientTable(
		name = null, 
		email = null, 
		state = null, 
		country = null, 
		dateSince = null, 
		lastLogin = null, 
		status = null,
		actions = true,
		dates = true,
		selectType = 'checkbox'){	
	
	$('.wait h1').html('Estou procurando...');
	$('body').addClass('loading');	
	
	$.ajax({
	    url: "/admin238/customer/filter",
	    type:"GET",
	    data:{
	    	name:name, 
	    	email:email, 
	    	state:state, 
	    	country:country, 
	    	dateSince:dateSince, 
	    	lastLogin:lastLogin, 
	    	status:status,
	    	actions:actions,
	    	dates:dates,
	    	selectType:selectType},
	    contentType: "application/json; charset=utf-8",
	    dataType:"json",
	    success: function (data) {               
	       $('body').removeClass('loading');
	       $('div.paginator').empty();
	       $('div.paginator').append(data.pagination);
	       $('table.customerResults tbody').empty(); 
	       $('table.customerResults tbody').append(data.maker);          
	    },
	    error: function(request,error){
	        $('body').removeClass('loading');          
	        console.log(arguments);
	        $.sticky(error, {autoclose : 5000, position: "top-right", type:"st-error" });
	    }
	});
	
	
}


function getProductTable(
		
			name,
			sku,
			status =1,
			stockFrom = '',
			stockTo = '',
			priceFrom = '',
			priceTo = '',
			noid = null,
			noprice = null,
			nostatus = null,
			noactions = null,
			inputQty = null,
			addButton = null,
			editStock = null,
			noselect = null,
			nocheckbox = null){
    
	    $('.wait h1').html('Estou procurando...');
	    $('body').addClass('loading');
	    
	    $.ajax({
	        url: "/admin238/product/filter",
	        type:"GET",
	        data:{name:name, 
	        	  sku:sku, 
	        	  status:status, 
	        	  priceFrom:priceFrom, 
	        	  priceTo:priceTo, 
	        	  stockFrom:stockFrom, 
	        	  stockTo:stockTo, 
	        	  noid:noid,
	        	  noprice:noprice,
	        	  nostatus:nostatus,
	        	  noactions:noactions,
	        	  inputQty:inputQty,
	        	  addButton:addButton,
	        	  editStock:editStock,
	        	  noselect:noselect,
	        	  nocheckbox:nocheckbox
	        	  },
	        contentType: "application/json; charset=utf-8",
	        dataType:"json",
	        success: function (data) {
	           $('body').removeClass('loading');	           
	           $('tr.result').remove();
	           $('div.paginator').empty();
	           $('div.paginator').append(data.pagination);
	           $('table.product-results tbody').append(data.maker);          
	        },
	        error: function(request,error){
	            $('body').removeClass('loading');          
	            console.log(arguments);
	            $.sticky(error, {autoclose : 5000, position: "top-right", type:"st-error" });
	        }
	    });
	
}


$(document).ready(function(){ 
$('body').on('click','button#cancelOrder',function(){
    var url = '/admin238/manage-orders/cancel?';
    var accept = confirm('Deseja mesmo cancelar este pedido?');
    if(accept){
        url = url + 'orderid[]=' + $(this).val();
        var updatestock = confirm('Deseja repor o estoque dos itens deste pedido?');
        if(updatestock){
            url = url + '&updatestock=1';
        }
        window.location.replace(url);
    } 
});
});


    
