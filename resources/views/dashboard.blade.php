{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentHub Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
      @media (max-width: 768px) {
        .sidebar {
          transform: translateX(-100%);
          transition: transform 0.3s ease-in-out;
        }
        .sidebar.open {
          transform: translateX(0);
        }
      }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">

        <!-- Sidebar Toggle Button for Mobile -->
        <button class="p-4 text-blue-600 bg-white rounded-md absolute top-5 left-5 z-50 md:hidden" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Responsive Sidebar -->
        <div class="w-64 min-h-screen bg-blue-600 p-5 text-white fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out sidebar" id="sidebar">
            <div class="flex items-center space-x-2 mb-5">
                <i class="fas fa-home text-2xl"></i>
                <span class="text-xl font-bold">RENTHUB</span>
            </div>
            <nav class="flex flex-col space-y-2">
                <!-- Home nav item -->
                <a href="#" class="flex items-center space-x-2 py-2 px-4 rounded-md bg-blue-700 hover:bg-blue-700">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <!-- Lease nav item -->
                <a href="#" class="flex items-center space-x-2 py-2 px-4 rounded-md hover:bg-blue-700">
                    <i class="fas fa-file-contract"></i>
                    <span>Lease</span>
                </a>
                <!-- Rent nav item -->
                <a href="#" class="flex items-center space-x-2 py-2 px-4 rounded-md hover:bg-blue-700">
                    <i class="fas fa-coins"></i>
                    <span>Rent</span>
                </a>
                <!-- Utility nav item -->
                <a href="#" class="flex items-center space-x-2 py-2 px-4 rounded-md hover:bg-blue-700">
                    <i class="fas fa-bolt"></i>
                    <span>Utility</span>
                </a>
            </nav>            
        </div>

        <!-- Content -->
        <div class="flex-1 min-h-screen p-10 md:pl-64">
            <!-- Content Header -->
            <div class="flex justify-between items-center mb-10">
                <!-- Replace the h1 tag with a placeholder div -->
                <div class="w-64 md:hidden"></div>
                <div class="flex items-center justify-end space-x-4 flex-1">
                    <img class="w-10 h-10 rounded-full" src="path-to-profile-image.jpg" alt="User Profile" />
                    <span>Bunheang</span>
                    <i class="fas fa-chevron-down text-gray-600"></i>
                </div>
            </div>

            <!-- Main content goes here -->
        </div>
    </div>

    <script>
        // Toggle the sidebar on small screens
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('open');
        });
    </script>
</body>
</html> --}}

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="./assets/img/renthubicon.png" />
    <title>RentHub</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Main Styling -->
    <link href="./assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5" rel="stylesheet" />    
  </head>

  <body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    <!-- sidenav  -->

    <aside class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0" style="background-color: #3f87e5;">
        <div class="h-19.5">
            <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-white xl:hidden" sidenav-close></i>
            <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-white">
                <i class="fas fa-home text-2xl"></i>
                <span class="ml-1 font-semibold">RentHub Dashboard</span>
            </a>
        </div>
    
        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
    
        <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
            <ul class="flex flex-col pl-0 mb-0">
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm my-0 mx-4 flex items-center whitespace-nowrap px-4 rounded-lg bg-white text-blue-500" href="#">
                        <i class="fas fa-chart-pie mr-2 text-xl"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm my-0 mx-4 flex items-center whitespace-nowrap px-4 text-white" href="#">
                        <i class="fas fa-table mr-2 text-xl"></i>
                        <span>Lease</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm my-0 mx-4 flex items-center whitespace-nowrap px-4 text-white" href="#">
                        <i class="fas fa-credit-card mr-2 text-xl"></i>
                        <span>Rent</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm my-0 mx-4 flex items-center whitespace-nowrap px-4 text-white" href="#">
                        <i class="fas fa-vr-cardboard mr-2 text-xl"></i>
                        <span>Utility</span>
                    </a>
                </li>
                <li class="w-full mt-4">
                    <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase text-white">Account Page</h6>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm my-0 mx-4 flex items-center whitespace-nowrap px-4 text-white" href="#">
                        <i class="fas fa-user-circle mr-2 text-xl"></i>
                        <span>Profile</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>      

    <!-- end sidenav -->

    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="mb-0 font-bold capitalize">Home</h6>
                </nav>
    
                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <div class="flex items-center md:ml-auto md:pr-4">
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                        </div>
                    </div>
    
                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                        <li class="flex items-center relative">
                            <a href="#" class="block px-0 py-2 text-sm font-semibold transition-all ease-nav-brand text-slate-500 flex items-center dropdown-toggle" id="dropdownToggle" onclick="toggleDropdown()">
                                <img src="profile-picture.jpg" alt="Profile Picture" class="w-8 h-8 rounded-full mr-2" />
                                <span class="hidden sm:inline">Yurin Zeckar</span>
                                <i class="fa fa-angle-down ml-2"></i>
                            </a>
                            <div id="dropdownMenu" class="absolute right-0 z-10 hidden dropdown-menu" style="top: 100%; left: 0; margin-top: 0.5rem;">
                                <ul class="py-1 bg-white rounded-md shadow-lg">
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-blue hover:font-bold">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>                    

                </div>
            </div>
        </nav>
        <!-- end Navbar -->
    </main>  

  </body>

  {{-- Include the JavaScript file --}}
    <script src="{{ asset('assets/js/logout-dropdown.js') }}"></script>

</html>
