$(document).ready(function()
{
    function refreshCSRFToken() {
        $.get('/refresh-csrf-token', function(data) {
            $('meta[name="csrf-token"]').attr('content', data);
        });
    }

    refreshCSRFToken();
    
    //start sortable function to arrange tasks based on priority (Drag and drop)
    $("#task_sortable").sortable({
        placeholder: "ui-state-highlight",
        update: function(event, ui) {
            var task_order_ids = new Array();
            $('#task_sortable li').each(function() {
                task_order_ids.push($(this).data("id"));
            });

            $.ajax({
                type: "POST",
                url: "/task/task_order_change",
                dataType: "json",
                data: {
                    order: task_order_ids,

                },
                success: function(response) {
                    toastr.success(response.message);
                    $('#task_sortable li').each(function(index) {
                        $(this).find('.pos_num').text(index + 1);

                    });

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    });

    $(document).on('change','#project_id',function()
    {
        var project_id = $(this).val();
        var ul = $(this).parent().parent().parent().parent();
        var op = "";

        $.ajax({
            type:'get',
            url: "/project/findtasks",
            data:{'id':project_id},
            success:function(data){
                console.log(data);
                for( var i=0; i<data.length;i++)
                {
                op+='<li class="list-group-item-warning" data-id="'+data[i].id+'">'
                op+='<div class="row">'
                op+='<div class="col-md-6"><span>"'+data[i].name+'"</span></div>'
                op+='<div class="col-md-6" align="right"> <i class="fa fa-edit action" title="Edit Task"></i> <i class="fa fa-trash action" title="Delete Task"></i></div>'
                op+='</div>'
                op+='</li>'
                } 
                        ul.find('#task_sortable').html("");
                        ul.find('#task_sortable').append(op);
            },
            error:function(){
                console.log('failed');
            }
            });
    });
});
