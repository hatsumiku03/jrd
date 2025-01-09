<div x-data ="{
        currentImage: @entangle('currentImage'),
        autoSkipea(){
            setInterval(() => {
                this.$wire.call('nextImage');
            }, 3000);
        }
    }" x-init="autoSkipea" class="grid mt-6">
    <div>
        @foreach ($images as $index => $image)
            <div x-show="currentImage === {{ $index }} ">
                <div class="py-10 w-screen h-[500px] bg-cover" style="background-image: url('{{ $image }}'); background-position: 10% 37%;">
                    <p>{{ $quotes[$index] }}</p>
                </div>

            </div>
        @endforeach
    </div>
    <button wire:click="previousImage">Previous</button>
    <button wire:click="nextImage">Next</button>
</div>
</div>