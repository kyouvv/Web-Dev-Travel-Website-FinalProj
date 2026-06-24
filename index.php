<?php
require_once __DIR__ . '/auth.php';

$currentUser = currentUser();
?>

<!DOCTYPE html>
<html lang="en" data-theme="emerald">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palawan - Discover the Last Frontier</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.4s ease-out forwards; }
    </style>
</head>
<body class="min-h-screen bg-base-100 flex flex-col justify-between">

    <div class="navbar bg-base-100 shadow-md sticky top-0 z-50 px-4 md:px-12">
        <div class="flex-1">
            <a href="#" id="navHomeLogo" class="btn btn-ghost text-xl font-bold tracking-wider text-primary">PALAWAN</a>
        </div>
        <div class="flex-none gap-4">
            <ul class="menu menu-horizontal px-1 font-semibold gap-1">
                <li><a href="#" id="navHome" class="active">Home</a></li>
                <li><a href="#" id="navAttractions">Destinations</a></li>
            </ul>
            <div class="flex gap-2">
                <?php if ($currentUser['id']): ?>
                    <span class="text-sm font-semibold opacity-80 hidden sm:inline">
                        Hi, <?php echo htmlspecialchars($currentUser['username']); ?>!
                    </span>
                    <button id="logoutBtn" class="btn btn-outline btn-error btn-sm font-semibold" onclick="logout()">
                        Logout
                    </button>
                <?php else: ?>
                    <button class="btn btn-ghost btn-sm font-semibold" onclick="login_modal.showModal()">Login</button>
                    <button class="btn btn-primary btn-sm font-semibold" onclick="register_modal.showModal()">Register</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <main id="appContent" class="flex-grow">
        <div id="homeView" class="animate-fadeIn">
            <div class="hero min-h-[70vh]" style="background-image: url('https://images.unsplash.com/photo-1518156677180-95a2893f3e9f?auto=format&fit=crop&w=1920&q=80'); background-position: center;">
                <div class="hero-overlay bg-opacity-40 bg-black"></div>
                <div class="hero-content text-neutral-content text-center">
                    <div class="max-w-2xl">
                        <span class="text-xs font-bold tracking-widest uppercase text-secondary">It's time to visit</span>
                        <h1 class="mb-5 text-5xl md:text-7xl font-extrabold tracking-tight mt-2">The Last Frontier</h1>
                        <p class="mb-5 text-lg opacity-90">Consistently named one of the "World's Best Islands", Palawan is a breathtaking destination that captures the heart and soul of the Philippines.</p>
                        <a href="#newsletter" class="btn btn-primary px-8">Explore Now</a>
                    </div>
                </div>
            </div>

            <section class="py-16 px-4 max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-sm font-bold text-primary uppercase tracking-wider">Unmatched Beauty</span>
                    <h2 class="text-3xl md:text-4xl font-bold mt-2 mb-4">An Adventurer's Dream</h2>
                    <p class="text-base-content/80 leading-relaxed mb-4">With its pristine white beaches, dramatic limestone cliffs, lush rainforests, and majestic mountains, it offers an unmatched blend of cultural richness, natural beauty, and thrilling adventure.</p>
                    <p class="text-base-content/80 leading-relaxed">Perfect for trekking through hills and valleys, kayaking through hidden lagoons, and snorkeling or diving in some of the world's most diverse and protected marine ecosystems.</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-base-200 p-6 rounded-2xl border border-base-300">
                        <div class="text-3xl mb-2">🛶</div>
                        <h3 class="font-bold text-lg">Hidden Lagoons</h3>
                        <p class="text-xs text-base-content/70 mt-1">Perfect for scenic kayaking and absolute serenity.</p>
                    </div>
                    <div class="bg-base-200 p-6 rounded-2xl border border-base-300">
                        <div class="text-3xl mb-2">🪸</div>
                        <h3 class="font-bold text-lg">Tubbataha Reefs</h3>
                        <p class="text-xs text-base-content/70 mt-1">UNESCO-listed park with vibrant, world-class dive sites.</p>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <section id="newsletter" class="bg-primary text-primary-content py-12 px-4 text-center">
        <div class="max-w-md mx-auto">
            <h2 class="text-2xl font-bold mb-2">Get Your Holiday Guide</h2>
            <form id="newsletterForm" class="flex flex-col sm:flex-row gap-2 justify-center items-stretch">
                <input type="email" id="emailInput" name="email" placeholder="Enter your email address" class="input input-bordered w-full text-base-content" required />
                <button type="submit" id="submitBtn" class="btn btn-secondary px-6">
                    <span id="btnText">Subscribe</span>
                    <span id="btnSpinner" class="loading loading-spinner hidden"></span>
                </button>
            </form>
            <div id="statusMessage" class="mt-4 hidden alert max-w-md mx-auto"></div>
        </div>
    </section>

    <footer class="footer footer-center bg-neutral text-neutral-content p-6">
        <aside><p>Copyright © 2026 - Palawan Expeditions</p></aside>
    </footer>


    <dialog id="login_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-2xl font-bold mb-6 text-center text-primary">Welcome Back</h3>
            
            <div id="loginAlert" class="alert hidden text-sm mb-4"></div>

            <form id="loginForm" class="space-y-4">
                <input type="hidden" name="action" value="login" />
                <div class="form-control">
                    <label class="label"><span class="label-text font-semibold">Email Address</span></label>
                    <input type="email" name="email" placeholder="you@example.com" class="input input-bordered w-full" required />
                </div>
                <div class="form-control">
                    <label class="label"><span class="label-text font-semibold">Password</span></label>
                    <input type="password" name="password" placeholder="••••••••" class="input input-bordered w-full" required />
                    <label class="label justify-end">
                        <a href="#" class="label-text-alt link link-hover text-secondary">Forgot password?</a>
                    </label>
                </div>
                <button type="submit" id="loginSubmit" class="btn btn-primary w-full mt-2">
                    <span class="btn-text">Sign In</span>
                    <span class="loading loading-spinner hidden"></span>
                </button>
            </form>
            
            <p class="text-center text-sm mt-6">
                Don't have an account? 
                <button class="link link-primary font-semibold" onclick="login_modal.close(); register_modal.showModal()">Register here</button>
            </p>
        </div>
    </dialog>

    <dialog id="register_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-2xl font-bold mb-6 text-center text-primary">Create Your Account</h3>
            
            <div id="registerAlert" class="alert hidden text-sm mb-4"></div>

            <form id="registerForm" class="space-y-4">
                <input type="hidden" name="action" value="register" />
                <div class="form-control">
                    <label class="label"><span class="label-text font-semibold">Full Name</span></label>
                    <input type="text" name="name" placeholder="John Doe" class="input input-bordered w-full" required />
                </div>
                <div class="form-control">
                    <label class="label"><span class="label-text font-semibold">Email Address</span></label>
                    <input type="email" name="email" placeholder="you@example.com" class="input input-bordered w-full" required />
                </div>
                <div class="form-control">
                    <label class="label"><span class="label-text font-semibold">Password</span></label>
                    <input type="password" name="password" placeholder="Min. 8 characters" class="input input-bordered w-full" required />
                </div>
                <button type="submit" id="registerSubmit" class="btn btn-primary w-full mt-2">
                    <span class="btn-text">Sign Up</span>
                    <span class="loading loading-spinner hidden"></span>
                </button>
            </form>
            
            <p class="text-center text-sm mt-6">
                Already have an account? 
                <button class="link link-primary font-semibold" onclick="register_modal.close(); login_modal.showModal()">Login here</button>
            </p>
        </div>
    </dialog>


    <script>
        const initialHomeHTML = document.getElementById('homeView').outerHTML;
        const appContent = document.getElementById('appContent');
        
        const navHome = document.getElementById('navHome');
        const navHomeLogo = document.getElementById('navHomeLogo');
        const navAttractions = document.getElementById('navAttractions');

        function updateActiveTab(activeNode) {
            navHome.classList.remove('active');
            navAttractions.classList.remove('active');
            if(activeNode) activeNode.classList.add('active');
        }

        // Action: Load Home View (Instant - No Fetch required)
        function loadHomeView(e) {
            e.preventDefault();
            appContent.innerHTML = initialHomeHTML;
            updateActiveTab(navHome);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        navHome.addEventListener('click', loadHomeView);
        navHomeLogo.addEventListener('click', loadHomeView);

        // Action: Load Attractions View Seamlessly via AJAX Fetch
        navAttractions.addEventListener('click', function(e) {
            e.preventDefault();
            updateActiveTab(navAttractions);

            appContent.innerHTML = `
                <div class="flex justify-center items-center min-h-[50vh]">
                    <span class="loading loading-dots loading-lg text-primary"></span>
                </div>
            `;

            fetch('attractions.php')
                .then(response => {
                    if (!response.ok) throw new Error('Network error');
                    return response.text();
                })
                .then(htmlMarkup => {
                    appContent.innerHTML = htmlMarkup;
                    appContent.querySelectorAll('script').forEach(oldScript => {
                        const newScript = document.createElement('script');
                        newScript.textContent = oldScript.textContent;
                        document.body.appendChild(newScript);
                        oldScript.remove();
                    });
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                })
                .catch(err => {
                    appContent.innerHTML = `
                        <div class="alert alert-error max-w-md mx-auto my-12">
                            <span>Failed to load destinations. Please try again.</span>
                        </div>
                    `;
                });
        });

        // AJAX handling for Newsletter Subscription Processing
        document.getElementById('newsletterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = document.getElementById('emailInput');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');
            const statusMessage = document.getElementById('statusMessage');

            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
            statusMessage.classList.add('hidden');

            const formData = new FormData();
            formData.append('email', emailInput.value);

            fetch('subscribe.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnSpinner.classList.add('hidden');
                statusMessage.className = "mt-4 alert max-w-md mx-auto block " + 
                    (data.status === 'success' ? 'alert-success text-success-content' : 'alert-error text-error-content');
                statusMessage.textContent = data.message;
                if (data.status === 'success') emailInput.value = '';
            })
            .catch(() => {
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnSpinner.classList.add('hidden');
                statusMessage.className = "mt-4 alert alert-error text-error-content max-w-md mx-auto block";
                statusMessage.textContent = "An error occurred.";
            });
        });

        function handleAuthSubmit(formId, submitBtnId, alertId, modalObject) {
            document.getElementById(formId).addEventListener('submit', function(e) {
                e.preventDefault();
                
                const form = e.target;
                const submitBtn = document.getElementById(submitBtnId);
                const btnText = submitBtn.querySelector('.btn-text');
                const btnSpinner = submitBtn.querySelector('.loading');
                const alertBox = document.getElementById(alertId);

                // UI loading state
                submitBtn.disabled = true;
                btnText.classList.add('hidden');
                btnSpinner.classList.remove('hidden');
                alertBox.classList.add('hidden');

                const formData = new FormData(form);

                fetch('auth_handler.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => {
                    if (!res.ok) throw new Error('Server returned error status');
                    return res.json();
                })
                .then(data => {
                    // Revert button interface state
                    submitBtn.disabled = false;
                    btnText.classList.remove('hidden');
                    btnSpinner.classList.add('hidden');

                    alertBox.className = `alert text-sm mb-4 block ${data.status === 'success' ? 'alert-success text-success-content' : 'alert-error text-error-content'}`;
                    alertBox.textContent = data.message;

                    if (data.status === 'success') {
                        form.reset();
                        // Optional: close modal and reload after brief visual feedback
                        setTimeout(() => {
                            alertBox.classList.add('hidden');
                            modalObject.close();
                            if (data.redirect) window.location.href = data.redirect;
                        }, 1200);
                    }
                })
                .catch(err => {
                    submitBtn.disabled = false;
                    btnText.classList.remove('hidden');
                    btnSpinner.classList.add('hidden');
                    
                    alertBox.className = "alert alert-error text-error-content text-sm mb-4 block";
                    alertBox.textContent = "An unexpected error occurred. Please try again.";
                });
            });
        }

        // Bind logic onto active dialogue items
        handleAuthSubmit('loginForm', 'loginSubmit', 'loginAlert', login_modal);
        handleAuthSubmit('registerForm', 'registerSubmit', 'registerAlert', register_modal);

        const logoutBtn = document.getElementById('logoutBtn');
        function logout() {
            console.log('Logging out...');
            const fd = new FormData();
            fd.append('action', 'logout');
            fetch('auth_handler.php', { method: 'POST', body: fd })
                .then(() => window.location.reload());
        }

        document.getElementById('logoutBtn')?.addEventListener('click', logout);
    </script>
</body>
</html>