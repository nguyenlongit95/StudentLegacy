
$(document).ready(function () {
    $("#qty").change(function () {
        var QTY = $(this).val();
        alert("Bạn muốn thay đổi giá trị số lượng sản phẩm");
        /*
        * Gửi ajax tại đây
        * sử dụng phương thức POST để gửi Ajax
        * */
        // $.ajax({
        //     type: "POST",
        //     url: 'http://localhost/BaseApp/public/admin/Order/updateOrder/' + id,
        //     data: {
        //         Quantity: QTY
        //     },
        //     success: function (result) {
        //         alert(result);
        //     }
        // });
    });
});
