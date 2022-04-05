$('#form-login').
    submit(
        function(){
            var data = $(this).serialize();
            $.ajax({
                type : "POST",
                url : "library/ajax/php/main.php?req=login",
                data : data,
                success : function(data){
                   if(data==1){ window.location="."}
                   else{

                    Toastify({
                        text: data,
                        duration: 5000,
                        close:true,
                        gravity: "bottom", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        backgroundColor: "rgb(223, 71, 89)",
                    }).showToast();
            
                   }

                }
              });
              return false;

        });

        $('#register').
        submit(
            function(){
                var data = $(this).serialize();
                $.ajax({
                    type : "POST",
                    url : "library/ajax/php/main.php?req=register",
                    data : data,
                    success : function(data){
                       if(data==1){ window.location="./login?successreg=true"}
                       else{
                         Toastify({
                            text: data,
                            duration: 5000,
                            close:true,
                            gravity: "bottom", // `top` or `bottom`
                            position: "center", // `left`, `center` or `right`
                            backgroundColor: "rgb(223, 71, 89)",
                        }).showToast();
                
                       }
    
                    }
                  });
                  return false;
    
            });