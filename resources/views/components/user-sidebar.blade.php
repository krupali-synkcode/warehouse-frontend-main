<div class="offcanvas-lg offcanvas-start h-100 user-account" tabindex="-1" id="offcanvasSidebar">
    <div class="offcanvas-body p-0">
        <div class="card border p-3 w-100">
            <div class="card-body p-0 ">
                <!-- Sidebar menu item START -->
                <ul class="nav nav-pills-primary-border-start flex-column">
                    <li class="nav-item ">
                        <a class="nav-link text-dark {{ (request()->is('account')) ? 'active' : '' }}" href="{{ route('account.profile') }}"><i class="fa-regular fa-user me-2"></i> My Account</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-dark  {{ (request()->is('account/orders*')) ? 'active' : '' }}" href="{{ route('order.index') }}"><i class="fa-regular fa-clipboard me-2"></i> Order History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign Out</a>
                    </li>
                </ul>
                <!-- Sidebar menu item END -->
            </div>
        </div>
    </div>
</div>