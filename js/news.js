/**********************
 * Index
 **********************/
var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;
var alertTimeOut = 3000;


var js_session_status = session_status;
var js_session_id = session_id;

$('document').ready(function () {
    console.log('ready !!!!! overview');
    manageData();

});

/**********************
 * manage data list
 **********************/
function manageData() {

    $.ajax({
        cache: false,
        type: "POST",
        timeout: 5000,
        dataType: 'json',
        url: BASE_URL + "controllers/news/cmd.php",
        data: {
            "cmd": "index",
            page: page
        },
        success: function (res) {
            console.log(res);

            total_page = res.last_page;
            current_page = res.current_page;

            $('#pagination').twbsPagination({
                totalPages: total_page,
                visiblePages: current_page,
                onPageClick: function (event, pageL) {
                    page = pageL;
                    if (is_ajax_fire != 0) {
                        getPageData();
                    }
                }
            });

            manageRow(res.data);
            is_ajax_fire = 1;
        },
        error: function (res) {
        }

    });
}

/**********************
 * Get Page Data
 **********************/

function getPageData() {
    $.ajax({
        cache: false,
        type: "POST",
        timeout: 5000,
        dataType: 'json',
        url: BASE_URL + "controllers/news/cmd.php",
        data: {
            "cmd": "index",
            page: page
        }
    }).done(function (res) {
        console.log(res.data);
        manageRow(res.data);
    });
}

/**********************
 * Add new Item table row
 **********************/

function manageRow(data) {

    var rows = '';
    var i = 1;
    $.each(data, function (key, value) {
        // console.log(js_session_id);
        rows = rows + '<tr>';
        rows = rows + '<td class="text-center">' + i + '</td>';
        rows = rows + '<td><b>' + value.title + '</b></td>';
        rows = rows + '<td>' + value.username + '</td>';
        rows = rows + '<td class="text-center">' + value.created_at + '</td>';
        if (js_session_status == "admin" || (js_session_status == "member" && js_session_id == value.user_id)) {
            // admin only
            rows = rows + '<td data-id="' + value.news_id + '" class="text-center"><button data-toggle="modal" data-target="#modalView" type="button" rel="tooltip" title="ดูรายละเอียด"' +
                'class="btn btn-info btn-simple btn-xs btn-delete-dialog" id="btnView"><i class="fa fa-info"></i></button></td>';
            rows = rows + '<td data-id="' + value.news_id + '" class="text-center"><button data-toggle="modal" data-target="#modalUpdate" type="button" rel="tooltip" title="แก้ไข"' +
                'class="btn btn-warning btn-simple btn-xs btn-delete-dialog" id="btnUpdate"><i class="fa fa-edit"></i></button></td>';
            rows = rows + '<td data-id="' + value.news_id + '" class="text-center"><button data-toggle="modal" data-target="#modelDelete" type="button" rel="tooltip" title="ลบ"' +
                'class="btn btn-danger btn-simple btn-xs btn-delete-dialog" id="btnDelete"><i class="fa fa-times"></i></button></td>';
        } else if (js_session_status == "member") {
            rows = rows + '<td colspan="3" data-id="' + value.news_id + '" class="text-center"><button data-toggle="modal" data-target="#modalView" type="button" rel="tooltip" title="ดูรายละเอียด"' +
                'class="btn btn-info btn-simple btn-xs btn-delete-dialog" id="btnView"><i class="fa fa-info"></i></button></td>';
        } else {
            rows = rows + '<td data-id="' + value.news_id + '" class="text-center"><button data-toggle="modal" data-target="#modalView" type="button" rel="tooltip" title="ดูรายละเอียด"' +
                'class="btn btn-info btn-simple btn-xs btn-delete-dialog" id="btnView"><i class="fa fa-info"></i></button></td>';
        }

        rows = rows + '</tr>';
        ++i;
    });

    $("tbody").html(rows);
}

$(function () {

    /**********************
     * Create
     **********************/
    $("#formCreate").validate({
        rules: {
            title: {
                required: true
            },
            content: {
                required: true
            },
            action: "required"
        },
        messages: {
            title: {
                required: "Please enter your title",
            },
            content: {
                required: "Please enter your content",
            },
            action: "Please provide some data"
        },
        submitHandler: function (form) {
            $.ajax({
                cache: false,
                type: "POST",
                dataType: 'json',
                timeout: 5000,
                url: BASE_URL + "controllers/news/cmd.php",
                data: {
                    "cmd": "create",
                    "title": $(form).find("input[name='title']").val(),
                    "content": $(form).find("textarea[name='content']").val(),
                },
                success: function (res) {
                    console.log(res);
                    getPageData();
                    $(".modal").modal('hide');
                    toastr.remove();
                    toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: alertTimeOut});
                },
                error: function () {
                    toastr.remove();
                    toastr.error('I do not think that word means what you think it means.', 'Inconceivable!', {timeOut: alertTimeOut});
                }
            });
        }
    });

    /**********************
     * Show Update
     **********************/
    $("#dt_basic").on("click", "#btnUpdate", function (e) {

        var action = "#modalUpdate";
        var news_id = $(this).parents('td').attr('data-id');

        // console.log(news_id);

        $.ajax({
            cache: false,
            type: "POST",
            dataType: 'json',
            timeout: 5000,
            url: BASE_URL + "controllers/news/cmd.php?" + news_id,
            data: {
                "cmd": "show",
                "news_id": news_id
            },
            success: function (res) {
                var news_id = $(action).find("input[name='news_id']").val(res.data.news_id);
                var title = $(action).find("input[name='title']").val(res.data.title);
                var content = $(action).find("textarea[name='content']").val(res.data.content);
            },
            error: function () {
                toastr.remove();
                toastr.error('I do not think that word means what you think it means.', 'Inconceivable!', {timeOut: alertTimeOut});
            }
        });
    });

    /**********************
     * Update
     **********************/
    $("#formUpdate").validate({
        rules: {
            title: {
                required: true
            },
            content: {
                required: true
            },
            action: "required"
        },
        messages: {
            title: {
                required: "Please enter your title",
            },
            content: {
                required: "Please enter your content",
            },
            action: "Please provide some data"
        },
        submitHandler: function (form) {
            $.ajax({
                cache: false,
                type: "POST",
                dataType: 'json',
                timeout: 5000,
                url: BASE_URL + "controllers/news/cmd.php?" + $(form).find("input[name='news_id']").val(),
                data: {
                    "cmd": "update",
                    "news_id": $(form).find("input[name='news_id']").val(),
                    "title": $(form).find("input[name='title']").val(),
                    "content": $(form).find("textarea[name='content']").val(),
                },
                success: function (res) {
                    console.log(res);
                    getPageData();
                    $(".modal").modal('hide');
                    toastr.remove();
                    toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: alertTimeOut});
                },
                error: function () {
                    toastr.remove();
                    toastr.error('I do not think that word means what you think it means.', 'Inconceivable!', {timeOut: alertTimeOut});
                }
            });
        }
    });

    /**********************
     * Delete
     **********************/
    $("#dt_basic").on("click", "#btnDelete", function (e) {

        var news_id = $(this).parents('td').attr('data-id');
        var c_obj = $(this).parents("tr");

        console.log(news_id);

        $("#btnConfirmDelete").click(function () {
            $.ajax({
                cache: false,
                type: "POST",
                dataType: 'json',
                timeout: 5000,
                url: BASE_URL + "controllers/news/cmd.php?" + news_id,
                data: {
                    "cmd": "delete",
                    "news_id": news_id
                },
                success: function (res) {
                    console.log(res);
                    c_obj.remove();
                    $(".modal").modal('hide');
                    toastr.remove();
                    toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: alertTimeOut});
                    getPageData();
                },
                error: function () {
                    toastr.remove();
                    toastr.error('I do not think that word means what you think it means.', 'Inconceivable!', {timeOut: alertTimeOut});
                }
            });
        });
    });

    /**********************
     * View
     **********************/
    $("#dt_basic").on("click", "#btnView", function (e) {

        var action = "#modalView";
        var news_id = $(this).parents('td').attr('data-id');

        console.log(news_id);

        $.ajax({
            cache: false,
            type: "POST",
            dataType: 'json',
            timeout: 5000,
            url: BASE_URL + "controllers/news/cmd.php?" + news_id,
            data: {
                "cmd": "show",
                "news_id": news_id
            },
            success: function (res) {
                $("p#title").text(res.data.title);
                $("p#content").text(res.data.content);
            },
            error: function () {
                toastr.remove();
                toastr.error('I do not think that word means what you think it means.', 'Inconceivable!', {timeOut: alertTimeOut});
            }
        });
    });

});