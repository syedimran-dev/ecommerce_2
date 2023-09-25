$(document).ready(() => {
    $("#current_pass").keyup(() => {
        var current_pass = $("#current_pass").val();
        // alert(current_pass);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-password',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { current_pass: current_pass },
            success: function(resp)  {
                if (resp == "false") {
                    $('#verify_current_pass').html("Current Password is Incorrect!")
                } else if (resp == "true") {
                    $('#verify_current_pass').html("Current Password is Correct!")
                }
            },
            error: function(){
                alert("Error")
            }
        })
    });

    $(document).on("click", ".updateCmsPageStatus", function () {
        var status = $(this).children().attr("status");
        var page_id = $(this).attr("page_id")
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-cms-pages-status',
            data:{status:status, page_id:page_id},
            success: function(resp){
                if(resp['status'] == 1){
                    $("#page-"+page_id).html("<i class='fas fa-toggle-on' style='color:blue' status='Active' ></i>")
                }else if(resp['status'] == 0){
                    $("#page-"+page_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive' ></i>")
                }
            },
            error: function(){
                alert("Error")
            }
        })
    })

    $(document).on("click", ".updateSubAdminStatus", function () {
        var status = $(this).children().attr("status");
        var subadmin_id = $(this).attr("subadmin_id")
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-subadmin-status',
            data:{status:status, subadmin_id:subadmin_id},
            success: function(resp){
                if(resp['status'] == 1){
                    $("#subadmin-"+subadmin_id).html("<i class='fas fa-toggle-on' style='color:blue' status='Active' ></i>")
                }else if(resp['status'] == 0){
                    $("#subadmin-"+subadmin_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive' ></i>")
                }
            },
            error: function(){
                alert("Error")
            }
        })
    })

    $(document).on("click", ".updateCategoryStatus", function () {
        var status = $(this).children().attr("status");
        var category_id = $(this).attr("category_id")
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-category-status',
            data:{status:status, category_id:category_id},
            success: function(resp){
                if(resp['status'] == 1){
                    $("#category-"+category_id).html("<i class='fas fa-toggle-on' style='color:blue' status='Active' ></i>")
                }else if(resp['status'] == 0){
                    $("#category-"+category_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive' ></i>")
                }
            },
            error: function(){
                alert("Error")
            }
        })
    })
})