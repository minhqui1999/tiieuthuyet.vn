<!DOCTYPE html>
<html>
    <head>
        <title>404 - Trang Không Tồn Tại</title>
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-192250782-1"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-192250782-1');
            </script>

            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-D9D7J5E3QJ"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-D9D7J5E3QJ');
            </script>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Không Tìm Thấy Trang</div>
                <div style="line-height: 40px;">
                    <a class="btn btn-primary" role="button" href="https://tieuthuyet.vn/">Về Trang Chủ</a><br />
                    <a class="btn btn-info" role="button" href="https://tieuthuyet.vn/danh-sach/truyen-hot">Xem Danh Sách Truyện HOT</a><br />
                    <a class="btn btn-info" role="button" href="https://tieuthuyet.vn/danh-sach/truyen-full">Xem Danh Sách Truyện FULL</a><br />
                    <button type="button" class="btn btn-success" onclick="goBack()">Quay lại</button>
                </div>
                <script>
                    function goBack() {
                        window.history.back();
                    }
                </script>
            </div>
        </div>
    </body>
</html>
