$(function(){
    $('.hide').hide();
    $('.cfavbtn').on('click', function(){
        // ここに処理を記述
        var creatorName = $(this).val();

        // 以下いいねボタンに関する処理
        $(this).addClass('hide');
        $(this).hide();
        $('.cremove').removeClass('hide');
        $('.cremove').show();

            // 非同期通信する
            // $.ajax() -> リクエストの送信処理
            // .dome() -> レスポンス処理
            // .fail() -> リクエストが正しく処理されない場合の処理
            $.ajax({
                // リクエストするサーバのプログラム
                url:'./ajax_fav.php',
                // 送信方法
                type:'post',
                // 送信データ
                data:{
                    'cfavbtn':creatorName
                }
            })
            //レスポンスで返ってきた結果
            .done((data)=>{
                // レスポンスで受け取ったデータを処理する
                console.log(data);
                const ret = JSON.parse(data); // コンソールログに表示
                $("#creatorfav").children("p").html(ret.message);
            })
            .fail((data)=>{
                // レスポンスを正しく処理されなかった時の処理
                console.log(data);
                // console.log("通信できませんでした"));
                $("#creatorfav").children("p").html("カウントできませんでした。");
            });

        }
    );

    $('.cremove').on('click', function(){
        // ここに処理を記述
        var creatorName = $(this).val();

        // 以下いいねボタンに関する処理
        $(this).addClass('hide');
        $(this).hide();
        $('.cfavbtn').removeClass('hide');
        $('.cfavbtn').show();

            // 非同期通信する
            // $.ajax() -> リクエストの送信処理
            // .dome() -> レスポンス処理
            // .fail() -> リクエストが正しく処理されない場合の処理
            $.ajax({
                // リクエストするサーバのプログラム
                url:'./ajax_fav.php',
                // 送信方法
                type:'post',
                // 送信データ
                data:{
                    'cremove':creatorName
                }
            })
            //レスポンスで返ってきた結果
            .done((data)=>{
                // レスポンスで受け取ったデータを処理する
                console.log(data);
                const ret = JSON.parse(data); // コンソールログに表示
                $("#creatorfav").children("p").html(ret.message);
            })
            .fail((data)=>{
                // レスポンスを正しく処理されなかった時の処理
                console.log(data);
                // console.log("通信できませんでした"));
                $("#creatorfav").children("p").html("カウントできませんでした。");
            });

        }
    );

    $('.pfavbtn').on('click', function(){
        // ここに処理を記述
        var projectName = $(this).val();

        // 以下いいねボタンに関する処理
        $(this).addClass('hide');
        $(this).hide();
        $('.premove').removeClass('hide');
        $('.premove').show();

            // 非同期通信する
            // $.ajax() -> リクエストの送信処理
            // .dome() -> レスポンス処理
            // .fail() -> リクエストが正しく処理されない場合の処理
            $.ajax({
                // リクエストするサーバのプログラム
                url:'./ajax_fav.php',
                // 送信方法
                type:'post',
                // 送信データ
                data:{
                    'pfavbtn':projectName
                }
            })
            //レスポンスで返ってきた結果
            .done((data)=>{
                // レスポンスで受け取ったデータを処理する
                console.log(data);
                const ret = JSON.parse(data); // コンソールログに表示
                $("#projectfav").children("p").html(ret.message);
            })
            .fail((data)=>{
                // レスポンスを正しく処理されなかった時の処理
                console.log(data);
                // console.log("通信できませんでした"));
                $("#projectfav").children("p").html("カウントできませんでした。");
            });

        }
    );

    $('.premove').on('click', function(){
        // ここに処理を記述
        var projectName = $(this).val();

        // 以下いいねボタンに関する処理
        $(this).addClass('hide');
        $(this).hide();
        $('.pfavbtn').removeClass('hide');
        $('.pfavbtn').show();

            // 非同期通信する
            // $.ajax() -> リクエストの送信処理
            // .dome() -> レスポンス処理
            // .fail() -> リクエストが正しく処理されない場合の処理
            $.ajax({
                // リクエストするサーバのプログラム
                url:'./ajax_fav.php',
                // 送信方法
                type:'post',
                // 送信データ
                data:{
                    'premove':projectName
                }
            })
            //レスポンスで返ってきた結果
            .done((data)=>{
                // レスポンスで受け取ったデータを処理する
                console.log(data);
                const ret = JSON.parse(data); // コンソールログに表示
                $("#projectfav").children("p").html(ret.message);
            })
            .fail((data)=>{
                // レスポンスを正しく処理されなかった時の処理
                console.log(data);
                // console.log("通信できませんでした"));
                $("#projectfav").children("p").html("カウントできませんでした。");
            });

        }
    );
});