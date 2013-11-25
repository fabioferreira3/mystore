$(document).ready(function(){
	
$('button#searchCustomer').on('click',function(){
        
        $('.wait h1').html('Estou procurando...');
        $('body').addClass('loading');

        var name = $('input[name="searchName"]').val();
        var email = $('input[name="searchEmail"]').val();
        var state = $('input[name="searchState"]').val();
        var country = $('input[name="searchCountry"]').val();
        var dateSince = $('input[name="searchSince"]').val();
        var lastLogin = $('input[name="searchLastLogin"]').val();
        var status = $('select[name="searchStatus"]').val();

        $.ajax({
            url: "/admin238/customer/filter",
            type:"GET",
            data:{name:name, email:email, state:state, country:country, dateSince:dateSince, lastLogin:lastLogin, status:status},
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
        
    });
	
});