
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
                });
            }
        });
    }); 

    //検索処理
    $("#searchForm").on("submit", function(e) {
        e.preventDefault();

        let product_name = $("#searchKeyword").val();
        let company_id = $("#searchCompany").val();
        let min_price = $("#minPrice").val();
        let max_price = $("#maxPrice").val();
        let min_stock = $("#minStock").val();
        let max_stock = $("#maxStock").val();

        // 空の検索条件でもサーバーに送信
        if (product_name.trim() === "" && company_id === "" && min_price === "" && max_price === "" && min_stock === "" && max_stock === "") {
            product_name = "";  // 空文字を送信
            company_id = "";    // 空文字を送信
            min_price = "";     // 空文字を送信
            max_price = "";     // 空文字を送信
            min_stock = "";     // 空文字を送信
            max_stock = "";     // 空文字を送信
        }

        //Ajaxリクエスト処理
        var searchForm = $('#searchForm');  // ここでsearchFormをjQueryオブジェクトとして定義
        $.ajax({
            url: searchForm.attr("action"),
            type: "GET",
            data: {
                product_name: product_name,
                company_id: company_id,
                min_price: min_price,
                max_price: max_price,
                min_stock: min_stock,
                max_stock: max_stock
            },
            dataType: "json",
            success: function(response) {
                console.log("検索成功", response);
                console.log("検索条件:", {product_name, company_id, min_price, max_price, min_stock, max_stock}); // データ確認

                // html があれば商品リストを更新
                if (response.html) {
                    $("#productList").html(response.html);
                }
                // pagination が空でも上書き（空の場合は非表示になる）
                $("#pagination").html(response.pagination || '');
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

        // ソートの初期設定
    let sortColumn = "id";
    let sortDirection = "desc";  // 初期表示はIDの降順

    // ソート可能なカラムを定義
    const sortableColumns = ["id", "price", "stock"];

    // テーブルヘッダーのクリックイベント
    $(document).on("click", ".sortable", function() {
        let column = $(this).data("sort");

        // ソート可能なカラムかどうかを確認
        if (sortableColumns.includes(column)) {
            // 同じカラムがクリックされたら昇順・降順を切り替える
            if (sortColumn === column) {
                sortDirection = (sortDirection === "asc") ? "desc" : "asc";
            } else {
                sortColumn = column;
                sortDirection = "asc";  // 別のカラムをクリックしたら昇順にする
            }

            // Ajaxリクエストを送信
            $.ajax({
                url: "/product",
                type: "GET",
                data: {
                    sort_column: sortColumn,
                    sort_direction: sortDirection
                },
                dataType: "json",
                success: function(response) {
                    console.log("ソート成功", response);
                    if (response.html) {
                        $("#productList").html(response.html);
                    }
                },
                error: function(xhr, status, error) {
                    console.log("ソート失敗", xhr, status, error);
                    Swal.fire({
                        title: 'ソートに失敗しました',
                        text: 'もう一度お試しください。',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });

});
