$(document).ready(function(){
    $('#special').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/makereq",
            data: $('#makingreq').serialize(),
            success: function(result){
                $('#exampleModal').modal('hide');
                $('#main').html($("#main", result).html());
                alert("Request send successfully!");
                setInterval(function(){
                    $.ajax({
                       type:'POST',
                       url:"/getderive",
                       success: function(result2){
                        data = $(result2).find('#main');
                        $('#main').replaceWith(data);
                       }
                    });
                 }, 3000);
               
            },
            error: function(error){
                alert("Oops! There was some error");
            }
        });
    })
    $('#ajax-submit').click(function(e){
    var x = document.getElementById("demo");
        if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            x.style.display = 'block';
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    })
    function showPosition(position) {
        lats = position.coords.latitude;
        long = position.coords.longitude;
           $.ajaxSetup({
               headers:{
                   'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
               }
           });
           $.ajax({
               url: "/getcus",
               method: 'POST',
               data: {lats:lats,long:long},
               success: function(result)
               {
                  $('#main').html($("#main", result).html());
               }
           });
        
    }
});
    
