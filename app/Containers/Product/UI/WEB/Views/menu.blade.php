<style>
    .menu {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        color: #000;
        font-size: 18px;
        padding: 12px;
        font-weight: bold;
        background: #e0c4c4;
    }

    .menu-item {
        padding: 10px;
        margin-left: 20px;
        border-radius: 5px;
    }

    a .menu-item {
        width: 80%;
        height: 50%;
        color: #000;
        text-decoration: none;
    }

    .menu-item:hover {
        background-color: #b26060;
    }
</style>
<header>
    <div class="menu">
        <a href="{{ route('web_product_get_all_products') }}">
            <div class="menu-item">
                Product List
            </div>
        </a>
        @can('list-users')
            <a href="{{ route('get_all_user') }}">
                <div class="menu-item">
                    User List
                </div>
            </a>
        @endcan
        @can('manage-roles')
            <a href="{{ route('get_authorization_home_page') }}">
                <div class="menu-item">
                    Role - Permission
                </div>
            </a>
        @endcan
    </div>
</header>
