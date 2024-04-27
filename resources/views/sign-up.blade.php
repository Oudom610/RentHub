@extends('layout.home-master')

@section('content')

{{-- <section class="flex flex-col items-center justify-start px-6 py-8 mx-auto">
    <div class="w-full rounded-lg shadow border border-gray-300 dark:border-gray-700 md:mt-0 sm:max-w-md xl:p-0 bg-gradient-to-r from-blue-100 via-blue-50 to-blue-100 dark:bg-gradient-to-r dark:from-blue-800 dark:via-blue-700 dark:to-blue-800">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-800 md:text-2xl dark:text-white">
                Create A Landlord Account
            </h1>
            <form class="space-y-4 md:space-y-6" action="#">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-800 dark:text-white">Name</label>
                    <input type="text" name="name" id="name" class="bg-white border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                </div>                    
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-800 dark:text-white">Email Address</label>
                    <input type="email" name="email" id="email" class="bg-white border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-800 dark:text-white">Password</label>
                    <input type="password" name="password" id="password" class="bg-white border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                </div>
                <div>
                    <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-800 dark:text-white">Confirm password</label>
                    <input type="confirm-password" name="confirm-password" id="confirm-password" class="bg-white border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                </div>
                <button type="submit" class="w-full text-white bg-[#2c6bf7] hover:bg-[#2359d5] focus:ring-4 focus:outline-none focus:ring-[#3c7bff] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                <p class="text-sm font-light text-gray-400 dark:text-gray-300">
                    Already have a landlord account? <a href="#" class="font-medium text-white hover:underline dark:text-white">Login here</a>
                </p>
            </form>
        </div>
    </div>
</section> --}}

{{-- <section class="flex flex-col items-center justify-start px-6 py-8 mx-auto">
    <div class="w-full rounded-lg shadow border border-gray-300 dark:border-gray-700 md:mt-0 sm:max-w-md xl:p-0" style="background-color: #1489ec;">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-800 md:text-2xl dark:text-white">
                Create A Landlord Account
            </h1>
            <form class="space-y-4 md:space-y-6" action="#">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-800 dark:text-white">Name</label>
                    <input type="text" name="name" id="name" class="bg-white border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                </div>                    
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-800 dark:text-white">Email Address</label>
                    <input type="email" name="email" id="email" class="bg-white border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-800 dark:text-white">Password</label>
                    <input type="password" name="password" id="password" class="bg-white border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                </div>
                <div>
                    <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-800 dark:text-white">Confirm password</label>
                    <input type="confirm-password" name="confirm-password" id="confirm-password" class="bg-white border border-gray-300 text-gray-800 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                </div>
                <button type="submit" class="w-full text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                <p class="text-sm font-light text-gray-400 dark:text-gray-300">
                    Already have a landlord account? <a href="#" class="font-medium text-white hover:underline dark:text-white">Login here</a>
                </p>
            </form>
        </div>
    </div>
</section> --}}

<section class="flex flex-col items-center justify-start px-6 py-8 mx-auto">
    <div class="w-full rounded-lg shadow border border-gray-300 md:mt-0 sm:max-w-md xl:p-0 bg-[#3661e3]">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl">
                Create A Landlord Account
            </h1>
            <form class="space-y-4 md:space-y-6" action="#">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-white">Name</label>
                    <input type="text" name="name" id="name" class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-2.5" required="">
                </div>                    
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-white">Email Address</label>
                    <input type="email" name="email" id="email" class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-2.5" required="">
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                    <input type="password" name="password" id="password" class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-2.5" required="">
                </div>
                <div>
                    <label for="confirm-password" class="block mb-2 text-sm font-medium text-white">Confirm password</label>
                    <input type="password" name="confirm-password" id="confirm-password" class="bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-300 focus:border-blue-300 block w-full p-2.5" required="">
                </div>
                <button type="submit" class="w-full bg-white text-[#1489ec] hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-4 sm:px-5 py-2 sm:py-2.5 text-center transition duration-300 ease-in-out">Create an account</button>
                <p class="text-sm font-light text-gray-300 dark:text-gray-200">
                    Already have a landlord account? <a href="/login-landlord" class="font-medium text-white hover:underline">Login here</a>
                </p>
            </form>
        </div>
    </div>
</section>





@endsection
