
$(document).ready(() => {

    $("#register").on('click', (e) => {
        e.preventDefault();
        $.ajax({
            url: 'data/main.php?action=register',
            data: $('#register_form').serialize(),
            type: 'POST',
            success: (res) => {
                console.log(JSON.parse(res))
            }
        })
    })
    $("#login_form").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            username: {
                required: true,
                maxlength: 15
            },
            password: {
                required: true,
                minlength: 3
            },

        },
        messages: {
            username: {
                required: "(*) Vui lòng nhập username!",
                maxlength: "(*) Nhập tối đa 15 ký tự!"
            },
            password: {
                required: "(*) Vui lòng nhập password!",
                minlength: "(*) Nhập ít nhất 3 ký tự!"
            },
        },
        submitHandler: function () {
            $.ajax({
                url: 'data/main.php?action=login',
                data: $('#login_form').serialize(),
                type: 'POST',
                success: (res) => {
                    response = JSON.parse(res);
                    console.log(response);
                    if (response.status == true) {
                        window.location.href = 'index.php';
                    }
                }
            })
        }
    });


})

function chooseLanguage(lang) {
    let path = window.location.pathname;
    let urlParam = new URLSearchParams(window.location.search);
    urlParam.set('lang', lang);
    if (path.indexOf('?') > 0) {
        window.location.href = path + '&' + urlParam.toString();
    } else {
        window.location.href = path + '?' + urlParam.toString();
    }
    // $.get("http://localhost:8088/GreetingCard/index.php?lang=" + lang, () => window.location.reload());
}
