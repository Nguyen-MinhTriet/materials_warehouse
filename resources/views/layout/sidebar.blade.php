<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="index.html" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/system/logo_cty.png') }}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/system/logo_cty.png') }}" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index.html" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/system/logo_cty.png') }}" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/system/logo_cty.png') }}" alt="small logo">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="pages-profile.html">
                <img src="assets/images/users/avatar-1.jpg" alt="user-image" height="42"
                    class="rounded-circle shadow-sm">
                <span class="leftbar-user-name mt-2">Dominic Keller</span>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Điều Hướng</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false"
                    aria-controls="sidebarDashboards" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span class="badge bg-success float-end">5</span>
                    <span> Dashboards </span>
                </a>
                <div class="collapse" id="sidebarDashboards">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="dashboard-analytics.html">Analytics</a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li class="side-nav-title">Chức Năng</li>

            <li class="side-nav-item">
                <a href="apps-chat.html" class="side-nav-link">
                    <i class="uil-comments-alt"></i>
                    <span> Quản Lý NCC </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarCrm" aria-expanded="false" aria-controls="sidebarCrm"
                    class="side-nav-link">
                    <i class="uil uil-tachometer-fast"></i>
                    <span class="badge bg-danger text-white float-end">New</span>
                    <span> Quản lý Hàng Hoá </span>
                </a>
                <div class="collapse" id="sidebarCrm">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="crm-projects.html">Danh Mục</a>
                        </li>
                        <li>
                            <a href="crm-orders-list.html">Vật Tư</a>
                        </li>
                        <li>
                            <a href="crm-clients.html">Đơn Vị Tính</a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Quản Lý Kho </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="apps-ecommerce-products.html">Kho</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-products-details.html">Tổng Quan Kho</a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail"
                    class="side-nav-link">
                    <i class="uil-envelope"></i>
                    <span> Quản Lý Nhập / Xuất </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="apps-email-inbox.html">Phiếu Nhập</a>
                        </li>
                        <li>
                            <a href="apps-email-read.html"> Phiếu Xuất</a>
                        </li>
                        <li>
                            <a href="apps-email-read.html"> Phương Thức Thanh Toán</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarProjects" aria-expanded="false"
                    aria-controls="sidebarProjects" class="side-nav-link">
                    <i class="uil-briefcase"></i>
                    <span> Quản Lý Nhân Viên</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarProjects">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="apps-projects-list.html">QL Nhân viên</a>
                        </li>
                        <li>
                            <a href="apps-projects-details.html">Chấm Công</a>
                        </li>
                        <li>
                            <a href="apps-projects-gantt.html">Lương <span
                                    class="badge rounded-pill bg-light text-dark font-10 float-end">New</span></a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="apps-social-feed.html" class="side-nav-link">
                    <i class="uil-rss"></i>
                    <span> Quản lý Khách Hàng </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false" aria-controls="sidebarTasks"
                    class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span> Báo Cáo </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTasks">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="apps-tasks.html">Tồn Kho</a>
                        </li>
                        <li>
                            <a href="apps-tasks-details.html">Tài Chính</a>
                        </li>
                        <li>
                            <a href="apps-kanban.html">Nhân viên</a>
                        </li>
                        <li>
                            <a href="apps-kanban.html">Khách Hàng / NCC</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="apps-file-manager.html" class="side-nav-link">
                    <i class="uil-folder-plus"></i>
                    <span> Quản Lý Người Dùng </span>
                </a>
            </li>

            <li class="side-nav-title">Custom</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages"
                    class="side-nav-link">
                    <i class="uil-copy-alt"></i>
                    <span> Accounts </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="pages-profile.html">  Admins</a>
                        </li>
                        <li>
                            <a href="pages-profile-2.html"> Staffs</a>
                        </li>
                        <li>
                            <a href="pages-invoice.html">Customers</a>
                        </li>
                        

                    </ul>
                </div>
            </li>

           
   
      
 

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
