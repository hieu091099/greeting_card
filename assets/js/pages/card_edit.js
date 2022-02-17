$(document).ready(function() {
    jQuery.fn.outerHTML = function () {
        return jQuery('<div />').append(this.eq(0).clone()).html();
    };

    $('input[type=range]').on('input', function() {
        $(this).trigger('change');
    });
    $("#favcolor").on('input',
        function() {
            var opacity = $("#opacity").val();
            var color = $(this).val()
            var rgbaCol = 'rgba(' + parseInt(color.slice(-6, -4), 16) + ',' + parseInt(color.slice(-4, -2), 16) + ',' + parseInt(color.slice(-2), 16) + ',' + opacity + ')';
            $("#text").css("background-color", rgbaCol);
        }
    );
    $("#opacity").change(() => {
        var opacity = $("#opacity").val();
        var color = $("#favcolor").val()
        var rgbaCol = 'rgba(' + parseInt(color.slice(-6, -4), 16) + ',' + parseInt(color.slice(-4, -2), 16) + ',' + parseInt(color.slice(-2), 16) + ',' + opacity + ')';
        $("#text").css("background-color", rgbaCol);
    });
    $("#cd").change(() => {
        $("#text").css("width", $("#cd").val() + 'px');
    });
    $("#cr").change(() => {
        $("#text").css("height", $("#cr").val() + 'px');
    });


    $("#luu").click(()=>{
        // console.log($("#text").outerHTML());
        // console.log($('#mailsubj').val());
        // console.log($('#year').val());
        // console.log($('#version').val());
        console.log(tinymce.get("textarea").getContent()+"</div>");
        $('#rv').html($("#text").outerHTML());
        $('#rv #text').html('');
         let data={
                year:$('#year').val(),
                version:$('#version').val(),
                mailsj:$('#mailsubj').val(),
                content:tinymce.get("textarea").getContent()+"</div>",
                box:$('#rv').html().replace('</div>','')
            };
                $.ajax({
                url: 'data/main.php?action=addcontent',
                data:data,
                type: 'POST',
                success: (res) => {
                    response = JSON.parse(res);
                    console.log(response);
                    if (response.status == true) {
                        toastr.success(response.msg, 'Info', {
                            timeOut: 800, onHidden: function () {
                                window.location.href ='../modules/card_setting.php';
                            }
                        })
                    } else {
                        toastr.error(response.msg, 'Info')
                    }
                }
            })
            });
            $("#sua").click(()=>{
                // console.log($("#text").outerHTML());
                // console.log($('#mailsubj').val());
                // console.log($('#year').val());
                // console.log($('#version').val());
                console.log(tinymce.get("textarea").getContent()+"</div>");
                $('#rv').html($("#text").outerHTML());
                $('#rv #text').html('');
                 let data={
                        id:$("#sua").attr('idcont'),
                        year:$('#year').val(),
                        version:$('#version').val(),
                        mailsj:$('#mailsubj').val(),
                        content:tinymce.get("textarea").getContent()+"</div>",
                        box:$('#rv').html().replace('</div>','')
                    };
                        $.ajax({
                        url: 'data/main.php?action=editcontent',
                        data:data,
                        type: 'POST',
                        success: (res) => {
                            response = JSON.parse(res);
                            console.log(response);
                            if (response.status == true) {
                                toastr.success(response.msg, 'Info', {
                                    timeOut: 800, onHidden: function () {
                                        window.location.href ='./modules/card_setting.php';
                                    }
                                })
                            } else {
                                toastr.error(response.msg, 'Info')
                            }
                        }
                    })
                    });

                    $('#year').change(()=>{
                        $.ajax({
                            url: 'data/main.php?action=getImageDefault',
                            data:{year:$('#year').val()},
                            type: 'POST',
                            success: (res) => {
                                res= JSON.parse(res)[0];
                                $('#card').css('background-image',`url('./uploads/${res.image}')`)
                                
                            }
                        })
                    });
});