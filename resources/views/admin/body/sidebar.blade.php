<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" data-key="t-menu">Menu</li>

        <li>
            <a href="index.html">
                <i data-feather="home"></i>
                <span data-key="t-dashboard">Dashboard</span>
            </a>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i data-feather="grid"></i>
                <span data-key="t-apps">Category</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li>
                    <a href="{{ route('all.category') }}">
                        <span data-key="t-calendar">All Category</span>
                    </a>
                </li>

                <li>
                    <a href="apps-chat.html">
                        <span data-key="t-chat">Add Category</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <span data-key="t-invoices">Invoices</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="apps-invoices-list.html" data-key="t-invoice-list">Invoice List</a></li>
                        <li><a href="apps-invoices-detail.html" data-key="t-invoice-detail">Invoice Detail</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <span data-key="t-contacts">Contacts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="apps-contacts-grid.html" data-key="t-user-grid">User Grid</a></li>
                        <li><a href="apps-contacts-list.html" data-key="t-user-list">User List</a></li>
                        <li><a href="apps-contacts-profile.html" data-key="t-profile">Profile</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="">
                        <span data-key="t-blog">Blog</span>
                        <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">New</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="apps-blog-grid.html" data-key="t-blog-grid">Blog Grid</a></li>
                        <li><a href="apps-blog-list.html" data-key="t-blog-list">Blog List</a></li>
                        <li><a href="apps-blog-detail.html" data-key="t-blog-details">Blog Details</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i data-feather="users"></i>
                <span data-key="t-authentication">Authentication</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="auth-login.html" data-key="t-login">Login</a></li>
                <li><a href="auth-register.html" data-key="t-register">Register</a></li>
            </ul>
        </li>

        <li class="menu-title mt-2" data-key="t-components">Elements</li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i data-feather="briefcase"></i>
                <span data-key="t-components">Components</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="ui-alerts.html" data-key="t-alerts">Alerts</a></li>
                <li><a href="ui-buttons.html" data-key="t-buttons">Buttons</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i data-feather="gift"></i>
                <span data-key="t-ui-elements">Extended</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="extended-lightbox.html" data-key="t-lightbox">Lightbox</a></li>
                <li><a href="extended-rangeslider.html" data-key="t-range-slider">Range Slider</a></li>
            </ul>
        </li>


    </ul>
</div>
