<div class="container-fluid bg-dark sticky-top">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">
                    {!! $menu_category !!}
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="/" class="text-decoration-none d-block d-lg-none">
                    <span class="h2 text-uppercase text-dark bg-light px-2">Fashion</span>
                    <span class="h2 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="/" class="nav-item nav-link " id="home">Home</a>
                        <div class="d-xl-none d-sm-block d-md-block d-lg-block d-xl-none">
                            @include('public.navbarView.dropDownMenu')
                        </div>
                        <a href="{{ route('Contact') }}" class="nav-item nav-link" id="contact">Contact</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="{{ route('Love List') }}" class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            @if (session()->has('love_cart'))
                                <span
                                    class=" badge 
                                            text-secondary 
                                            border 
                                            border-secondary 
                                            rounded-circle"
                                    style="padding-bottom: 2px;">
                                    {{ count(session()->get('love_cart')) }}
                                </span>
                            @else
                                <span
                                    class=" badge 
                                            text-secondary 
                                            border 
                                            border-secondary 
                                            rounded-circle"
                                    style="padding-bottom: 2px;">
                                    0
                                </span>
                            @endif

                        </a>
                        <a href="{{ route('Shoping Cart') }}" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            @if (session()->has('cart'))
                                <span
                                    class=" badge 
                                            text-secondary 
                                            border 
                                            border-secondary 
                                            rounded-circle"
                                    style="padding-bottom: 2px;">
                                    {{ count(session()->get('cart')) }}
                                </span>
                            @else
                                <span
                                    class=" badge 
                                            text-secondary 
                                            border 
                                            border-secondary 
                                            rounded-circle"
                                    style="padding-bottom: 2px;">
                                    0
                                </span>
                            @endif
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
