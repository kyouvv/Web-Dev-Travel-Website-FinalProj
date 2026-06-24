<div
    id="destinationModal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modalTitle"
    class="fixed inset-0 z-[9999] hidden items-center justify-center p-4"
>
    <!-- Backdrop -->
    <div
        id="modalBackdrop"
        onclick="closeDestinationModal()"
        class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity duration-300 opacity-0"
    ></div>

    <!-- Panel -->
    <div
        id="modalPanel"
        class="relative z-10 bg-base-100 rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto
               transform transition-all duration-300 scale-95 opacity-0"
    >
        <!-- Hero image -->
        <div class="relative h-64 overflow-hidden rounded-t-3xl">
            <img
                id="modalImage"
                src=""
                alt=""
                class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

            <!-- Close button -->
            <button
                onclick="closeDestinationModal()"
                aria-label="Close"
                class="absolute top-4 right-4 btn btn-circle btn-sm bg-black/40 border-0 text-white hover:bg-black/70"
            >✕</button>

            <!-- Badge -->
            <span
                id="modalBadge"
                class="absolute bottom-4 left-5 badge badge-secondary font-bold tracking-wide"
            ></span>
        </div>

        <!-- Body -->
        <div class="p-6 md:p-8">
            <h2 id="modalTitle" class="text-3xl font-extrabold text-base-content mb-1"></h2>
            <p  id="modalTagline" class="text-sm font-semibold text-primary uppercase tracking-widest mb-4"></p>

            <div id="modalBody" class="prose prose-sm max-w-none text-base-content/80 leading-relaxed space-y-3">
                <!-- Blog content injected here -->
            </div>

            <!-- Highlights -->
            <div id="modalHighlights" class="mt-6 grid grid-cols-2 gap-3"></div>

            <!-- CTA -->
            <div class="mt-8 flex justify-end">
                <button
                    onclick="closeDestinationModal()"
                    class="btn btn-primary px-8"
                >Close</button>
            </div>
        </div>
    </div>
</div>

<script>
// ─────────────────────────────────────────────────────────────────────────────
// DESTINATION DATA REGISTRY
// Add a new entry here for every destination card you want to support.
// ─────────────────────────────────────────────────────────────────────────────
const DESTINATIONS = {

    'el-nido': {
        title:   'El Nido',
        tagline: 'Gateway to the Bacuit Archipelago',
        badge:   '⭐ Most Popular',
        image:   'https://images.unsplash.com/photo-1695051702427-1c24ce3682e7?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8ZWwlMjBuaWRvJTIwcGFsYXdhbnxlbnwwfHwwfHx8MA%3D%3D',
        body: `
            <p>El Nido is Palawan's crown jewel — a municipality carved between dramatic karst limestone
            towers and the turquoise waters of the Bacuit Bay. It has consistently ranked among the
            world's best island destinations for its sheer natural drama and biodiversity.</p>

            <p>Island-hopping tours (Tour A through D) wind through hidden lagoons, secret beaches,
            snorkeling spots, and cathedral-like rock formations. The Big Lagoon and Small Lagoon
            are the undisputed highlights — best explored by kayak at sunrise before the crowds arrive.</p>

            <p>Beyond the water, Nagkalit-kalit Falls offers a jungle trek reward, and the clifftop
            viewpoints around Corong-Corong barangay deliver unforgettable sunset panoramas.</p>
        `,
        highlights: [
            { icon: '🛶', label: 'Kayaking', note: 'Hidden lagoons & sea caves' },
            { icon: '🤿', label: 'Snorkeling', note: 'Coral gardens & sea turtles' },
            { icon: '🏝️', label: 'Island Hopping', note: 'Tours A–D available daily' },
            { icon: '🌅', label: 'Sunsets', note: 'Corong-Corong viewpoints' },
        ],
    },

    'tubbataha': {
        title:   'Tubbataha Reefs',
        tagline: 'UNESCO World Heritage Marine Park',
        badge:   '🏛️ UNESCO Site',
        image:   'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80',
        body: `
            <p>Located in the middle of the Sulu Sea, Tubbataha Reefs Natural Park is one of the
            Philippines' most pristine and protected marine ecosystems — and one of the best dive
            destinations on the planet. Access is only possible by liveaboard, making it a true
            expedition experience.</p>

            <p>The park consists of two atolls teeming with over 600 fish species, 360 coral species,
            sharks, manta rays, and nesting seabirds. Visibility can exceed 40 metres, revealing
            near-vertical coral walls that plunge hundreds of feet into the deep blue.</p>

            <p>The diving season is strict — only March to June — ensuring the reef is given time
            to recover each year. Permits are required and quotas are tightly controlled, which keeps
            Tubbataha genuinely wild and uncrowded.</p>
        `,
        highlights: [
            { icon: '🦈', label: 'Sharks', note: 'Whitetip, hammerhead & more' },
            { icon: '🪸', label: 'Coral Walls', note: 'Drops to 100 m+' },
            { icon: '🚢', label: 'Liveaboard Only', note: 'Season: Mar – Jun' },
            { icon: '🐢', label: 'Sea Turtles', note: 'Hawksbill nesting site' },
        ],
    },

    'puerto-princesa': {
        title:   'Puerto Princesa River',
        tagline: 'One of the New Seven Wonders of Nature',
        badge:   '🌿 World Wonder',
        image:   'https://www.travel-palawan.com/wp-content/uploads/2018/02/Underground-River-Banner-copy-1024x683.jpeg',
        body: `
            <p>The Puerto Princesa Subterranean River winds 8.2 kilometres through a spectacular
            cave system before emptying directly into the sea — making it one of the world's longest
            navigable underground rivers. It was declared a UNESCO World Heritage Site in 1999 and
            a New Seven Wonders of Nature in 2012.</p>

            <p>Guided paddle boats take visitors deep into the cave, passing towering stalactites and
            stalagmites, cathedral-like chambers, and colonies of cave swiftlets and bats that
            swirl overhead. The journey is as eerie as it is beautiful.</p>

            <p>The surrounding St. Paul Mountain Range is a complete mountain-to-sea ecosystem and
            one of the most important biodiversity zones in Asia. Wildlife including monitor lizards,
            macaques, and hornbills can often be spotted on the approach trail.</p>
        `,
        highlights: [
            { icon: '🚣', label: 'Boat Tour', note: '8.2 km navigable river' },
            { icon: '🦇', label: 'Cave Wildlife', note: 'Swiftlets & bats inside' },
            { icon: '🦎', label: 'Trail Wildlife', note: 'Monitors & hornbills' },
            { icon: '🏔️', label: 'Ecosystem', note: 'Mountain-to-sea reserve' },
        ],
    },

};

// ─────────────────────────────────────────────────────────────────────────────
// MODAL LOGIC  — no edits needed below unless you want to customise behaviour
// ─────────────────────────────────────────────────────────────────────────────

function openDestinationModal(id) {
    const data = DESTINATIONS[id];
    if (!data) {
        console.warn(`openDestinationModal: no destination registered for id "${id}"`);
        return;
    }

    document.getElementById('modalImage').src     = data.image;
    document.getElementById('modalImage').alt     = data.title;
    document.getElementById('modalTitle').textContent   = data.title;
    document.getElementById('modalTagline').textContent = data.tagline;
    document.getElementById('modalBadge').textContent   = data.badge;
    document.getElementById('modalBody').innerHTML      = data.body;

    const grid = document.getElementById('modalHighlights');
    grid.innerHTML = (data.highlights || []).map(h => `
        <div class="bg-base-200 rounded-2xl p-4 flex items-start gap-3 border border-base-300">
            <span class="text-2xl">${h.icon}</span>
            <div>
                <p class="font-bold text-sm text-base-content">${h.label}</p>
                <p class="text-xs text-base-content/60">${h.note}</p>
            </div>
        </div>
    `).join('');

    // Show modal
    const modal    = document.getElementById('destinationModal');
    const backdrop = document.getElementById('modalBackdrop');
    const panel    = document.getElementById('modalPanel');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';

    requestAnimationFrame(() => {
        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');
        panel.classList.remove('scale-95', 'opacity-0');
        panel.classList.add('scale-100', 'opacity-100');
    });
}

function closeDestinationModal() {
    const modal    = document.getElementById('destinationModal');
    const backdrop = document.getElementById('modalBackdrop');
    const panel    = document.getElementById('modalPanel');

    backdrop.classList.remove('opacity-100');
    backdrop.classList.add('opacity-0');
    panel.classList.remove('scale-100', 'opacity-100');
    panel.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }, 300);
}

// Close on Escape key
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeDestinationModal();
});
</script>