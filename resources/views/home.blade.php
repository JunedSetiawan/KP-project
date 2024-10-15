<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMPN 1 ZAPO</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        header {
            background-image: url({{ asset('img/auth/light_grey_dots_background.jpg') }});
            
        }
    </style>
</head>
<body>
    <header class="min-h-screen">
        <nav class="border-t-4 border-blue-500">
            <div class="container flex items-center justify-between px-6 py-3 mx-auto">
                <a href="#">
                    <img class="w-auto h-24 sm:h-24" src="{{ asset('img/auth/logo.png') }}" alt="">
                </a>
                <div class="flex">
                <a class="my-1 text-sm font-medium text-gray-500 rtl:-scale-x-100 hover:text-blue-500  lg:mx-4 lg:my-0" href="{{ route('informationservice.public') }}">
                    <span class="flex gap-2 underline">
                    Form Layanan Informasi BK 
                </span>
                </a>
                <a class="my-1 text-sm font-medium text-gray-500 rtl:-scale-x-100 hover:text-blue-500  lg:mx-4 lg:my-0" href="{{ route('login') }}">
                    <span class="flex gap-2">
                    Login <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 font-bold">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                      </svg>
                      
                </span>
                </a>
            </div>
            </div>
        </nav>
    
        <div class="container px-6 py-16 mx-auto mt-5">
            <div class="items-center lg:flex">
                <div class="w-full lg:w-1/2">
                    <div class="lg:max-w-lg">
                        <h1 class="text-3xl font-semibold text-gray-800 lg:text-4xl">Selamat Datang di Website BK dan Pengembangan Peserta Didik <span class="text-blue-500">SMPN 1 Ponorogo </span></h1>
    
                      
                    </div>
                </div>
    
                <div class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2">
                    <div x-data="{            
                        // Sets the time between each slides in milliseconds
                        autoplayIntervalTime: 3000,
                        slides: [                
                            {
                                imgSrc: '{{ asset('img/login.png') }}',
                                imgAlt: 'Vibrant abstract painting with swirling blue and light pink hues on a canvas.',  
                                title: '',
                                description: 'Login',           
                            },                
                            {                    
                                imgSrc: '{{ asset("img/layanan-informasi.png") }}',                    
                                imgAlt: 'Vibrant abstract painting with swirling red, yellow, and pink hues on a canvas.',  
                                title: '',
                                description: 'Layanan Informasi',            
                            },                
                            {                    
                                imgSrc: '{{ asset('img/absen.png') }}',                    
                                imgAlt: 'Vibrant abstract painting with swirling blue and purple hues on a canvas.',    
                                title: '',
                                description: 'Absensi',       
                            },            
                        ],            
                        currentSlideIndex: 1,
                        isPaused: false,
                        autoplayInterval: null,
                        previous() {                
                            if (this.currentSlideIndex > 1) {                    
                                this.currentSlideIndex = this.currentSlideIndex - 1                
                            } else {   
                                // If it's the first slide, go to the last slide           
                                this.currentSlideIndex = this.slides.length                
                            }            
                        },            
                        next() {                
                            if (this.currentSlideIndex < this.slides.length) {                    
                                this.currentSlideIndex = this.currentSlideIndex + 1                
                            } else {                 
                                // If it's the last slide, go to the first slide    
                                this.currentSlideIndex = 1                
                            }            
                        },    
                        autoplay() {
                            this.autoplayInterval = setInterval(() => {
                                if (! this.isPaused) {
                                    this.next()
                                }
                            }, this.autoplayIntervalTime)
                        },
                        // Updates interval time   
                        setAutoplayInterval(newIntervalTime) {
                            clearInterval(this.autoplayInterval)
                            this.autoplayIntervalTime = newIntervalTime
                            this.autoplay()
                        },    
                    }" x-init="autoplay" class="relative w-full overflow-hidden">
                       
                        <!-- slides -->
                        <!-- Change min-h-[50svh] to your preferred height size -->
                        <div class="relative min-h-[50svh] w-full">
                            <template x-for="(slide, index) in slides">
                                <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.1000ms>
                                    
                                    <!-- Title and description -->
                                    <div class="lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col items-center justify-end gap-2 bg-gradient-to-t from-neutral-950/85 to-transparent px-16 py-12 text-center">
                                        <h3 class="w-full lg:w-[80%] text-balance text-2xl lg:text-3xl font-bold text-white" x-text="slide.title" x-bind:aria-describedby="'slide' + (index + 1) + 'Description'"></h3>
                                        <p class="lg:w-1/2 w-full text-pretty text-sm text-neutral-300" x-text="slide.description" x-bind:id="'slide' + (index + 1) + 'Description'"></p>
                                    </div>
                    
                                    <img class="absolute w-full h-full inset-0 object-cover text-neutral-600 dark:text-neutral-300" x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />
                                </div>
                            </template>
                        </div>
                        
                        <!-- indicators -->
                        <div class="absolute rounded-md bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 px-1.5 py-1 md:px-2" role="group" aria-label="slides" >
                            <template x-for="(slide, index) in slides">
                                <button class="size-2 cursor-pointer rounded-full transition" x-on:click="(currentSlideIndex = index + 1), setAutoplayInterval(autoplayIntervalTime)" x-bind:class="[currentSlideIndex === index + 1 ? 'bg-neutral-300' : 'bg-neutral-300/50']" x-bind:aria-label="'slide ' + (index + 1)"></button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
   
</body>
</html>