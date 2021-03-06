<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>MagicCardMarket 2.0</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

        <!-- Styles -->
        <style>
            body {
                font-family: 'Varela Round', sans-serif;
            }
            .form-control {
                box-shadow: none;		
                font-weight: normal;
                font-size: 16px;
            }
            .navbar {
                background: #fff;
                padding-left: 16px;
                padding-right: 16px;
                border-bottom: 1px solid #dfe3e8;
                border-radius: 0;
            }
            .nav-link img {
                border-radius: 50%;
                width: 36px;
                height: 36px;
                margin: -8px 0;
                float: left;
                margin-right: 10px;
            }
            .navbar .navbar-brand {
                padding-left: 0;
                font-size: 30px;
                padding-right: 50px;
            }
            .navbar .navbar-brand b {
                padding-left: 4px;
                color: #3338ca;		
            }
            .navbar .form-inline {
                display: inline-block;
            }
            .navbar a {
                color: #888;
                font-size: 20px;
            }
            .search-box {
                position: relative;
            }	
            .search-box input {
                padding-right: 35px;
                border-color: #dfe3e8;
                border-radius: 4px !important;
                box-shadow: none
            }
            .search-box .input-group-text {
                min-width: 35px;
                border: none;
                background: transparent;
                position: absolute;
                right: 0;
                z-index: 9;
                padding: 7px;
                height: 100%;
            }
            .search-box i {
                color: #a0a5b1;
                font-size: 19px;
            }
            .navbar .sign-up-btn {
                min-width: 110px;
                max-height: 36px;
            }
            .navbar .dropdown-menu {
                color: #999;
                font-weight: normal;
                border-radius: 1px;
                border-color: #e5e5e5;
                box-shadow: 0 2px 8px rgba(0,0,0,.05);
            }
            .navbar a, .navbar a:active {
                color: #888;
                padding: 8px 20px;
                background: transparent;
                line-height: normal;
            }
            .navbar .navbar-form {
                border: none;
            }
            .navbar .action-form {
                width: 280px;
                padding: 20px;
                left: auto;
                right: 0;
                font-size: 14px;
            }
            .navbar .action-form a {		
                color: #33cabb;
                padding: 0 !important;
                font-size: 14px;
            }
            .navbar .action-form .hint-text {
                text-align: center;
                margin-bottom: 15px;
                font-size: 13px;
            }
            .navbar .btn-primary, .navbar .btn-primary:active {
                color: #fff;
                background: #33cabb !important;
                border: none;
            }	
            .navbar .btn-primary:hover, .navbar .btn-primary:focus {		
                color: #fff;
                background: #31bfb1 !important;
            }
            .navbar .social-btn .btn, .navbar .social-btn .btn:hover {
                color: #fff;
                margin: 0;
                padding: 0 !important;
                font-size: 13px;
                border: none;
                transition: all 0.4s;
                text-align: center;
                line-height: 34px;
                width: 47%;
                text-decoration: none;
            }
            .navbar .social-btn .facebook-btn {
                background: #507cc0;
            }
            .navbar .social-btn .facebook-btn:hover {
                background: #4676bd;
            }
            .navbar .social-btn .twitter-btn {
                background: #64ccf1;
            }
            .navbar .social-btn .twitter-btn:hover {
                background: #4ec7ef;
            }
            .navbar .social-btn .btn i {
                margin-right: 5px;
                font-size: 16px;
                position: relative;
                top: 2px;
            }
            .or-seperator {
                margin-top: 32px;
                text-align: center;
                border-top: 1px solid #e0e0e0;
            }
            .or-seperator b {
                color: #666;
                padding: 0 8px;
                width: 30px;
                height: 30px;
                font-size: 13px;
                text-align: center;
                line-height: 26px;
                background: #fff;
                display: inline-block;
                border: 1px solid #e0e0e0;
                border-radius: 50%;
                position: relative;
                top: -15px;
                z-index: 1;
            }
            .navbar .action-buttons .dropdown-toggle::after {
                display: none;
            }
            .form-check-label input {
                position: relative;
                top: 1px;
            }
            @media (min-width: 1200px){
                .form-inline .input-group {
                    width: 300px;
                    margin-left: 30px;
                }
            }
            @media (max-width: 768px){
                .navbar .dropdown-menu.action-form {
                    width: 100%;
                    padding: 10px 15px;
                    background: transparent;
                    border: none;
                }
                .navbar .form-inline {
                    display: block;
                }
                .navbar .input-group {
                    width: 100%;
                }
            }
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body>
        <header id="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a href="#" class="navbar-brand">MagicCard<b>Market</b></a>  		
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Collection of nav links, forms, and other content for toggling -->
                <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
                    <form class="navbar-form form-inline" id="searchForm" action="http://localhost/laravel/MagicCardMarket/public/api/cards/searchCard" method="post">
                        <div class="input-group search-box">								
                            <input type="text" id="search" class="form-control" placeholder="All Cards" name="name">
                            @if(!empty($user))
                            <input type="hidden" name="user" value="{!! $user->name !!}">
                            @endif
                            <div class="input-group-append">
                                    <input type="submit" class="btn btn-primary btn-block" value="Search">
                            </div>
                        </div>
                    </form>
                    <form class="navbar-form form-inline" action="http://localhost/laravel/MagicCardMarket/public/api/forSaleCards/searchForSaleCard" method="post">
                        <div class="input-group search-box">								
                            <input type="text" id="search" class="form-control" placeholder="Cards for Sale" name="name">
                            @if(!empty($user))
                            <input type="hidden" name="user" value="{!! $user->name !!}">
                            @endif
                            <div class="input-group-append">
                                    <input type="submit" class="btn btn-primary btn-block" value="Search">
                            </div>
                        </div>
                    </form>
                    <div class="navbar-nav ml-auto action-buttons">
                        @if(empty($user))
                        <div class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle mr-4">Login</a>
                            <div class="dropdown-menu action-form">
                                <form action="http://localhost/laravel/MagicCardMarket/public/api/users/login" method="post">
                                    @CSRF
                                    <p class="hint-text">Sign in with your account</p>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Username" name="name" id="name" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required="required">
                                    </div>                                   
                                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                                    <div class="text-center mt-2">
                                        <a href="#">Forgot Your password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle sign-up-btn">Sign up</a>
                            <div class="dropdown-menu action-form">
                                <form action="http://localhost/laravel/MagicCardMarket/public/api/users/new" method="post">
                                    <p class="hint-text">Fill in this form to create your account!</p>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Username" name="name" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email" name="email" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="check_password" required="required">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control form-control-lg" aria-label=".form-select-lg example" name="status" id="status">
                                            <option selected>Type of User</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Casual">Casual</option>
                                            <option value="Professional">Professional</option>
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-block" value="Sign up">
                                </form>
                            </div>
                        </div>
                        @elseif ($user->status == "Admin")
                        <div class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle mr-4">Create Card</a>
                            <div class="dropdown-menu action-form">
                                <form action="http://localhost/laravel/MagicCardMarket/public/api/cards/newCard" method="post">
                                    @CSRF
                                    <p class="hint-text">Create Card</p>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Username" name="username" id="username" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Card Name" name="cardname" id="cardname" required="required">
                                    </div>   
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Description" name="description" id="description" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Collection_ID Ej: '[2,3,4]'" name="collection_id" id="collection_id" required="required">
                                    </div>                                 
                                    <input type="submit" class="btn btn-primary btn-block" value="Create Card">
                                </form>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle sign-up-btn">Create Collection</a>
                            <div class="dropdown-menu action-form">
                                <form action="http://localhost/laravel/MagicCardMarket/public/api/collections/newCollection" method="post">
                                    <p class="hint-text">Create Collection</p>
                                    <div class="form-group">
                                        <input type="file" class="form-control" placeholder="Symbol" name="symbol" id="symbol"  required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Collection Name" name="collection_name" id="collection_name" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="date" class="form-control" placeholder="Edition Date" name="edition_date" id="edition_date" required="required">
                                    </div>
                                    @if(!empty($user))
                                    <input type="hidden" name="user" value="{!! $user->name !!}">
                                    @endif
                                    <input type="submit" class="btn btn-primary btn-block" value="Create Collection">
                                </form>
                            </div>
                        </div>
                        @else
                        <div class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle sign-up-btn">Put Card For Sale</a>
                            <div class="dropdown-menu action-form">
                                <form action="http://localhost/laravel/MagicCardMarket/public/api/forSaleCards/newForSaleCard" method="post">
                                    @CSRF
                                    <p class="hint-text">Fill in this form to put cards for sale!</p>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Username" name="username" id="username" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Card ID" name="card_id" id="card_id" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Prize" name="prize" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Stock" name="stock" required="required">
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-block" value="Put for Sale">
                                </form>
                            </div>
                        </div>
                        <!--<a>{!! var_dump($user->api_token) !!}</a>-->

                        @endif
                    </div>
                </div>
            </nav>
        </header>
        <div>
                <table class="table table-success table-striped">
                    <thead>
                    @if(empty($results))
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Collection</th>
                        </tr>
                    @else
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Seller_Name</th>
                            <th>Seller_Type</th>
                        </tr>
                    @endif
                    </thead>
                    <tbody>
                    @if(!empty($results))
                        @foreach($results as $result)
                            <tr>
                                <td>{!! $result["card_id"] !!}</td>
                                <td>{!! $result["card_name"] !!}</td>
                                <td>{!! $result["price"] !!}</td>
                                <td>{!! $result["stock"] !!}</td>
                                <td>{!! $result["user_name"] !!}</td>
                                <td>{!! $result["user_type"] !!}</td>
                            </tr>
                        @endforeach
                    @elseif(!empty($cards))
                        @foreach($cards as $card)
                            <tr>
                                <td>{!! $card->id !!}</td>
                                <td>{!! $card->name !!}</td>
                                <td>{!! $card->description !!}</td>
                                <td>{!! @var_export(implode(",",$card->collection_id)) !!}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
        </div>
    </body>
</html>
