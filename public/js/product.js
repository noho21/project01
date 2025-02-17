
$(document).ready(function() {
    console.log("JavaScript 読み込み成功");

    //削除処理
    $(document).on("click", ".deleteButton",  function(e) {
        e.preventDefault();
        let form = $(this).closest("form"); // フォームを取得
        console.log('削除ボタンクリック');

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
                $.ajax({
                    url: form.attr("action"),
                    type: "POST",
                    data: form.serialize(),
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        "X-HTTP-Method-Override": "DELETE"  // LaravelのDELETEリクエストとして扱う
                    },
                    success: function(response) {
                        console.log("削除成功", response);
                        Swal.fire({
                            title: '削除しました',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // 削除後にページをリロード
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log("削除失敗", xhr, status, error);
                        Swal.fire({
                            title: '削除に失敗しました',
                            text: 'もう一度お試しください。',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
            }
        });
    }); 

    //検索処理
    $("#searchForm").on("submit", function(e) {
        e.preventDefault();

        let product_name = $("#searchKeyword").val();
        let company_id = $("#searchCompany").val();

        // 空の検索条件でもサーバーに送信
        if (product_name.trim() === "" && company_id === "") {
            product_name = "";  // 空文字を送信
            company_id = "";    // 空文字を送信
        }

        //Ajaxリクエスト処理
        var searchForm = $('#searchForm');  // ここでsearchFormをjQueryオブジェクトとして定義
        $.ajax({
            url: searchForm.attr("action"),
            type: "GET",
            data: {
                product_name: product_name,
                company_id: company_id
            },
            dataType: "json",
            success: function(response) {
                console.log("検索成功", response);
                console.log("検索条件:", {product_name: product_name, company_id: company_id}); // データ確認

                if (response.html && response.pagination) {
                    $("#productList").html(response.html); // 商品リストを更新
                    $("#pagination").html(response.pagination); // ページネーションを更新
                    history.pushState(null, "", url); // URL も更新
                } else {
                    console.error("サーバーのレスポンスが不正です", response);
                }
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
