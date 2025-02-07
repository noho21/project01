
$(document).ready(function() {
    console.log("JavaScript 読み込み成功");

    //エスケープ処理
    function escapeHtml(str) {
        return str.replace(/[&<>"']/g, function (match) {
            const escape = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
            };
            return escape[match];
        });
    }


    //削除処理
    $(".deleteButton").on("click", function(e) {
        console.log('削除ボタンクリック');
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

    

    //検索処理
    $("#searchForm").on("submit", function(e) {
        e.preventDefault();

        let keyword = $("#searchKeyword").val();
        let company = $("#searchCompany").val();

        if (keyword.trim() === "" && company === "") {
            alert("検索キーワードまたはメーカーを入力してください");
            return;
        }

        //Ajaxリクエスト処理
        $.ajax({
            url: "{{ route('product.index') }}",
            type: "GET",
            data: {
                keyword: keyword,
                company: company
            },
            dataType: "json",
            success: function(response) {
                console.log(response)
                $("#product-list").html($(response).find("#product-list").html()); // 更新
                $("#pagination").html($(response).find("#pagination").html()); // ページネーション更新
            },
            error: function(xhr, status, error) {
                console.log("検索失敗", xhr, status, error);
                Swal.fire({
                    title: '検索に失敗しました',
                    text: 'もう一度お試しください。',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
