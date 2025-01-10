<div x-data ="{
        currentImage: @entangle('currentImage'),
        autoSkipea(){
            setInterval(() => {
                this.$wire.call('nextImage');
            }, 3000);
        }
    }" x-init="autoSkipea" class="grid mt-40 relative w-full overflow-hidden">
    {{-- <div>
        @foreach ($images as $index => $image)
            <div x-show="currentImage === {{ $index }} ">
                <div class="py-10 w-screen h-[500px] bg-cover" style="background-image: url('{{ $image }}'); background-position: 10% 37%;">
                    <p>{{ $quotes[$index] }}</p>
                </div>

            </div>
        @endforeach
            </div>
        <button wire:click="previousImage">Previous</button>
        <button wire:click="nextImage">Next</button> --}}
            <!-- previous button -->
    <button type="button" class="absolute left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-neutral-600 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:outline-offset-0 dark:bg-neutral-950/40 dark:text-neutral-300 dark:hover:bg-neutral-950/60 dark:focus-visible:outline-white" aria-label="previous slide" wire:click="previousImage">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
    </button>

    <!-- next button -->
    <button type="button" class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-neutral-600 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:outline-offset-0 dark:bg-neutral-950/40 dark:text-neutral-300 dark:hover:bg-neutral-950/60 dark:focus-visible:outline-white" aria-label="next slide" wire:click="nextImage">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
        </svg>
    </button>

    <!-- slides -->
    <!-- Change min-h-[50svh] to your preferred height size -->
    <div class="relative min-h-[50svh] w-full">

            @foreach ($images as $index => $image)
            <div x-show="currentImage === {{ $index }}" class="absolute inset-0" x-transition.opacity.duration.1000ms>
                <div class="py-10 w-screen h-[500px] bg-cover" style="background-image: url('{{ $image }}'); background-position: 10% 37%;">
                    <p>{{ $quotes[$index] }}</p>
                </div>

            </div>
        @endforeach
    </div>
</div>


</div>