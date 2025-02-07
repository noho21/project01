
$(document).ready(function() {
    console.log("JavaScript 読み込み成功");

    //削除処理
    $("#deleteButton").on("click", function() {
        let DeleteForm = $(this).closest("form");
        Swal.fire({
            title: '削除しますか？',
            text: 'この操作は取り消せません',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '削除'
        }).then((result) => {
            if (result.isConfirmed) {
                DeleteForm.submit();
            }
        });
    });
});