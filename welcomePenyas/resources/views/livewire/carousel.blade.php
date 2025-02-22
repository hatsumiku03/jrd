<div x-data ="{
        currentImage: @entangle('currentImage'),
        autoSkipea(){
            setInterval(() => {
                this.$wire.call('nextImage');
            }, 3000);
        },
        nextImage() {
            this.currentImage = (this.currentImage + 1) % {{ count($images) }};
            $wire.call('nextImage');
        },
        previousImage() {
            this.currentImage = (this.currentImage - 1 + {{ count($images) }}) % {{ count($images) }};
            $wire.call('previousImage');
        }
    }" x-init="autoSkipea" class="grid relative overflow-hidden">
    
<div class="absolute inset-0 bg-black/30"></div>

{{-- | Previous Button | --}}
<button type="button" class="absolute left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-neutral-900 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:outline-offset-0" aria-label="previous slide" @click="previousImage">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
    </svg>
</button>

{{-- | Next Button | --}}
<button type="button" class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-neutral-900 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:outline-offset-0" aria-label="next slide" @click="nextImage">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
    </svg>
</button>

{{-- | Carousel | --}}
<div class="relative min-h-[500px] h-full w-full border-2 border-[#404040]">
    @foreach ($images as $index => $image)
    <div x-show="currentImage === {{ $index }}" class="absolute inset-0" x-transition.opacity.duration.1000ms>
        
        {{-- ¿ Changing bg of images ¿ --}}
        <div class="py-10 w-full h-[500px] bg-cover" style="background-image: url('{{ $image }}'); background-position: 10% 37%;">
            {{-- ¿ Black overlay in image ¿ --}}
            <div class="absolute inset-0 bg-black/30"></div>
            
            {{-- ¿ Quotes of the crews ¿ --}}
            <div class="flex mt-36 items-center justify-center">
                <span class="absolute w-fit mx-auto py-4 flex border blur-md text-black bg-clip-text max-[767px]:text-4xl md:text-8xl box-content font-extrabold text-center select-none z-10">
                    {{ $quotes[$index] }}
                </span>
                <h1
                class="relative w-fit top-0 h-auto py-4 justify-center flex bg-gradient-to-r items-center text-white bg-clip-text max-[767px]:text-4xl md:text-8xl font-extrabold text-center select-auto z-10">
                {{ $quotes[$index] }}
            </h1>
        </div>
        
        {{-- ¿ Name of the crews ¿ --}}
        <div class="flex items-center justify-center">
            <span class="absolute mx-auto py-4 flex border w-fit blur-md text-black bg-clip-text max-[767px]:text-3xl md:text-5xl box-content font-extrabold text-center select-none z-10">
                - {{ $crewsName[$index] }}
            </span>
            <h1
            class="relative top-0 w-fit h-auto py-4 justify-center flex bg-gradient-to-r items-center text-white bg-clip-text max-[767px]:text-3xl md:text-5xl font-extrabold text-center select-auto z-10">
            - {{ $crewsName[$index] }}
        </h1>
    </div>
    
</div>
</div>
@endforeach
</div>
</div>


</div>