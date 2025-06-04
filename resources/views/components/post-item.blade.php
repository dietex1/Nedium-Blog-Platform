<div class="flex mb-8 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <div class="p-5 flex-1">
        <a href="{{ route('post.show',['username' => $post->user->username, 'post' => $post->slug]) }}">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$post->title}}</h5>
        </a>
        <div class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Str::words($post->content,25)}}</div>
        <div class="mb-3 text-sm  text-gray-400 flex items-center gap-4">
            <span href="" >
                {{ $post->created_at->diffForHumans() }}
             </span>
            <div class="flex gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M1 8.25a1.25 1.25 0 1 1 2.5 0v7.5a1.25 1.25 0 1 1-2.5 0v-7.5ZM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0 1 14 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 0 1-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 0 1-1.341-.317l-2.734-1.366A3 3 0 0 0 6.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 0 1 2.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388Z" />
                </svg>
                {{ $post->likes()->count() }}
            </div>
        </div>
        <a href="{{ route('post.show',['username' => $post->user->username, 'post' => $post->slug]) }}" class="">
            <x-primary-button>
                Read more
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
            </x-primary-button>
        </a>
    </div>
    <a href="{{ route('post.show',['username' => $post->user->username, 'post' => $post->slug]) }}" >
        <img class="rounded-r-lg w-48 h-full max-h-64 object-cover " src={{Storage::url($post->image)}} alt="" />
    </a>
</div>
