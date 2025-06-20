<footer class="w-full bg-white/5 border-t border-white/10 text-white mt-auto">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:justify-between gap-10">
            <!-- Logo & Description -->
            <div class="flex-1">
                <img class="w-32 mb-6" src="{{ asset('images/zuco-logo.png') }}" alt="ZUCO">
                <p class="text-sm mb-6">
                    Making the world a better place through <br class="hidden sm:block">
                    constructing elegant hierarchies.
                </p>
                <div class="flex space-x-4">
                    <i class="fa-brands fa-facebook text-2xl hover:text-gray-300"></i>
                    <i class="fa-brands fa-instagram text-2xl hover:text-gray-300"></i>
                    <i class="fa-solid fa-x text-2xl hover:text-gray-300"></i>
                    <i class="fa-brands fa-youtube text-2xl hover:text-gray-300"></i>
                    <i class="fa-brands fa-telegram text-2xl hover:text-gray-300"></i>
                </div>
            </div>

            <!-- Links Section -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-10 flex-1">
                <!-- Solutions -->
                <div>
                    <h2 class="font-semibold mb-4">Solutions</h2>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white">Marketing</a></li>
                        <li><a href="#" class="hover:text-white">Analytics</a></li>
                        <li><a href="#" class="hover:text-white">Automation</a></li>
                        <li><a href="#" class="hover:text-white">Commerce</a></li>
                        <li><a href="#" class="hover:text-white">Insights</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h2 class="font-semibold mb-4">Support</h2>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white">Submit ticket</a></li>
                        <li><a href="#" class="hover:text-white">Documentation</a></li>
                        <li><a href="/document/Doc2.pdf" class="hover:text-white">Guides</a></li>
                        @guest
                            <li><a href="/alogin" class="hover:text-white">For Admin</a></li>
                        @endguest
                        
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h2 class="font-semibold mb-4">Company</h2>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white">About</a></li>
                        <li><a href="#" class="hover:text-white">Blog</a></li>
                        <li><a href="#" class="hover:text-white">Jobs</a></li>
                        <li><a href="#" class="hover:text-white">Press</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div class="sm:col-span-2">
                    <h2 class="font-semibold mb-4">Legal</h2>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white">Terms of service</a></li>
                        <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white">License</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <hr class="my-10 border-white/10">

        <!-- Bottom Text -->
        <p class="text-center text-sm text-gray-400">
            © 2025 ZUCO, Inc. All rights reserved.
        </p>
    </div>
</footer>
