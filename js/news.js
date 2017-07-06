/**********************
 * Index
 **********************/

var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;
var alertTimeOut = 3000;

$('document').ready(function() {
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
        success: function(res) {
            console.log("log_page" + res);

            total_page = res.last_page;
            current_page = res.current_page;

            $('#pagination').twbsPagination({
                totalPages: total_page,
                visiblePages: current_page,
                onPageClick: function(event, pageL) {
                    page = pageL;
                    if (is_ajax_fire != 0) {
                        getPageData();
                    }
                }
            });

            manageRow(res.data);
            is_ajax_fire = 1;
        },
        error: function(res) {}

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
    }).done(function(res) {
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
    $.each(data, function(key, value) {
        rows = rows + '<tr>';
        rows = rows + '<td class="text-center">' + i + '</td>';
        rows = rows + '<td><b>' + value.title + '</td>'; //+ '</b><br>ผู้เขียน : ' + value.username +
        rows = rows + '<td class="text-center">' + value.created_at + '</td>';
        rows = rows + '<td data-id="' + value.news_id + '"><button data-toggle="modal" data-target="#modalView" type="button" rel="tooltip" title="ดูรายละเอียด"' +
            'class="btn btn-info btn-simple btn-xs btn-delete-dialog" id="btnCreate"><i class="fa fa-info"></i></button></td>';
        rows = rows + '<td data-id="' + value.news_id + '"><button data-toggle="modal" data-target="#modalEdit" type="button" rel="tooltip" title="แก้ไข"' +
            'class="btn btn-warning btn-simple btn-xs btn-delete-dialog" id="btnEdit"><i class="fa fa-edit"></i></button></td>';
        rows = rows + '<td data-id="' + value.news_id + '"><button data-toggle="modal" data-target="#modelDelete" type="button" rel="tooltip" title="ลบ"' +
            'class="btn btn-danger btn-simple btn-xs btn-delete-dialog" id="btnDelete"><i class="fa fa-times"></i></button></td>';
        rows = rows + '</tr>';
        ++i;
    });

    $("tbody").html(rows);
}

/**********************
 * Create
 **********************/
$("#btnConfirmCreate").click(function(e) {

    var action = "#modelCreate";

    var form_action = $(action).attr("action");
    var title = $(action).find("input[name='title']").val();
    var content = $(action).find("textarea[name='content']").val();

    console.log(title);
    console.log(content);

    $.ajax({
        cache: false,
        type: "POST",
        timeout: 5000,
        url: BASE_URL + "controllers/news/cmd.php",
        data: {
            "cmd": "create",
            "title": title,
            "content": content
        },
        success: function(res) {
            console.log(res);
            getPageData();
            $(".modal").modal('hide');
            toastr.remove();
            toastr.success('Item Created Successfully.', 'Success Alert', { timeOut: alertTimeOut });
        },
        error: function() {
            toastr.remove();
            toastr.error('I do not think that word means what you think it means.', 'Inconceivable!', { timeOut: alertTimeOut });
        }
    });
});

/**********************
 * Edit
 **********************/
$("#dt_basic").on("click", "#btnEdit", function(e) {

    var news_id = $(this).parents('td').attr('data-id');
    var action = "#modalEdit";

    console.log(news_id);

    $.ajax({
        cache: false,
        type: "POST",
        timeout: 5000,
        url: BASE_URL + "controllers/news/cmd.php?" + news_id,
        data: {
            "cmd": "show",
            "news_id": news_id
        },
        success: function(res) {
            console.log(res.data);
            var data = res.data;
            var form_action = $(action).attr("action");

            var news_id = $(action).find("input[name='news_id']").val(data.news_id);
            var title = $(action).find("input[name='title']").val(data.title);
            var content = $(action).find("textarea[name='content']").val(data.content);
        }
    });
});

$("#btnConfirmUpdate").click(function(e) {
    var action = "#modalEdit";

    var form_action = $(action).attr("action");

    var news_id = $(action).find("input[name='news_id']").val();
    var title = $(action).find("input[name='title']").val();
    var content = $(action).find("textarea[name='content']").val();

    console.log(news_id);
    console.log(title);
    console.log(content);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    $.ajax({
        cache: false,
        type: "POST",
        timeout: 5000,
        url: BASE_URL + "controllers/news/cmd.php?" + news_id,
        data: {
            "cmd": "update",
            "news_id": news_id,
            "title": title,
            "content": content
        },
        success: function(res) {
            console.log(res);
            getPageData();
            $(".modal").modal('hide');
            toastr.remove();
            toastr.success('Item Created Successfully.', 'Success Alert', { timeOut: alertTimeOut });
        },
        error: function() {
            toastr.remove();
            toastr.error('I do not think that word means what you think it means.', 'Inconceivable!', { timeOut: alertTimeOut });
        }
    });

});

/**********************
 * Delete
 **********************/
$("#dt_basic").on("click", "#btnDelete", function(e) {

    var news_id = $(this).parents('td').attr('data-id');
    var c_obj = $(this).parents("tr");

    console.log(news_id);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    $("body").on("click", "#btnConfirmDelete", function(e) {
        $.ajax({
            cache: false,
            type: "POST",
            timeout: 5000,
            url: BASE_URL + "controllers/news/cmd.php?" + news_id,
            data: {
                "cmd": "delete",
                "news_id": news_id
            },
            success: function(data) {
                console.log(data);
                c_obj.remove();
                $(".modal").modal('hide');
                toastr.remove();
                toastr.success('Item Created Successfully.', 'Success Alert', { timeOut: alertTimeOut });
                getPageData();
            }
        });
    });
});