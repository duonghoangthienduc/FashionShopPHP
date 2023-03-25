<div class="container-fluid">
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="/" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Fashion</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="{{ route('Search Shop') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products" name='product_find'>
                    <div class="input-group-append">
                        {{-- <span class="input-group-text bg-transparent text-primary"> --}}
                        <button type="submit" class="input-group-text bg-transparent text-primary"><i
                                class="fa fa-search"></i></button>
                        {{-- </span> --}}
                    </div>
                </div>
                @csrf
            </form>
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">Customer Service</p>
            <h5 class="m-0">0966908907</h5>
        </div>
    </div>
</div>
