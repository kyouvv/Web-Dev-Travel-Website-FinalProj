        // 1. Client-Side State Management
        let appState = {
            user: null,
            isAuthenticated: false
        };

        const appContent = document.getElementById('appContent');
        const navHome = document.getElementById('navHome');
        const navHomeLogo = document.getElementById('navHomeLogo');
        const navAttractions = document.getElementById('navAttractions');
        const navInquiries = document.getElementById('navInquiries');

        // 2. Client Side HTML Component Templates
        const templates = {
            home: () => `
                <div id="homeView" class="animate-fadeIn">
                    <div class="hero min-h-[70vh]" style="background-image: url('https://images.unsplash.com/photo-1518156677180-95a2893f3e9f?auto=format&fit=crop&w=1920&q=80');">
                        <div class="hero-overlay bg-opacity-40 bg-black"></div>
                        <div class="hero-content text-neutral-content text-center">
                            <div class="max-w-2xl">
                                <span class="text-xs font-bold tracking-widest uppercase text-secondary">It's time to visit</span>
                                <h1 class="mb-5 text-5xl md:text-7xl font-extrabold tracking-tight mt-2">The Last Frontier</h1>
                                <p class="mb-5 text-lg opacity-90">Consistently named one of the "World's Best Islands", Palawan is a breathtaking destination.</p>
                                <a href="#newsletter" class="btn btn-primary px-8">Explore Now</a>
                            </div>
                        </div>
                    </div>
                    <section class="py-16 px-4 max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <div>
                            <span class="text-sm font-bold text-primary uppercase tracking-wider">Unmatched Beauty</span>
                            <h2 class="text-3xl md:text-4xl font-bold mt-2 mb-4">An Adventurer's Dream</h2>
                            <p class="text-base-content/80 leading-relaxed mb-4">With pristine white beaches and dramatic limestone cliffs...</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-base-200 p-6 rounded-2xl border border-base-300">
                                <div class="text-3xl mb-2">🛶</div>
                                <h3 class="font-bold text-lg">Hidden Lagoons</h3>
                            </div>
                            <div class="bg-base-200 p-6 rounded-2xl border border-base-300">
                                <div class="text-3xl mb-2">🪸</div>
                                <h3 class="font-bold text-lg">Tubbataha Reefs</h3>
                            </div>
                        </div>
                    </section>
                </div>
            `,
            attractions: () => `
                <div class="animate-fadeIn py-12">
                    <div class="text-center max-w-3xl mx-auto mb-12">
                        <span class="text-xs font-bold tracking-widest uppercase text-secondary">Must-Visit Spots</span>
                        <h2 class="text-4xl font-extrabold text-base-content mt-1">Popular Destinations</h2>
                        <p class="text-base-content/70 mt-2">Explore the breathtaking, world-renowned highlights that make Palawan the ultimate "Last Frontier".</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto px-4">
                        
                        <div class="card bg-base-200 border border-base-300 shadow-xl overflow-hidden cursor-pointer hover:shadow-2xl hover:-translate-y-1 transition-all duration-300" onclick="openDestinationModal('el-nido')">
                            <figure class="h-48 overflow-hidden"><img src="https://t4.ftcdn.net/jpg/05/62/27/31/360_F_562273188_kSPIzFiflTq7KjmCLHXkfLUw4u2WEEA2.jpg" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" /></figure>
                            <div class="card-body">
                                <h3 class="card-title text-xl">El Nido</h3>
                                <p class="text-base-content/80 text-sm">Famous for monumental limestone cliffs towering over crystal-clear turquoise lagoons...</p>
                            </div>
                        </div>

                        <div class="card bg-base-200 border border-base-300 shadow-xl overflow-hidden cursor-pointer hover:shadow-2xl hover:-translate-y-1 transition-all duration-300" onclick="openDestinationModal('tubbataha-reefs')">
                            <figure class="h-48 overflow-hidden"><img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" /></figure>
                            <div class="card-body">
                                <h3 class="card-title text-xl">Tubbataha Reefs</h3>
                                <p class="text-base-content/80 text-sm">A pristine, UNESCO-listed Marine Park showcasing some of the ocean's greatest biodiversity...</p>
                            </div>
                        </div>

                        <div class="card bg-base-200 border border-base-300 shadow-xl overflow-hidden cursor-pointer hover:shadow-2xl hover:-translate-y-1 transition-all duration-300" onclick="openDestinationModal('puerto-princesa')">
                            <figure class="h-48 overflow-hidden"><img src="https://dynamic-media.tacdn.com/media/photo-o/32/04/1f/11/caption.jpg?w=2400&h=-1&s=1" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" /></figure>
                            <div class="card-body">
                                <h3 class="card-title text-xl">Puerto Princesa River</h3>
                                <p class="text-base-content/80 text-sm">Journey through an incredible mountain-to-sea ecosystem and navigate a massive underground river...</p>
                            </div>
                        </div>

                    </div>
                </div>
            `,
            inquiries: (username, email) => `
                <div class="animate-fadeIn py-12 px-4">
                    <div class="text-center max-w-3xl mx-auto mb-10">
                        <h2 class="text-4xl font-extrabold mt-2 text-base-content">Send an Inquiry</h2>
                    </div>
                    <div id="inqAlert" class="hidden max-w-2xl mx-auto mb-6 alert"><span id="inqAlertMsg"></span></div>
                    <div class="max-w-2xl mx-auto bg-base-200 border border-base-300 rounded-3xl p-8 shadow-xl">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold">Your Name</span></label>
                                <input type="text" value="${escapeHtml(username)}" class="input input-bordered bg-base-100 opacity-70 cursor-not-allowed" readonly />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold">Email Address</span></label>
                                <input type="email" value="${escapeHtml(email)}" class="input input-bordered bg-base-100 opacity-70 cursor-not-allowed" readonly />
                            </div>
                        </div>
                        <div class="form-control mb-5">
                            <label class="label"><span class="label-text font-semibold">Destination</span></label>
                            <select id="inqDestination" class="select select-bordered bg-base-100">
                                <option value="" disabled selected>— Select —</option>
                                <option value="El Nido">El Nido</option>
                                <option value="Tubbataha Reefs">Tubbataha Reefs</option>
                            </select>
                        </div>
                        <div class="form-control mb-5">
                            <label class="label"><span class="label-text font-semibold">Subject</span></label>
                            <input type="text" id="inqSubject" class="input input-bordered bg-base-100" />
                        </div>
                        <div class="form-control mb-7">
                            <label class="label"><span class="label-text font-semibold">Message</span></label>
                            <textarea id="inqMessage" rows="5" class="textarea textarea-bordered bg-base-100 resize-none"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button id="inqSubmitBtn" onclick="submitInquiry()" class="btn btn-primary px-10">Send Inquiry</button>
                        </div>
                    </div>
                    <div class="max-w-2xl mx-auto mt-10">
                        <h3 class="text-lg font-bold mb-4">Your Previous Inquiries</h3>
                        <div id="inqHistory" class="space-y-3"><div class="text-sm opacity-50">Loading history...</div></div>
                    </div>
                </div>
            `
        };

        // 3. UI Synchronization & Session Checks
        async function syncAuthState() {
            try {
                const res = await fetch('auth_status.php');
                const data = await res.json();
                
                if (data.authenticated) {
                    appState.isAuthenticated = true;
                    appState.user = data.user;
                    
                    // Modify Nav elements for authenticated user
                    document.getElementById('userGreeting').textContent = `Hi, ${data.user.username}!`;
                    document.getElementById('userControls').classList.remove('hidden');
                    document.getElementById('guestControls').classList.add('hidden');
                    document.getElementById('navInquiriesContainer').classList.remove('hidden');
                } else {
                    appState.isAuthenticated = false;
                    appState.user = null;
                    
                    document.getElementById('userControls').classList.add('hidden');
                    document.getElementById('guestControls').classList.remove('hidden');
                    document.getElementById('navInquiriesContainer').classList.add('hidden');
                }
            } catch (err) {
                console.error("Critical authentication sync error:", err);
            }
        }

        function updateActiveTab(activeNode) {
            navHome.classList.remove('active');
            navAttractions.classList.remove('active');
            if(navInquiries) navInquiries.classList.remove('active');
            if(activeNode) activeNode.classList.add('active');
        }

        // 4. View Routing Engine (Replaces multi-file handling)
        function navigateTo(viewName) {
            updateActiveTab(null);
            window.scrollTo({ top: 0, behavior: 'smooth' });

            if (viewName === 'home') {
                updateActiveTab(navHome);
                appContent.innerHTML = templates.home();
            } else if (viewName === 'attractions') {
                updateActiveTab(navAttractions);
                appContent.innerHTML = templates.attractions();
            } else if (viewName === 'inquiries') {
                if (!appState.isAuthenticated) {
                    navigateTo('home');
                    login_modal.showModal();
                    return;
                }
                updateActiveTab(navInquiries);
                appContent.innerHTML = templates.inquiries(appState.user.username, appState.user.email);
                loadInqHistory(); // Dynamic JSON fetch for user data history
            }
        }

        // Navigation Bindings
        navHome.addEventListener('click', (e) => { e.preventDefault(); navigateTo('home'); });
        navHomeLogo.addEventListener('click', (e) => { e.preventDefault(); navigateTo('home'); });
        navAttractions.addEventListener('click', (e) => { e.preventDefault(); navigateTo('attractions'); });
        navInquiries.addEventListener('click', (e) => { e.preventDefault(); navigateTo('inquiries'); });

        // 5. Form Processing Actions (AJAX/Fetch Operations)
        async function submitInquiry() {
            const destination = document.getElementById('inqDestination').value;
            const subject     = document.getElementById('inqSubject').value.trim();
            const message     = document.getElementById('inqMessage').value.trim();
            const btn         = document.getElementById('inqSubmitBtn');

            if (!destination || !subject || !message) return showInqAlert('error', 'Complete all fields.');

            btn.disabled = true;
            const form = new FormData();
            form.append('destination', destination);
            form.append('subject', subject);
            form.append('message', message);

            try {
                const res = await fetch('inquiry_handler.php', { method: 'POST', body: form });
                const data = await res.json();
                if (data.status === 'success') {
                    showInqAlert('success', data.message);
                    loadInqHistory();
                } else {
                    showInqAlert('error', data.message);
                }
            } catch {
                showInqAlert('error', 'Network failure.');
            } finally {
                btn.disabled = false;
            }
        }

        async function loadInqHistory() {
            const container = document.getElementById('inqHistory');
            if (!container) return;
            try {
                const res = await fetch('inquiry_handler.php?action=history');
                const data = await res.json();
                if (!data.inquiries || data.inquiries.length === 0) {
                    container.innerHTML = '<p class="text-sm opacity-50">No inquiries yet.</p>';
                    return;
                }
                container.innerHTML = data.inquiries.map(inq => `
                    <div class="bg-base-100 border p-4 rounded-xl">
                        <div class="flex justify-between font-bold text-sm"><span>${escapeHtml(inq.subject)}</span><span class="badge">${escapeHtml(inq.status)}</span></div>
                        <p class="text-xs text-secondary mt-1">${escapeHtml(inq.destination)}</p>
                        <p class="text-sm opacity-80 mt-2">${escapeHtml(inq.message)}</p>
                    </div>
                `).join('');
            } catch {
                container.innerHTML = '<p class="text-error text-sm">Error parsing data history.</p>';
            }
        }

        function handleAuthSubmit(formId, submitBtnId, alertId, modalObject) {
            document.getElementById(formId).addEventListener('submit', async function(e) {
                e.preventDefault();
                const form = e.target;
                const submitBtn = document.getElementById(submitBtnId);
                const alertBox = document.getElementById(alertId);

                submitBtn.disabled = true;
                alertBox.classList.add('hidden');

                try {
                    const res = await fetch('auth_handler.php', { method: 'POST', body: new FormData(form) });
                    const data = await res.json();

                    alertBox.className = `alert text-sm mb-4 block ${data.status === 'success' ? 'alert-success' : 'alert-error'}`;
                    alertBox.textContent = data.message;
                    alertBox.classList.remove('hidden');

                    if (data.status === 'success') {
                        form.reset();
                        await syncAuthState(); // Recheck cookie validation state dynamically
                        setTimeout(() => {
                            modalObject.close();
                            navigateTo('home');
                        }, 1000);
                    }
                } catch {
                    alertBox.className = "alert alert-error text-sm mb-4 block";
                    alertBox.textContent = "Processing runtime error occurred.";
                    alertBox.classList.remove('hidden');
                } finally {
                    submitBtn.disabled = false;
                }
            });
        }

        document.getElementById('logoutBtn').addEventListener('click', async () => {
            const fd = new FormData();
            fd.append('action', 'logout');
            await fetch('auth_handler.php', { method: 'POST', body: fd });
            await syncAuthState();
            navigateTo('home');
        });

        // System Utilities
        function showInqAlert(type, msg) {
            const el = document.getElementById('inqAlert');
            const txt = document.getElementById('inqAlertMsg');
            el.className = `max-w-2xl mx-auto mb-6 alert ${type === 'success' ? 'alert-success' : 'alert-error'}`;
            txt.textContent = msg;
            el.classList.remove('hidden');
        }

        function escapeHtml(str) {
            const d = document.createElement('div');
            d.textContent = str ?? '';
            return d.innerHTML;
        }

        // Initialize Application Core Lifecycle
        handleAuthSubmit('loginForm', 'loginSubmit', 'loginAlert', login_modal);
        handleAuthSubmit('registerForm', 'registerSubmit', 'registerAlert', register_modal);
        console.log(appState);
        (async () => {
            await syncAuthState(); // Check session status
            navigateTo('home');    // Safe default template insertion
        })();