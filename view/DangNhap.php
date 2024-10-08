<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="/view/css/DangNhap.css">
</head>
<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <form action="index.php?action=DangNhap" method="POST" class="sign-in-form">
                        <div class="logo">
                            <img src="/view/img/utt_banner.png" alt="utt_logo"/>
                        </div>

                        <div class="heading">
                            <h2>Đăng nhập</h2>
                            <h6>Hệ thống quản lý điểm</h6>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" name="username" class="input-field" autocomplete="off" required />
                                <label>Tên đăng nhập</label>
                            </div>
                            <div class="input-wrap">
                                <input type="password" name="password" class="input-field" autocomplete="off" required />
                                <label>Mật khẩu</label>
                                <?php if(isset($error)): ?>
                                    <p class="error"><?php echo $error; ?></p>
                                <?php endif; ?>
                            </div>
                            <input type="submit" value="Xác nhận" class="sign-btn">
                            <p class="text">
                                Quên mật khẩu?
                                <a href="#" class="toggle">Hỗ trợ</a>
                            </p>
                        </div>
                    </form>
                    
                    <form action="index.php?action=QuenMatKhau" method="POST" class="sign-up-form">
                        <div class="logo">
                            <img src="/view/img/utt_banner.png" alt="utt_logo"/>
                        </div>

                        <div class="heading">
                            <h2>Hỗ trợ</h2>
                            <h6>Quên mật khẩu</h6>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" class="input-field" autocomplete="off" required />
                                <label>Tên đăng nhập</label>
                            </div>
                            <div class="input-wrap">
                                <input type="email" class="input-field" autocomplete="off" required />
                                <label>Email đăng ký</label>
                            </div>
                            <input type="submit" value="Đăng nhập" class="sign-btn">
                            <p class="text">
                                Trở lại
                                <a href="#" class="toggle">Đăng nhập</a>
                            </p>
                        </div>
                    </form>
                </div>

                <div class="carousel">
                    <div class="images-wrapper">
                        <img src="/view/img/image1.png" class="image img-1 show" alt="" />
                        <img src="/view/img/image2.png" class="image img-2 show" alt="" />
                        <img src="/view/img/image3.png" class="image img-3 show" alt="" />
                    </div>
                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>University of transport technology</h2>
                                <h2>Đại học Công nghệ Giao thông vận tải</h2>
                                <h2>GuenBanKhai</h2>
                            </div>
                        </div>
                        <div class="bullets">
                            <span class="active" data-value="1"></span>
                            <span data-value="2"></span>
                            <span data-value="3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script src="/view/js/DangNhap.js"></script>
</body>
</html>
