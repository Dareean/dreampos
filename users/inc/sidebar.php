<?php
echo '<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class="">
                            <a href="index.php?uid=' . $NewId . '"><i data-feather="grid"></i><span>Dashboard</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Products</h6>
                    <ul>
                        <li><a href="productlist.php?uid=' . $NewId . '"><i data-feather="box"></i><span>Products</span></a></li>
                        <li><a href="categorylist.php?uid=' . $NewId . '"><i data-feather="codepen"></i><span>Category</span></a></li>
                        <li><a href="brandlist.php?uid=' . $NewId . '"><i data-feather="tag"></i><span>Brands</span></a></li>
                        <li><a href="subcategorylist.php?uid=' . $NewId . '"><i data-feather="speaker"></i><span>Sub Category</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Peoples</h6>
                    <ul>
                        <li><a href="userlist.php?uid=' . $NewId . '"><i data-feather="user-check"></i><span>Users</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Pages</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="shield"></i><span>Authentication</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="../signin.php?uid=' . $NewId . '">Log in</a></li>
                                <li><a href="../signup.php?uid=' . $NewId . '">Register</a></li>
                                <li><a href="../forgetpassword.php?uid=' . $NewId . '">Forgot Password</a></li>
                                <li><a href="../resetpassword.php?uid=' . $NewId . '">Reset Password</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Settings</h6>
                    <ul>
                        <li>
                            <a href="../signin.php?uid=' . $NewId . '"><i data-feather="log-out"></i><span>Logout</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>';
?>