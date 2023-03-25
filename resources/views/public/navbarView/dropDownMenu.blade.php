<div class="nav-item dropdown ">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages &nbsp;<i
            class="fa fa-angle-down mt-1"></i></a>
    <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
        {{-- @forelse ($menus as $menu)
            <a href="cart.html" class="dropdown-item">{{ $menu->name_category }}</a>
        @empty
        @endforelse --}}
        {{-- {!! $menu_dropdown !!} --}}
        {!! $menu_dropdown !!}
    </div>
</div>
