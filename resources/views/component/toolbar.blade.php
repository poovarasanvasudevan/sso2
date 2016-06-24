

<div class="toolbar card" >
    <div class="toolbar__left mr++">
        <lx-button lx-size="l" lx-color="white" lx-type="icon"><i class="mdi mdi-menu"></i></lx-button>
    </div>
    <span class="toolbar__label fs-title">Lorem Ipsum</span>

    <div class="toolbar__right">
        <lx-search-filter lx-closed="true" lx-color="white">
            <input type="text" ng-model="vm.toolbar">
        </lx-search-filter>

        <lx-button lx-type="icon"><i class="mdi mdi-bell large-icon"></i></lx-button>


        <button class="btn ml+ mr+" lx-ripple>
            <lx-icon lx-id="account" class="large-icon"></lx-icon>
            {{Auth::user()->name}}
        </button>
        <lx-dropdown lx-position="right" lx-over-toggle="true">
            <lx-dropdown-toggle>
                <lx-button lx-size="l" lx-color="white" lx-type="icon"><i class="mdi mdi-dots-vertical"></i></lx-button>
            </lx-dropdown-toggle>

            <lx-dropdown-menu>
                <ul>
                    <li><a class="dropdown-link">Action</a></li>
                    <li><a class="dropdown-link">Another action</a></li>
                    <li><a class="dropdown-link">Something else here</a></li>
                    <li class="dropdown-divider"></li>
                    <li><a class="dropdown-link dropdown-link--is-header">Settings</a></li>
                    <li><a class="dropdown-link">Account Settings</a></li>
                    <li><a class="dropdown-link">System Settings</a></li>
                    <li><a class="dropdown-link">Change Password</a></li>
                    <li><a class="dropdown-link dropdown-link--is-header">Action</a></li>
                    <li><a class="dropdown-link" href="/logout">Logout</a></li>
                </ul>
            </lx-dropdown-menu>
        </lx-dropdown>
    </div>
</div>

