$(".save-data").click(function(event){
    event.preventDefault();
    console.log(event.target.id);

    let id = event.target.id

    let post = $("input[name=post"+ id +"]").val();
    let user = $("input[name=user"+ id +"]").val();
    let _token   = $('meta[name="csrf-token"]').attr('content');


    $.ajax({
        url: "/ajax-request",
        type:"POST",
        data:{
            post:post,
            user:user,
            _token: _token
        },
        success:function(response){
            console.log(response);
            if(response) {
                $('.success').text(response.success);
            }
        },
    });
});