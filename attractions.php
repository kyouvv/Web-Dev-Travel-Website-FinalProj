<?php
// attractions.php - Loaded dynamically via AJAX
// The modal file only needs to be included ONCE per page.
// Because this view is injected into index.php via AJAX, we include it here
// so it arrives with the content. The script inside is safe to re-include.
include 'destination-modal.php';
?>
<div class="animate-fadeIn py-12">
    <div class="text-center max-w-3xl mx-auto mb-12">
        <span class="text-xs font-bold tracking-widest uppercase text-secondary">Must-Visit Spots</span>
        <h2 class="text-4xl font-extrabold mt-2 text-base-content">Popular Destinations</h2>
        <p class="text-base-content/70 mt-3">Explore the breathtaking, world-renowned highlights that make Palawan the ultimate "Last Frontier".</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto px-4">

        <!-- El Nido — onclick passes the registered id -->
        <div
            class="card card-compact bg-base-200 shadow-xl border border-base-300 overflow-hidden
                   cursor-pointer hover:shadow-2xl hover:-translate-y-1 transition-all duration-300"
            onclick="openDestinationModal('el-nido')"
            role="button"
            tabindex="0"
            onkeydown="if(event.key==='Enter') openDestinationModal('el-nido')"
            aria-label="Read more about El Nido"
        >
            <figure class="h-48 overflow-hidden">
                <img src="https://t4.ftcdn.net/jpg/05/62/27/31/360_F_562273188_kSPIzFiflTq7KjmCLHXkfLUw4u2WEEA2.jpg"
                     alt="El Nido"
                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
            </figure>
            <div class="card-body">
                <div class="flex justify-between items-start">
                    <h3 class="card-title text-xl">El Nido</h3>
                    <div class="badge badge-secondary">Popular</div>
                </div>
                <p class="text-base-content/80 mt-2">Famous for its monumental limestone cliffs rising dramatically out of crystal-clear turquoise waters. The gateway to the Bacuit Archipelago lagoons.</p>
                <div class="card-actions justify-end mt-4">
                    <button class="btn btn-primary btn-sm">Read More →</button>
                </div>
            </div>
        </div>

        <!-- Tubbataha Reefs -->
        <div
            class="card card-compact bg-base-200 shadow-xl border border-base-300 overflow-hidden
                   cursor-pointer hover:shadow-2xl hover:-translate-y-1 transition-all duration-300"
            onclick="openDestinationModal('tubbataha')"
            role="button"
            tabindex="0"
            onkeydown="if(event.key==='Enter') openDestinationModal('tubbataha')"
            aria-label="Read more about Tubbataha Reefs"
        >
            <figure class="h-48 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=600&q=80"
                     alt="Tubbataha Reefs"
                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
            </figure>
            <div class="card-body">
                <h3 class="card-title text-xl">Tubbataha Reefs</h3>
                <p class="text-base-content/80 mt-2">A pristine, UNESCO-listed Marine Park showcasing vibrant coral walls, massive schools of fish, and elite diving experiences.</p>
                <div class="card-actions justify-end mt-4">
                    <div class="badge badge-outline">UNESCO Site</div>
                    <button class="btn btn-primary btn-sm">Read More →</button>
                </div>
            </div>
        </div>

        <!-- Puerto Princesa River -->
        <div
            class="card card-compact bg-base-200 shadow-xl border border-base-300 overflow-hidden
                   cursor-pointer hover:shadow-2xl hover:-translate-y-1 transition-all duration-300"
            onclick="openDestinationModal('puerto-princesa')"
            role="button"
            tabindex="0"
            onkeydown="if(event.key==='Enter') openDestinationModal('puerto-princesa')"
            aria-label="Read more about Puerto Princesa River"
        >
            <figure class="h-48 overflow-hidden">
                <img src="https://dynamic-media.tacdn.com/media/photo-o/32/04/1f/11/caption.jpg?w=2400&h=-1&s=1"
                     alt="Underground River"
                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
            </figure>
            <div class="card-body">
                <h3 class="card-title text-xl">Puerto Princesa River</h3>
                <p class="text-base-content/80 mt-2">Journey through an incredible mountain-to-sea ecosystem and navigate one of the world's longest navigable underground rivers.</p>
                <div class="card-actions justify-end mt-4">
                    <button class="btn btn-primary btn-sm">Read More →</button>
                </div>
            </div>
        </div>

    </div>
</div>