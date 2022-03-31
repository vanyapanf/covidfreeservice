function getMessages($) {
    $.ajax({
        url: '/report_discussion/{report_id}',
        type: 'GET',
        data: {},
        dataType: 'JSON',
        success: function (data) {
            $(".writeinfo").append(data.msg);
        }
    });
}
