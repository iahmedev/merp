<div class="drawer">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-side z-50"> <!-- Add high z-index here -->
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay z-40"></label>
        <!-- Ensure overlay has lower z-index -->
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-10 z-50">
            <!-- Sidebar content here -->
            <li><a>Sidebar Item 1</a></li>
            <li><a>Sidebar Item 2</a></li>
        </ul>
    </div>
</div>

<label for="my-drawer" class="btn btn-circle swap swap-rotate absolute mt-2 left-0 z-30">
    <!-- hamburger icon -->
    <svg class="swap-off fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
        viewBox="0 0 512 512">
        <path d="M64,384H448V341.33H64Zm0-106.67H448V234.67H64ZM64,128v42.67H448V128Z" />
    </svg>

    <!-- close icon -->
    <svg class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
        viewBox="0 0 512 512">
        <polygon
            points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
    </svg>
</label>
